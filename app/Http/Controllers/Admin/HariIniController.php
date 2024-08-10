<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HariIniController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Pemesanan Hari Ini';
        $query = Transaction::query()->where('date', date('Y-m-d'))
            ->where(function (Builder $qb) {
                $qb->where('status', Transaction::STATUS_PROCESS)
                    ->orWhere('status', Transaction::STATUS_SUCCESS);
            })
            ->orderBy('time', 'asc');
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
        return view('admin.hari-ini.index', compact('title', 'collection'));
    }
}
