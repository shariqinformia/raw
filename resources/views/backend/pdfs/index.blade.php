@extends('layouts.main')

@section('title', 'Pdf')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Pdfs') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Pdfs') }}</li>
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
                        {{ __('Data Pdfs') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        @can('add user')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.pdf.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add Pdf') }}
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
                                <th>{{ __('Pdf') }}</th>
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
                            @forelse ($pdfs as $pdf)
                                <tr>
                                    <td>{{ $pdf->id }}</td>
                                    <td>
                                        @if ($pdf->service_pdfs && $pdf->service_pdfs->isNotEmpty())
                                            <div class="service-pdfs">
                                                @foreach($pdf->service_pdfs as $service_pdf)
                                                    <a href="{{ asset('uploads/pdfs/' . $service_pdf->file_name) }}" target="_blank" class="pdf-link">
                                                        <i class="fas fa-file-pdf"></i> {{ $service_pdf->file_name }}
                                                    </a><br>
                                                @endforeach
                                            </div>
                                        @else
                                            <span>No PDF available</span>
                                        @endif
                                    </td>

                                    <td>{{ $pdf->name }}</td>
                                    <td> <a target="_blank" href="{{ $pdf->url }}" >{{$pdf->url}}</a></td>
                                    <td>{{ $pdf->created_at->diffForHumans() }}</td>
                                    <td>
                                        @can('change service')
                                            <a href="{{ route('backend.pdf.edit', $pdf) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit mr-2"></i>
                                                {{ __('Change') }}
                                            </a>
                                        @endif
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted"><i>{{ __('No ImageSlide Found') }}</i>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $pdfs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


