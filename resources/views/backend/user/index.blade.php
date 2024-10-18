@extends('layouts.main')

@section('title', 'User')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Users') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('User') }}</li>
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
                        {{ __('Data User') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">

                        <form action="{{ route('backend.users.index') }}" method="GET"
                              class="d-flex  align-items-center">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search users..."
                                       value="{{ request('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="filterByRole ml-5 d-flex align-items-center">
                                <div class="form-group">
                                    <select name="role" class="form-control" style="width:300px;">
                                        <option value="">All Roles</option>
                                        @foreach ($roles as $roleName)
                                            <option value="{{ $roleName }}"
                                                {{ request()->get('role') == $roleName ? 'selected' : '' }}>
                                                {{ ucfirst($roleName) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Sorting control (optional) -->
                                <input type="hidden" name="sort" value="{{ $sort }}">
                                <button type="submit" class="btn btn-primary form-group ml-2">Filter</button>
                            </div>
                        </form>
                        @can('add user')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.users.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add user') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th><a
                                        href="{{ route('backend.users.index', ['sort' => $sort == 'asc' ? 'desc' : 'asc']) }}">
                                        ID
                                        @if ($sort == 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone number') }}</th>
                                <th>{{ __('Role') }}</th>
                                <th>{{ __('Date created') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="searchHide">
                            @php
                                $loggedUser = auth()->user();
                            @endphp
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @if ($user->image == null)
                                            <img src="{{ asset('images/placeholderimage.jpg') }}" width="70" height="70"
                                                 alt="User Image">
                                        @else
                                            <img src="{{ asset($user->image) }}" width="70" height="70"
                                                 alt="User Image">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->telephone }}</td>
                                    <td>
                                        @foreach ($user->roles as $user_role)
                                            <span class="badge badge-info">{{ $user_role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if (in_array('Super Admin', $user->roles->pluck('name')->toArray()))
                                        @else
                                            @can('change user')
                                                <a href="{{ route('backend.users.edit', $user) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit mr-2"></i>
                                                    {{ __('Change') }}
                                                </a>
                                            @endcan
                                        @endif
                                        @can('see user')
                                            <a href="{{ route('backend.users.show', $user) }}"
                                               class="btn btn-secondary btn-sm">
                                                <i class="fas fa-eye mr-2"></i>
                                                {{ __('Detail') }}
                                            </a>
                                        @endcan
                                    </td>

                                    @canBeImpersonated($user, $guard = null)
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{ route('impersonate', $user->id) }}">Log in as {{ $user->name }}</a>
                                        </td>
                                    @endCanBeImpersonated


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted"><i>{{ __('No User Found') }}</i>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $users->appends(request()->except('page'))->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // $(document).ready(function() {
        //     const url = '/backend/user/search';
        //     setupSearchInput(url);
        // });
    </script>
@endpush
