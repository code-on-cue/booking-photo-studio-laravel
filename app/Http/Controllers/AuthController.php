<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Fungsi untuk menampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // Fungsi untuk masuk sebagai seorang pengguna
    public function action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $creds = $request->only('email', 'password');


        if (Auth::attempt($creds)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withError('Kredensial yang anda masukan tidak valid');
        // $request->validate([
        //     'name'           => 'required',
        //     'phone'          => 'required',
        //     'numberOfPerson' => 'required',
        //     'date'           => 'required',
        //     'time'           => 'required',
        //     // 'price'          => 'required',
        //     // 'status'         => 'required',
        // ]);


    }

    // Hapus sesi dari aplikasi
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
