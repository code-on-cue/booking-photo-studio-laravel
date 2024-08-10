@extends('guest.layouts.main')
@php
    $names = explode(' ', ConfigHelper::get('appName'));
    $firstName = $names[0];
    if (count($names) >= 2) {
        array_shift($names);
        $lastName = implode(' ', $names);
    } else {
        $lastName = '';
    }
@endphp
@section('navbar')
    <li class="scroll-to-section">
        <a href="{{ url('/') }}" class="active">Home</a>
    </li>
    <li class="scroll-to-section">
        <a href="{{ route('login') }}">Admin Login</a>
    </li>
@endsection
@section('content')
    <div class="banner-bookings wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6">
                            <div class="card py-2 shadow">
                                <div class="card-body mx-2">
                                    <div>
                                        <div class="card-title py-3 text-center">
                                            <h3><span class="text-info">{{ $firstName }}</span> <span
                                                    class="text-primary">{{ $lastName }}</span></h3>
                                            <h4>Invoice Pembayaran</h4>
                                        </div>
                                        <hr>
                                        <div>
                                            <ul class="list-unstyled">
                                                <li class="text-black h5">{{ $transaction->name }}</li>
                                                <li class="text-muted mt-1"><span class="text-black">Tiket</span>
                                                    #{{ $transaction->trxId }}</li>
                                                <li class="text-black mt-1">{{ $transaction->createdAt }}</li>
                                                <li class="badge {{ $transaction->colorStatus }}">
                                                    {{ $transaction->status }}</li>
                                            </ul>
                                            <hr>
                                            <table class="table">
                                                <tr>
                                                    <td>Tanggal Booking</td>
                                                    <td>{{ $transaction->date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Sesi</td>
                                                    <td>{{ date('H:i', strtotime($transaction->time)) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Orang</td>
                                                    <td>{{ $transaction->numberOfPerson }} Orang</td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya</td>
                                                    <td>Rp.
                                                        {{ $transaction->currency('basedPrice') }}/{{ $transaction->basedPerson }}
                                                        Orang</td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Tambahan</td>
                                                    <td>Rp. {{ $transaction->currency('additionalPrice') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total</th>
                                                    <td>Rp. {{ $transaction->currency('totalPrice') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="alert alert-warning">
                                            Silahkan lakukan pembayaran DP sebesar <span class="badge bg-danger">Rp.
                                                {{ $transaction->currency('downPayment') }}</span> ke rekening
                                            {{ ConfigHelper::get('accountSource') }}
                                            <strong>{{ ConfigHelper::get('accountNumber') }} an.
                                                {{ ConfigHelper::get('accountHolder') }}.</strong>
                                            <div onclick="copy()" class="badge bg-info" style="cursor: pointer">copy
                                                rekening</div>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center">
                                            <p>Syarat & Ketentuan:&nbsp;</p>
                                            <button data-bs-toggle="modal" data-bs-target="#sk" type="button"
                                                class="btn badge bg-primary">baca</button>
                                        </div>
                                        <div class="text-center">
                                            @if ($transaction->status == 'pending')
                                                <a target="_blank"
                                                    href="https://wa.me/{{ ConfigHelper::get('whatsapp') }}?text=Halo kak, saya sudah melakukan pembayaran DP untuk booking tanggal {{ $transaction->date }} jam {{ $transaction->time }} dengan nomor tiket {{ $transaction->trxId }}, mohon untuk dikonfirmasi. Terima kasih"
                                                    class="btn btn-primary mb-2"><i class="bi bi-whatsapp"></i> Konfirmasi
                                                    ke Admin</a>
                                                <div>Jika dalam 15 menit tidak melakukan pembayaran, maka status booking
                                                    akan dicancel.</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="sk" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Syarat &amp; Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">Biaya
                            {{ \App\Helpers\StrHelper::currency(ConfigHelper::get('price'), 'Rp') }}/{{ ConfigHelper::get('maximumPerson') }}
                            orang</li>
                        <li class="list-group-item">Tambahan orang
                            {{ \App\Helpers\StrHelper::currency(ConfigHelper::get('additionalPrice'), 'Rp') }}/orang</li>
                        <li class="list-group-item">25 menit sesi foto</li>
                        <li class="list-group-item">5 menit persiapan & cetak foto</li>
                        <li class="list-group-item">Free Cetak 2 foto</li>
                        <li class="list-group-item">Semua soft file akan dikirim melalui google drive</li>
                        <li class="list-group-item">Datang 15 menit sebelum sesi dimulai</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function copy() {
            const rekening = "043701076329500";
            // Buat elemen input yang tidak terlihat
            var input = document.createElement('input');
            input.setAttribute('value', rekening);
            document.body.appendChild(input);

            // Pilih teks di dalam input
            input.select();

            // Salin teks ke clipboard
            document.execCommand('copy');

            // Hapus elemen input
            document.body.removeChild(input);

            Swal.fire({
                title: 'Sukses',
                text: 'Nomor rekening berhasil dicopy.',
                icon: 'success',
                timer: 2000,
                confirmButtonText: 'Oke',
            })
        }
    </script>
@endsection
