@extends('admin.layouts.main')

@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <form action="{{ route('transaction.tandai-selesai.action', $transaction) }}" method="post"
                        onsubmit="return confirm('Yakin ingin menjalankan aksi ini?')">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Pemesan</label>
                            <input type="text" class="form-control" name="name" disabled
                                value="{{ $transaction->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Tanggal & Waktu</label>
                            <input type="text" class="form-control" name="name" disabled
                                value="{{ $transaction->date }} {{ $transaction->time }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Kekurangan Pembayaran</label>
                            <input type="text" class="form-control " name="bayar" id="bayar"
                                value="{{ StrHelper::currency($transaction->totalPrice - $transaction->downPayment, 'Rp') }}"
                                disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Link Drive</label>
                            <input type="text" class="form-control @error('linkDrive') is-invalid @enderror"
                                name="linkDrive" id="linkDrive" value="{{ old('linkDrive') }}">
                            @error('linkDrive')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
