@extends('admin.layouts.main')

@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Nama</td>
                                <td>Kritik / Saran</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collection as $item)
                                <tr>
                                    <td>
                                        {{ ($collection->currentPage() - 1) * $collection->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kritik_saran }}</td>
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
