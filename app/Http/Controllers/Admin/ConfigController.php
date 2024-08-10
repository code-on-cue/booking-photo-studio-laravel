<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $title = 'Pengaturan';
        $config = Config::first();
        return view('admin.config.index', compact('config', 'title'));
    }

    public function update(Request $request)
    {
        $config = Config::first();
        $request->validate([
            'appName' => 'required',
            'price' => 'required',
            'additionalPrice' => 'required',
            'maximumPerson' => 'required',
            'openStore' => 'required',
            'closeStore' => 'required',
            'breakTime' => 'required',
            'duration' => 'required',
            'accountSource' => 'required',
            'accountNumber' => 'required',
            'accountHolder' => 'required',
            'whatsapp' => 'required',
            'instagram' => 'required',
            'address' => 'required',
            'map' => 'required',
        ]);



        if ($config->update($request->all())) {
            return redirect()->back()->withSuccess('Pengaturan berhasil diubah');
        }

        return redirect()->back()->withInput()->withError('Gagal mengubah pengaturan');
    }
}
