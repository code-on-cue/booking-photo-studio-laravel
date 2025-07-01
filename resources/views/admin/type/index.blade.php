@extends('admin.layouts.main')

@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <form action="{{ route('type.index') }}">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ request()->get('search') }}"
                                        name="search" placeholder="Cari nama tipe...">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-primary d-block" style="width: 100%">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Harga Dasar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($collection as $item)
                                <tr>
                                    <td>{{ ($collection->currentPage() - 1) * $collection->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        @php
                                            $details = $item->moreDetails ?? [];
                                            $price =
                                                $details['price'] ??
                                                ($details['packageOptions'][0]['price'] ??
                                                    ($details['locationOptions'][0]['price'] ?? '-'));
                                        @endphp
                                        @if (is_numeric($price))
                                            Rp{{ number_format($price, 0, ',', '.') }}
                                        @else
                                            <span class="text-muted">{{ $price }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('type.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
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
