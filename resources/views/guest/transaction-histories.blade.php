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
    @guest
        <li class="scroll-to-section">
            <a href="{{ route('login') }}">Login</a>
        </li>
    @else
        <li class="scroll-to-section">
            <a href="{{ route('booking.history') }}">Riwayat Booking</a>
        </li>
        <li style="padding: 0;padding-left:12px;padding-right:12px;padding-bottom:12px;">
            <form action="{{ route('logout-action') }}" method="post">
                @csrf
                <button style="border:0;background:transparent;line-height:25px;height:auto">Sign out</button>
            </form>
        </li>
    @endguest
@endsection
@section('content')
    <div class="banner-bookings wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card py-2 shadow">
                        <div class="card-body mx-2">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>
                                                {{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($item->date)) }}
                                            </td>
                                            <td>
                                                {{ $item->time }}
                                            </td>
                                            <td>
                                                <span class="badge {{ $item->colorStatus }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($item->status === \App\Models\Transaction::STATUS_SUCCESS && $item->linkDrive)
                                                    <a href="{{ $item->linkDrive }}" target="_blank"
                                                        class="btn btn-success btn-sm mb-1 mt-1">Download Soft File</a>
                                                    <br>
                                                @endif
                                                @if ($item->status === \App\Models\Transaction::STATUS_PENDING)
                                                    <a href="{{ $item->snapToken }}" target="_blank"
                                                        class="btn btn-success btn-sm mb-1 mt-1" id="pay-button">Bayar
                                                        Sekarang</a>
                                                    <br>

                                                    <a href="{{ route('jadwal.payment', $item->trxId) }}"
                                                        class="btn btn-primary btn-sm mb-1 mt-1" id="pay-button">Check
                                                        Status</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
