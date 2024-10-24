@extends('layouts.main')

@section('title', 'User')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Services') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Service') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Service') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        @can('add user')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.services.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add Service') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</a>
                                </th>
                                <th>{{ __('Images') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('URL') }}</th>
                                <th>{{ __('Date created') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="searchHide">
                            @php
                                $loggedUser = auth()->user();
                            @endphp
                            @forelse ($services as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>
                                        @if ($service->images && $service->images->isNotEmpty())
                                            <div class="service-images">
                                                @foreach($service->images as $image)
                                                    <img src="{{ asset('uploads/services/' . $image->file_name) }}"
                                                         alt="{{ $service->name }}" width="70" height="70" class="img-fluid mb-2">
                                                @endforeach
                                            </div>
                                        @else
                                            <img src="{{ asset('images/placeholderimage.jpg') }}" width="70" height="70" alt="Default Image">
                                        @endif
                                    </td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->url }}</td>
                                    <td>{{ $service->created_at->diffForHumans() }}</td>
                                    <td>
                                        @can('change service')
                                            <a href="{{ route('backend.services.edit', $service) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit mr-2"></i>
                                                {{ __('Change') }}
                                            </a>
                                        @endif
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted"><i>{{ __('No Service Found') }}</i>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


