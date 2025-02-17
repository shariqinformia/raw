@extends('layouts.main')

@section('title', 'Image Slide')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('ImageSlide') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('ImageSlide') }}</li>
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

            <form action="{{ route('backend.image_slides.update', $image_slide) }}" enctype="multipart/form-data" method="POST"
                  id="{{($idFormEdit == true) ? 'editFormHandler': ''}}">
                @csrf
                @method('PUT')
                @include('backend.image_slides._form')
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Change') }}
                            </button>
                            <a href="{{ route('backend.image_slides.index') }}" class="btn btn-secondary">
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
                            {{ __('Delete ImageSlide') }}
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
                                <h5 class="modal-title" id="deleteUserLabel">{{ __('Delete Image Slide') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('backend.image_slides.destroy', $image_slide) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <div class="alert alert-danger">
                                        {{ __('Delete Image Slide?') }}
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
        $(document).ready(function() {
            $('#serviceName').on('input', function() {
                let name = $(this).val().trim();
                let slug = name.toLowerCase().replace(/\s+/g, '-'); // Convert to slug

                $('#slug').val(slug); // Set the new URL in the URL field

                let urlTemplate = $('#serviceUrl').data('url-template');
                $('#serviceUrl').val(urlTemplate + slug); // Set the new URL in the URL field
            });
        });

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }


    </script>
@endpush
