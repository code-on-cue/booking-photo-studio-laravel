<?php

namespace App\Http\Controllers;

use App\Helpers\ConfigHelper;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }

    public function transaction()
    {
        return view('guest.transaction');
    }

    public function booked(Request $request)
    {
        $date = $request->get('tanggal');

        $jamBuka = ConfigHelper::get('openStore');
        $jamTutup = ConfigHelper::get('closeStore');

        $istirahat = explode('|', ConfigHelper::get('breakTime'));

        $startTime = strtotime(date($date . ' ' . $jamBuka));
        $currentTime = strtotime(date('Y-m-d H:i'));
        $closedTime = strtotime(date($date . ' ' . $jamTutup));
        $duration = ConfigHelper::get('duration');

        $listTime = [];
        $listBooked = [];
        $listPassed = [];
        while ($startTime <= $closedTime) {
            $timeFormat = date('H:i', $startTime);

            // SKIP JIKA JAM ISTIRAHAT
            if (!in_array($timeFormat, $istirahat)) {
                // JIKA TELAH TERDAFTAR
                $booked = Transaction::where('time',  $timeFormat)
                    ->where('date', $date)
                    ->where('status', '!=', Transaction::STATUS_FAILED)
                    ->first();
                if ($booked) {
                    $listBooked[] = [
                        'fullname' => $booked->name,
                        'jam' => $timeFormat
                    ];
                }

                // JIKA SUDAH TERLEWAT
                $isPassed = $startTime < $currentTime;
                if ($isPassed) {
                    $listPassed[] = $timeFormat;
                }
                $listTime[] = $timeFormat;
            }

            // TAMBAHKAN DURASI WAKTU
            $startTime = strtotime(date($date . ' H:i', $startTime) . " + {$duration} minutes");
        }

        return response()->json([
            "is_booked" => $listBooked,
            "is_passed" => $listPassed,
            "sesi" => $listTime,
        ]);
    }

    public function transactionStore(Request $request)
    {
        // VALIDATION DATA
        $request->validate([
            'name'           => 'required',
            'phone'          => 'required',
            'numberOfPerson' => 'required',
            'date'           => 'required',
            'time'           => 'required'
        ]);

        // VARIABLE 
        // MIGRATE INI KE TABLE
        $harga = ConfigHelper::get('price');
        $additionalPerson = ConfigHelper::get('additionalPrice');
        $maximumPerson = ConfigHelper::get('maximumPerson');

        // PREPARE PAYLOAD
        $payload = $request->all();
        $payload['trxId'] = time();
        $payload['status'] = Transaction::STATUS_PENDING;

        // HITUNG HARGA
        $tambahanOrang = $request->numberOfPerson - $maximumPerson;
        $payload['totalPrice'] = $tambahanOrang <= 0 ? $harga : $tambahanOrang * $additionalPerson + $harga;
        $payload['basedPrice'] = $harga;
        $payload['additionalPrice'] = $payload['totalPrice'] - $harga;
        $payload['downPayment'] = floor($payload['totalPrice'] / 2) - (floor($payload['totalPrice'] / 2) % 1000);
        $payload['basedPerson'] = $maximumPerson;

        // MASUKKAN KE DATABASE
        if ($transaction = Transaction::create($payload)) {
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
        return view('guest.transaction-detail', compact('transaction'));
    }
}
