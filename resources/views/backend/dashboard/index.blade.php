@extends('layouts.main')

@section('title', 'Dashboard')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Dashboard') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
@endpush

@section('main')

    <div class="content">
        <div class="adminDashboard">
            <div class="row">
            </div>
        </div>
    </div>

@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
@endpush
