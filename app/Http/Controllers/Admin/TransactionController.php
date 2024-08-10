<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Daftar Transaksi';
        $query = Transaction::query();
        if ($request->has('search')) {
            $q = $request->get('search');
            $query->where(function (Builder $qb) use ($q) {
                $qb->where('trxId', 'like', "%$q%")
                    ->orWhere('name', 'like', "%$q%")
                    ->orWhere('time', 'like', "%$q%")
                    ->orWhere('date', 'like', "%$q%");
            });
        }
        $collection = $query->orderBy('id', 'asc')->paginate();
        return view('admin.transaction.index', compact('title', 'collection'));
    }

    public function acc(Transaction $transaction)
    {
        $transaction->update(['status' => Transaction::STATUS_PROCESS]);

        return redirect()->back()->withSuccess('Berhasil menyetujui booking');
    }

    public function reject(Transaction $transaction)
    {
        $transaction->update(['status' => Transaction::STATUS_FAILED]);

        return redirect()->back()->withSuccess('Berhasil menolak booking');
    }

    public function tandaiSelesaiAction(Request $request, Transaction $transaction)
    {
        $request->validate([
            'linkDrive' => 'required|url'
        ]);


        $transaction->update([
            'linkDrive' => $request->linkDrive,
            'status' => Transaction::STATUS_SUCCESS
        ]);

        return redirect()->route('transaction.hari-ini')->withSuccess('Berhasil menyelesaikan transaksi');
    }
    public function tandaiSelesai(Transaction $transaction)
    {
        $title = 'Tandai Selesai';
        return view('admin.transaction.tandai-selesai', compact('title', 'transaction'));
    }
}
