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
                    <form method="POST" action="{{ route('login-action') }}">
                        @csrf
                        <h3 class="text-center mb-3 fw-bold">Login</h3>

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
                        <div class="input-group" id="show_hide_password" style="position: relative">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Password" name="password" value="">
                                <label for="password">Kata Sandi</label>
                                <div id="show-container" style="position: absolute;top: calc(50% - 12px); right: 5px">
                                    <button onclick="showHide(event)" style="border:0;background: transparent"><i
                                            class="fa fa-eye-slash" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" id="remember" name="remember" />
                                <label class="form-check-label" for="remember">
                                    Ingat saya
                                </label>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" style="background:transparent;border:0" class="text-body"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Lupa kata sandi?
                            </button>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding: 0.3rem 2.5rem"><i
                                    class="bi bi-lock"></i> Masuk</button>
                        </div>

                        <p>
                            Belum punya akun ?
                            <a href="{{ route('register') }}">Daftar sekarang</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lupa kata sandi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Silahkan hubungi admin untuk memulihkan kata sandi anda.
                    <br>
                    <a href="https://wa.me/{{ ConfigHelper::get('whatsapp') }}" target="blank">
                        <i class="bi bi-whatsapp" style="margin-right: .5rem"></i> Whatsapp
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        let passwordElement = document.getElementById('password');
        const showHide = (event) => {
            event.preventDefault();

            let currentType = passwordElement.type;
            if (currentType === 'text') passwordElement.type = 'password';
            else passwordElement.type = 'text';


        }
    </script>
@endsection
