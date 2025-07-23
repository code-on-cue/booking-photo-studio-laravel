@extends('admin.layouts.main')

@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <form action="{{ route('transaction.index') }}">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ request()->get('search') }}"
                                        name="search">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-primary d-block" style="width: 100%">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>TRX ID</td>
                                <td>Tanggal</td>
                                <td>Pemesan</td>
                                <td>Status</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collection as $item)
                                <tr>
                                    <td>
                                        {{ ($collection->currentPage() - 1) * $collection->perPage() + $loop->iteration }}
                                    </td>
                                    <td>#{{ $item->trxId }}</td>
                                    <td>{{ $item->date }}, {{ $item->time }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        @if ($item->status == 'process' || $item->status == 'success')
                                            <a href="{{ route('transaction.tandai-selesai', $item) }}"
                                                class="btn btn-primary">Tandai Selesai</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $collection->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
