@extends('admin.layouts.main')

@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pendingTransaction }}</h3>
                    <p>Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3 style="color:white">{{ $processTransaction }}</h3>
                    <p style="color:white">Process</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 style="color:white">{{ $successTransaction }}</h3>
                    <p style="color:white">Success</p>
                </div>
            </div>
        </div>
    </div>
@endsection
