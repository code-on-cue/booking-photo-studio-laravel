<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $processTransaction = Transaction::where('status', Transaction::STATUS_PROCESS)->count();
        $successTransaction = Transaction::where('status', Transaction::STATUS_SUCCESS)->count();
        $pendingTransaction = Transaction::where('status', Transaction::STATUS_PENDING)->count();
        return view(
            'admin.dashboard.index',
            compact(
                'processTransaction',
                'successTransaction',
                'pendingTransaction',
                'title'
            )
        );
    }
}
