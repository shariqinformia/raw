@extends('layouts.main')

@section('title', 'Service')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Service') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Service') }}</li>
            <li class="breadcrumb-item active">{{ __('Change') }}</li>
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

    <div class="row">
        <div class="col-md-12">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('backend.services.update', $service) }}" enctype="multipart/form-data" method="POST"
                  id="{{($idFormEdit == true) ? 'editFormHandler': ''}}">
                @csrf
                @method('PUT')
                @include('backend.services._form')
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Change') }}
                            </button>
                            <a href="{{ route('backend.services.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>

                    </div>
                </div>
            </form>
            <hr>
            <div class="card mb-4">
                <div class="card-body">
                    @can('delete service')
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteUser">
                            <i class="fas fa-trash-alt mr-2"></i>
                            {{ __('Delete Service') }}
                        </button>
                    @endcan
                </div>
            </div>

            @can('delete service')
                {{-- Delete user --}}
                <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteUserLabel">{{ __('delete service') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('backend.services.destroy', $service) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <div class="alert alert-danger">
                                        {{ __('Delete service?') }}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times mr-2"></i>
                                        {{ __('Cancel') }}
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>

@endsection

@push('js')
    <script>
    </script>
@endpush
