@extends('layouts.main')

@section('title', 'Leave')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('change leaves') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Leave') }}</li>
        <li class="breadcrumb-item active">{{ __('Change') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ __('Form change leaves') }}
            </div>
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('backend.leaves.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <form action="{{ route('backend.leaves.update', $leave) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('backend.leaves._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Change') }}
                        </button>
                        <a href="{{ route('backend.leaves.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
                <hr>
                @can('delete leave')
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteLeave">
                    <i class="fas fa-trash-alt mr-2"></i>
                    {{ __('Delete Leave') }}
                </button>
                @endcan
            </div>
        </div>
    </div>
</div>
@can('delete leave')
<div class="modal fade" id="deleteLeave" tabindex="-1" aria-labelledby="deleteLeaveLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLeaveLabel">{{ __('Delete Leave') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('backend.leaves.destroy', $leave) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{ __('Delete this Leave?') }}
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
@endsection
