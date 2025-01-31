@extends('layouts.main')

@section('title', 'Leave')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Leave') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('Leave') }}</li>
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('Data Leave') }}
                </h3>
            </div>
            <div class="card-body">
                @can('add leave')
                <div class="text-right mb-3">
                    <a href="{{ route('backend.leaves.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle mr-2"></i>
                        {{ __('Add leave') }}
                    </a>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('Type of leave') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Reason') }}</th>
                                <th>{{ __('Date created') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->id }}</td>
                                <td>{{ strtoupper(str_replace("_"," ",$leave->type_of_leave)) }}</td>
                                <td>{{ \Carbon\Carbon::parse($leave->leave_date)->format('d M, Y') }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td>{{ $leave->created_at->diffForHumans() }}</td>
                                <td>
                                    @if ($leave->name == "Super Admin")
                                    <i class="text-muted">{{ __('Default leave') }}</i>
                                    @else
                                    @can('change leaves')
                                    <a href="{{ route('backend.leaves.edit', $leave->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit mr-2"></i>
                                        {{ __('Change') }}
                                    </a>
                                    @endcan
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <i>{{ __('No leaves found') }}</i>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
