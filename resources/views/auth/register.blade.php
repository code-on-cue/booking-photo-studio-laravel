@extends('auth.layouts.main')

@section('content')
    <section class="vh-100 d-flex align-items-center justify-content-center">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="img-left col-lg-6 col-xl-5 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.25s">
                    <a href="/">
                        <img src="{{ asset('/guest/img/logo-hey.png') }}" class="img-fluid"
                            alt="Logo {{ ConfigHelper::get('appName') }}">
                    </a>
                </div>
                <div class="col-lg-6 col-xl-4 offset-xl-1 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.25s">
                    @include('_components.alert')
                    <form method="POST" action="{{ route('register-action') }}">
                        @csrf
                        <h3 class="text-center mb-3 fw-bold">Pendaftaran</h3>

                        <!-- Email input -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameUser"
                                placeholder="name@example.com" name="name" value="">
                            <label for="nameUser">Nama Lengkap</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email input -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="emailAddress" placeholder="name@example.com" name="email" value="">
                            <label for="emailAddress">Alamat Surel</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Password input -->
                        <div class="form-floating mb-3">
                            <input type="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                placeholder="phone" name="phone" value="">
                            <label for="phone">No Whatsapp</label>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" placeholder="Password" name="password" value="">
                            <label for="password">Kata Sandi</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" id="remember" name="remember" />
                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding: 0.3rem 2.5rem"><i
                                    class="bi bi-lock"></i> Mendaftar</button>
                        </div>
                        <p>
                            Sudah punya akun ?
                            <a href="{{ route('login') }}">Masuk</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
