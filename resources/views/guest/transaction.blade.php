@extends('guest.layouts.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('/guest/bootstrap-datepicker.min.css') }}">
@endsection

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
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12">{{-- Error Display --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="alert alert-danger">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="row justify-content-center">
                        <div class="col-md-6 d-none d-md-block">
                            <div
                                style="background: url('{{ asset('storage/' . $type->banner) }}') no-repeat center center; background-size: cover;width:100%; height: 100%;">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card shadow wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                                <div class="card-body">
                                    <form action="{{ route('jadwal.store') }}" method="post"
                                        onsubmit="return confirm('Yakin ingin memesan ?')">
                                        @csrf
                                        <h3 class="card-title text-center py-2">
                                            Form Booking - {{ $type->name }}
                                        </h3>

                                        <input type="hidden" name="typeId" value="{{ $type->id }}" />
                                        <input type="hidden" name="userId" value="{{ auth()->user()->id }}" />
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control " name="name" id="nama"
                                                placeholder="Admin" value="{{ auth()->user()->name }}" />
                                            <label for="nama">Nama Lengkap*</label>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control " name="phone" id="whatsapp"
                                                placeholder="Whatsapp" pattern="^08\d{9,}$" required
                                                value="{{ auth()->user()->phone }}" />
                                            <label for="whatsapp">Whatsapp*</label>
                                            <small>*Format penulisan whatsapp: 6281389900277</small>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        @if ($type->slug === 'portrait')
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" name="numberOfPerson"
                                                    id="orang" value="" placeholder="Jumlah Orang" min="1"
                                                    max="20" />
                                                <label for="orang">Jumlah Orang*</label>
                                            </div>

                                            {{-- Datepicker dan sesi jam --}}
                                            @include('guest.partials.sesi-booking')
                                        @elseif ($type->slug === 'wedding')
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="package" required>
                                                    <option value="">-- Pilih Paket --</option>
                                                    @foreach ($type->moreDetails['packageOptions'] as $package)
                                                        <option value="{{ $package['name'] }}">
                                                            {{ $package['name'] }} -
                                                            Rp{{ number_format($package['price']) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label>Paket Wedding</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="location" required>
                                                    <option value="">-- Pilih Lokasi --</option>
                                                    @foreach ($type->moreDetails['locationSurcharge'] as $loc => $charge)
                                                        <option value="{{ $loc }}">
                                                            {{ $loc }}
                                                            {{ $charge > 0 ? '(+Rp' . number_format($charge) . ')' : '(Gratis)' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label>Lokasi</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="date" name="date" class="form-control" required>
                                                <label>Tanggal Acara</label>
                                            </div>
                                        @elseif ($type->slug === 'keluarga')
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" name="numberOfPerson"
                                                    placeholder="Jumlah Orang" required>
                                                <label>Jumlah Orang*</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="location_type" required>
                                                    <option value="">-- Pilih Tipe Lokasi --</option>
                                                    @foreach ($type->moreDetails['locationOptions'] as $opt)
                                                        <option value="{{ $opt['type'] }}">{{ $opt['type'] }} -
                                                            Rp{{ number_format($opt['price']) }}</option>
                                                    @endforeach
                                                </select>
                                                <label>Tipe Lokasi</label>
                                            </div>

                                            {{-- Datepicker dan sesi jam --}}
                                            @include('guest.partials.sesi-booking')
                                        @endif

                                        <div class="mb-3">
                                        </div>
                                        {{-- <div class="mb-3">
                                            <div class="g-recaptcha w-100"
                                                data-sitekey="6LeWyRAlAAAAAEiwHZ6IIQDIcUainrSVLqcblEJI"></div>
                                        </div> --}}

                                        <div class="mb-3 d-flex align-items-center">
                                            <p>Syarat & Ketentuan: <button data-bs-toggle="modal" data-bs-target="#sk"
                                                    type="button" class="btn badge bg-primary">baca</button></p>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary w-100">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
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
                    {!! nl2br(e($type->terms_and_conditions)) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/guest/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(() => {
            // Tampilkan loading
            $('#loading').removeClass('d-none');
            $('#sesi_booking').html('');
            const tanggal = formattedDate(new Date());
            getSesi(tanggal);
        });

        const formattedDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        const hari_libur = [];

        const getSesi = (tanggal) => {
            if (hari_libur.includes(tanggal)) {
                // Sembunyikan loading
                $('#loading').addClass('d-none');
                // Tampilkan jam booking
                $('#sesi_booking').html(
                    `<p class="text-center">Mohon maaf Studio hari ini <strong>LIBUR</strong>, silakan pilih tanggal lain.</p>`
                );
                return;
            }
            $.ajax({
                url: "{{ route('jadwal.booked') }}",
                type: 'GET',
                data: {
                    tanggal,
                    typeId: "{{ $type->id }}"
                },
                success: function(data) {
                    const {
                        sesi,
                        is_booked,
                        is_passed = []
                    } = data;
                    const jam_booked = [...is_booked.map(appointment => appointment.jam), ...is_passed];
                    const filteredArray = jam_booked.filter((value, index) => {
                        return jam_booked.indexOf(value) === index;
                    });
                    if (filteredArray.length < sesi.length) {
                        $('#sesi_booking').html(`
                        <div class="row justify-content-center">
                            ${renderSesiBooking(sesi, jam_booked)}
                        </div>
                    `);
                    } else {
                        $('#sesi_booking').html(
                            `<p class="text-center">Tidak ada sesi booking yang tersedia, silakan pilih tanggal lain.</p>`
                        );
                    }
                    // Sembunyikan loading
                    $('#loading').addClass('d-none');
                },
                error: function(err) {
                    // Sembunyikan loading
                    $('#loading').addClass('d-none');
                    $('#sesi_booking').html(err?.responseJSON?.message);
                    Swal.fire({
                        title: 'Error!',
                        text: err?.responseJSON?.message,
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                }
            });
        }

        const renderSesiBooking = (sesi, is_booked) => {
            return sesi.map((jam, i) => {
                if (!is_booked.includes(jam)) {
                    return `
                    <div class="col-4 my-1 col-lg-3 btn-group">
                    <input type="radio" class="btn-check" value="${jam}" name="time" id="${jam}"/>
                    <label class="btn btn-outline-primary w-100" for="${jam}">${jam}</label>
                    </div>
                `;
                }
            }).join('');
        }

        $('#dtpc').datepicker({
            startDate: new Date(),
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            inline: true,
            datesDisabled: hari_libur,
            autoclose: true,
        }).on('changeDate', function(e) {
            // set value tgl_booking
            $('#tgl_booking').val(formattedDate(e.date));
            // Tampilkan loading
            $('#loading').removeClass('d-none');
            $('#sesi_booking').html('');
            const tanggal = formattedDate(e.date);
            getSesi(tanggal);
        });
    </script>
@endsection
