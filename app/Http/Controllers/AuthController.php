<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
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
            $user = Auth::user();
            if ($user->role != User::ROLE_ADMIN) {
                return redirect()->route('home');
            }
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('danger', 'Kredensial yang anda masukan tidak valid');
    }

    // Hapus sesi dari aplikasi
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }


    // Fungsi untuk menampilkan halaman register
    public function register()
    {
        return view('auth.register');
    }

    // Fungsi untuk masuk sebagai seorang pengguna
    public function registerAction(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        $creds = $request->all();
        $creds['role'] = User::ROLE_CUSTOMER;

        try {
            $user = User::create($creds);
            Auth::login($user);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'danger',
                'Gagal Mendaftar'
                    . $th->getMessage()
            );
        }

        return redirect()->back()->with('danger', 'Gagal Mendaftar');
    }
}
