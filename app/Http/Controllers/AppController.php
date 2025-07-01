<?php

namespace App\Http\Controllers;

use App\Helpers\ConfigHelper;
use App\Helpers\MidtransHelper;
use App\Models\Box;
use App\Models\Transaction;
use App\Models\Type;
use App\Services\Booking\BookingServiceFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('guest.index', compact('types'));
    }

    public function transaction(Request $request, string $type)
    {
        $type = Type::where('slug', $type)->firstOrFail();

        return view('guest.transaction', compact('type'));
    }

    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kritik_saran' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'invalid',
                'errors' => $validator->errors()
            ], 400);
        }

        if (Box::create($validator->validated())) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengirim pesan'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengirim pesan',
            'errors' => []
        ], 400);
    }

    public function booked(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'typeId'  => 'required|exists:types,id',
        ]);

        $type = Type::findOrFail($request->get('typeId'));
        $slug = $type->slug;

        // Jika tipe tidak menggunakan sesi waktu (wedding), langsung balikin kosong
        if ($slug === 'wedding') {
            return response()->json([
                "is_booked" => [],
                "is_passed" => [],
                "sesi" => [],
            ]);
        }

        $date = $request->get('tanggal');

        $jamBuka = $type->moreDetails['openStore'] ?? '09:00';
        $jamTutup = $type->moreDetails['closeStore'] ?? '21:00';
        $duration = $type->moreDetails['duration'] ?? 30;
        $istirahat = explode('|', $type->moreDetails['breakTime'] ?? '');

        $startTime = strtotime("$date $jamBuka");
        $closedTime = strtotime("$date $jamTutup");
        $currentTime = strtotime(now()->format('Y-m-d H:i'));

        $listTime = [];
        $listBooked = [];
        $listPassed = [];

        // Ambil semua booking hari itu
        $bookedMap = Transaction::where('date', $date)
            ->where('typeId', $type->id)
            ->where('status', '!=', Transaction::STATUS_FAILED)
            ->get()
            ->keyBy('time');

        while ($startTime <= $closedTime) {
            $timeFormat = date('H:i', $startTime);
            $timeFormatDatabase = date('H:i:00', $startTime);

            if (!in_array($timeFormat, $istirahat)) {
                // Sudah di-booking
                if ($bookedMap->has(key: $timeFormatDatabase)) {
                    $listBooked[] = [
                        'fullname' => $bookedMap[$timeFormatDatabase]->name,
                        'jam' => $timeFormat
                    ];
                }

                // Waktu sudah lewat
                if ($startTime < $currentTime) {
                    $listPassed[] = $timeFormat;
                }

                $listTime[] = $timeFormat;
            }

            // Tambah durasi
            $startTime = strtotime("+{$duration} minutes", $startTime);
        }

        return response()->json([
            "is_booked" => $listBooked,
            "is_passed" => $listPassed,
            "sesi" => $listTime,
        ]);
    }


    public function transactionStore(Request $request)
    {
        $type = Type::findOrFail($request->typeId);
        $service = BookingServiceFactory::resolveService($type->slug);

        $service->validate($request, $type);
        $harga = $service->getBasedPrice($request, $type);
        $totalPrice = $service->calculatePrice($request, $type);
        $maximumPerson = $service->getMaximumPerson($request, $type);

        // PREPARE PAYLOAD
        $payload = $request->all();
        $payload['trxId'] = time();
        $payload['status'] = Transaction::STATUS_PENDING;

        // HITUNG HARGA
        $payload['totalPrice'] = $totalPrice;
        $payload['basedPrice'] = $harga;
        $payload['additionalPrice'] = $payload['totalPrice'] - $harga;
        $payload['downPayment'] = 0;
        $payload['basedPerson'] = $maximumPerson;

        // SIMPAN DETAIL TAMBAHAN
        $payload['moreDetails'] = $request->all();

        if (!isset($payload['numberOfPerson'])) {
            // Untuk wedding, tidak ada jumlah orang
            $payload['numberOfPerson'] = 0;
        }

        // ATUR TRANSAKSI
        DB::beginTransaction();

        // MASUKKAN KE DATABASE
        if ($transaction = Transaction::create($payload)) {

            // MIDTRANS INTEGRATION
            $response = MidtransHelper::getSnapToken($transaction->trxId, $transaction->totalPrice);
            $transaction->update(['snapToken' => $response['redirect_url']]);

            DB::commit();

            return redirect()->route('jadwal.payment', $transaction->trxId);
        }

        return redirect()
            ->back()
            ->withError('Pemesanan gagal dilakukan, silahkan hubungi administrator.');
    }

    public function transactionDetail($trxId)
    {
        $transaction = Transaction::where(['trxId' => $trxId])->first();

        if (!$transaction) return abort(404);

        if ($transaction->snapToken && $transaction->status == Transaction::STATUS_PENDING) {
            $isCompleted = MidtransHelper::checkPayment($transaction->trxId);
            if ($isCompleted) {
                $transaction->update([
                    'downPayment' => $transaction->totalPrice,
                    'status' => Transaction::STATUS_SUCCESS
                ]);
            }
        }

        $type = $transaction->type;


        return view('guest.transaction-detail', compact('transaction', 'type'));
    }

    public function transactionHistories()
    {
        $transactions = Transaction::where('status', '!=', Transaction::STATUS_FAILED)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('guest.transaction-histories', compact('transactions'));
    }
}
