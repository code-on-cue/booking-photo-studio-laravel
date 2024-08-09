@extends('auth.layouts.main')

@section('content')
    <section class="vh-100 d-flex align-items-center justify-content-center">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="img-left col-lg-6 col-xl-5 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.25s">
                    <a href="/">
                        <img src="{{ asset('/guest/img/logo-hey.png') }}" class="img-fluid" alt="Logo Hey Studio">
                    </a>
                </div>
                <div class="col-lg-6 col-xl-4 offset-xl-1 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.25s">
                    <form method="POST" action="{{ route('login-action') }}">
                        @csrf
                        <h3 class="text-center mb-3 fw-bold">Login</h3>

                        <!-- Email input -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control " id="emailAddress" placeholder="name@example.com"
                                name="email" value="">
                            <label for="emailAddress">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password" value="">
                            <label for="password">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" id="remember" name="remember" />
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <a href="/forgot-password" class="text-body">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding: 0.3rem 2.5rem"><i
                                    class="bi bi-lock"></i> Login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
