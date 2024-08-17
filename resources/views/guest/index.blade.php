@extends('guest.layouts.main')

@section('navbar')
    <li class="scroll-to-section">
        <a href="#top" class="active">Home</a>
    </li>
    <li class="scroll-to-section">
        <a href="#about">About Us</a>
    </li>
    <li class="scroll-to-section">
        <a href="#services">Services</a>
    </li>
    <li class="scroll-to-section">
        <a href="#contact">Contact</a>
    </li>
    <li class="scroll-to-section">
        <a href="{{ route('login') }}">Login</a>
    </li>
@endsection

@section('content')
    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content px-5 header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <h2>
                                    Abadikan Momen Bersama di
                                    <em style="display:block">{{ ConfigHelper::get('appName') }}</em>
                                </h2>
                                <a href="{{ route('guest.transaction') }}" class="btn btn-lg mt-2 btn-booking">
                                    <i class="bi bi-calendar-plus" style="margin-right: .5rem"></i> Booking Now
                                </a>
                                <a href="https://wa.me/{{ ConfigHelper::get('whatsapp') }}"
                                    class="btn btn-lg mt-2 btn-booking">
                                    <i class="bi bi-whatsapp" style="margin-right: .5rem"></i> Admin
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="{{ asset('guest/img/right-content-studio.png') }}" alt="Foto" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about-us section mt-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <img src="{{ asset('guest/img/left-content-studio.png') }}" alt="person graphic"
                            style="margin-top: -88px" />
                    </div>
                </div>
                <div class="col-lg-7 align-self-center">
                    <div class="services">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                                    <div class="icon">
                                        <i class="bi bi-stars text-white fs-3"></i>
                                    </div>
                                    <div class="right-text">
                                        <h4>Kreasi Tanpa Batas</h4>
                                        <p>
                                            Kamu memiliki kendali penuh atas
                                            semua aspek fotografi, termasuk
                                            pencahayaan, latar belakang,
                                            sudut pengambilan gambar, dan
                                            pengeditan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                                    <div class="icon">
                                        <i class="bi bi-coin text-white fs-3"></i>
                                    </div>
                                    <div class="right-text">
                                        <h4>Biaya Terjangkau</h4>
                                        <p>
                                            Nikmati kualitas foto yang sama
                                            seperti studio foto profesional,
                                            tanpa perlu membayar biaya yang
                                            mahal.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                                    <div class="icon">
                                        <i class="bi bi-shield-check text-white fs-3"></i>
                                    </div>
                                    <div class="right-text">
                                        <h4>Privasi</h4>
                                        <p>
                                            Privasi memberikan Kamu
                                            lingkungan yang tenang dan intim
                                            untuk mengambil foto yang lebih
                                            personal atau pribadi, tanpa
                                            gangguan dari orang lain.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="1.1s">
                                    <div class="icon">
                                        <i class="bi bi-boxes text-white fs-3"></i>
                                    </div>
                                    <div class="right-text">
                                        <h4>Banyak Properti</h4>
                                        <p>
                                            Kami menawarkan berbagai latar
                                            belakang dan properti foto yang
                                            dapat digunakan oleh pelanggan
                                            untuk menciptakan tampilan yang
                                            berbeda-beda.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="our-services section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 align-self-center wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="left-image">
                        <div class="card shadow">
                            <div class="card-header text-white" style="background-color: #03a4ed;">
                                <h4 class="card-title fw-bold mb-0">
                                    Price List
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h5>Sesi Self Photo</h5>
                                    <p class="badge" style="background-color: #03a4ed;">
                                        {{ StrHelper::currency(ConfigHelper::get('price'), 'Rp') }}
                                    </p>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-action">
                                        {{ ConfigHelper::get('maximumPerson') }} Orang</li>
                                    <li class="list-group-item list-group-item-action">25 Menit Sesi Foto</li>
                                    <li class="list-group-item list-group-item-action">5 Menit Persiapan & Cetak Foto
                                    </li>
                                    <li class="list-group-item list-group-item-action">Free 2 Cetak Foto</li>
                                    <li class="list-group-item list-group-item-action">Soft File via Google Drive</li>
                                </ul>
                                <div class="my-2 d-flex align-items-center justify-content-between">
                                    <h5>Tambahan Orang</h5>
                                    <p class="badge" style="background-color: #03a4ed;">
                                        {{ StrHelper::currency(ConfigHelper::get('additionalPrice'), 'Rp') }}/Orang</p>
                                </div>
                                <ul class="list-group mb-2">
                                    <li class="list-group-item list-group-item-action">Free Cetak Foto</li>
                                </ul>
                                <a href="{{ route('guest.transaction') }}" class="btn text-white"
                                    style="background-color: #03a4ed;"><i class="bi bi-calendar-plus"></i> Booking
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="section-heading">
                        <h2>Bergaya <em>Sesukamu</em></h2>
                        <p>
                            Ciptakan kenangan indah tanpa menyewa fotografer
                            dengan layanan Self-Studio Foto. Dapatkan hasil
                            foto terbaik dengan berbagai properti kreatif
                            yang kami sediakan.
                        </p>
                        <div>
                            <p><i class="bi bi-check-lg"></i> Free Cetak</p>
                            <p><i class="bi bi-check-lg"></i> Harga Terjangkau</p>
                            <p><i class="bi bi-check-lg"></i> Banyak Warna Background</p>
                            <p><i class="bi bi-check-lg"></i> Tersedia Properti Pendukung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <div class="section-heading">
                        {!! ConfigHelper::get('map') !!}
                        <div class="d-flex flex-column gap-3 text-white mt-3">
                            <h6>Alamat: {{ ConfigHelper::get('address') }}</h6>
                            <h6><i class="bi bi-whatsapp"></i> Whatsapp&nbsp;<a
                                    href="https://wa.me/{{ ConfigHelper::get('whatsapp') }}" class="text-white">
                                    {{ ConfigHelper::get('whatsapp') }}</a>
                            </h6>
                            <h6><i class="bi bi-facebook"></i> Sosmed&nbsp;<a target="_blank"
                                    href="https://www.facebook.com/{{ ConfigHelper::get('instagram') }}" class="text-white">
                                    {{ '@' . ConfigHelper::get('instagram') }}</a>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="#" method="post">
                        @csrf
                        <h3 class="mb-3">Kritik & Saran</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="text" name="nama" id="nama" placeholder="Your Name"
                                        required />
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <textarea name="kritik_saran" type="text" class="form-control " id="message" placeholder="Message"
                                        required=""></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-button">
                                        Send Message
                                    </button>
                                </fieldset>
                            </div>
                        </div>
                        <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
