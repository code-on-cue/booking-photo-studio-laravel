@extends('admin.layouts.main')

@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <form action="{{ route('config.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h3 class="mb-4">Umum</h3>

                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="appName">Nama Aplikasi</label>
                                    <input type="text" class="form-control @error('appName') is-invalid @enderror"
                                        name="appName" id="appName" value="{{ old('appName') ?? $config->appName }}">
                                    @error('appName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <div class="form-group">
                                    <label for="whatsapp">Nomor Whatsapp</label>
                                    <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                        name="whatsapp" id="whatsapp" value="{{ old('whatsapp') ?? $config->whatsapp }}">
                                    @error('whatsapp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                        name="instagram" id="instagram"
                                        value="{{ old('instagram') ?? $config->instagram }}">
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" cols="30"
                                        rows="10">{{ old('address') ?? $config->address }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-5">
                                <div class="form-group">
                                    <label for="map">Map</label>
                                    <textarea name="map" class="form-control @error('map') is-invalid @enderror" id="map" cols="30"
                                        rows="10">{{ old('map') ?? $config->map }}</textarea>
                                    @error('map')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <h3 class="mb-4">Pembayaran</h3>

                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="accountSource">Sumber Rekening</label>
                                    <input type="text"
                                        class="form-control @error('accountSource') is-invalid @enderror"
                                        name="accountSource" id="accountSource"
                                        value="{{ old('accountSource') ?? $config->accountSource }}">
                                    @error('accountSource')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="accountNumber">Nomor Rekening</label>
                                    <input type="text"
                                        class="form-control @error('accountNumber') is-invalid @enderror"
                                        name="accountNumber" id="accountNumber"
                                        value="{{ old('accountNumber') ?? $config->accountNumber }}">
                                    @error('accountNumber')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-5">
                                <div class="form-group">
                                    <label for="accountHolder">AN Rekening</label>
                                    <input type="text"
                                        class="form-control @error('accountHolder') is-invalid @enderror"
                                        name="accountHolder" id="accountHolder"
                                        value="{{ old('accountHolder') ?? $config->accountHolder }}">
                                    @error('accountHolder')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-1">
                                <button class="btn btn-success">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
