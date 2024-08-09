<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="title" content="Hey Studio Tangerang">
    <meta name="description"
        content="Hey Studio Tangerang adalah studio foto profesional dengan konsep self photo yang menawarkan layanan fotografi berkualitas di daerah Tangerang. Hubungi kami untuk sesi foto yang indah dan mengesankan.">
    <meta name="keywords"
        content="heystudio, hey studio, self photo, self studio, studio tangerang, photo tangerang, hey studio photo, hey studio cisoka">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">

    <!-- Meta -->
    <meta property="og:title" content="Hey Studio Tangerang" />
    <meta property="og:description"
        content="Hey Studio Tangerang adalah studio foto dengan konsep self photo, pelanggan melakukan permotretan sendiri dengan menggunakan remote." />
    <meta property="og:image" content="https://heystudio.web.id/assets/img/logo-hey.png" />
    <meta property="og:url" content="https://heystudio.web.id" />
    <meta property="og:type" content="website" />

    <title>Login | Self Studio Photo</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/guest/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Google Captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Favicon -->
    <link rel="icon" href="/assets/img/logo-hey.png" type="image/png" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('/guest/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('/guest/animated.css') }}" />

</head>

<body style="overflow-x: hidden">
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        © Copyright 2023 <a href="/https://www.instagram.com/heystudio.id"
                            class="text-decoration-none">Hey Studio</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    <script src="{{ asset('/guest/jquery.min.js') }}"></script>
    <script src="{{ asset('/guest/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/guest/animation.js') }}"></script>
    <script src="{{ asset('/guest/main.js') }}"></script>
    <script></script>
</body>

</html>
