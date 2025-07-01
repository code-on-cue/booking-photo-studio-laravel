@extends('admin.layouts.main')

@section('title', 'Edit Tipe: ' . $item->name)

@section('content')
    <form action="{{ route('type.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">Edit Tipe</div>
            <div class="card-body">
                <div class="form-group mb-2">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ old('name', $item->name) }}" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $item->slug) }}" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <label>Banner (nama file)</label>
                    <input type="file" name="banner" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah banner.</small>
                    @if ($item->banner)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $item->banner) }}" alt="Banner" class="img-fluid"
                                style="max-width: 200px;">
                        </div>
                    @endif
                </div>

                <div class="form-group mb-2">
                    <label>Syarat & Ketentuan</label>
                    <textarea name="terms_and_conditions" class="form-control" rows="3">{{ old('terms_and_conditions', $item->terms_and_conditions) }}</textarea>
                </div>

                <div class="form-group mb-2">
                    <label>More Details (JSON)</label>
                    <textarea name="moreDetails" class="form-control" rows="15">{{ old('moreDetails', json_encode($item->moreDetails, JSON_PRETTY_PRINT)) }}</textarea>
                    <small class="text-muted">Edit konfigurasi dinamis dalam format JSON.</small>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('type.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
@endsection
