@extends('guest.layouts.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('/guest/bootstrap-datepicker.min.css') }}">
@endsection

@section('navbar')
    <li class="scroll-to-section">
        <a href="{{ url('/') }}" class="active">Home</a>
    </li>
    <li class="scroll-to-section">
        <a href="{{ route('login') }}">Login</a>
    </li>
@endsection
@section('content')
    <div class="banner-bookings wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6">
                            <div class="card shadow wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                                <div class="card-body">
                                    <form action="{{ route('jadwal.store') }}" method="post"
                                        onsubmit="return confirm('Yakin ingin memesan ?')">
                                        @csrf
                                        <h3 class="card-title text-center py-2">
                                            Form Booking
                                        </h3>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control " name="name" id="nama"
                                                value="" placeholder="Admin" />
                                            <label for="nama">Nama Lengkap*</label>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control " name="phone" id="whatsapp"
                                                value="" placeholder="Whatsapp" pattern="^08\d{9,}$" required />
                                            <label for="whatsapp">Whatsapp*</label>
                                            <small>*Format penulisan whatsapp: 6281389900277</small>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control " name="numberOfPerson" id="orang"
                                                value="" placeholder="Jumlah Orang" min="1" max="20" />
                                            <label for="orang">Jumlah Orang*</label>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3 w-100">
                                            <div id="dtpc" class="w-100" style="width: 100% !important"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-center">
                                                <div id="loading" class="d-none spinner-border text-primary"
                                                    role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>
                                            <div id="sesi_booking"><i>Pilih tanggal dulu...</i></div>
                                            <input type="hidden" name="date" id="tgl_booking" value="2024-08-09">
                                        </div>
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
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">Biaya 75K/2 orang</li>
                        <li class="list-group-item">Tambahan orang 30K/orang</li>
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
                    tanggal
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
