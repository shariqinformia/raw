@extends('layouts.main')

@section('title', 'Service')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Service') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('User') }}</li>
            <li class="breadcrumb-item active">{{ __('Add') }}</li>
        </ol>
    </div>
@endsection

@push('css')
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css"/>--}}
    <style>
        .file-input {
            display: inline-block;
            text-align: left;
            background: #e5e5e5;
            width: 100%;
            position: relative;
            border-radius: 3px;
        }

        .file-input > [type='file'] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            z-index: 10;
            cursor: pointer;
        }

        .file-input > .button {
            display: inline-block;
            cursor: pointer;
            background: #eee;
            padding: 8px 16px;
            border-radius: 2px;
            margin-right: 8px;
        }

        .file-input:hover > .button {
            background: dodgerblue;
            color: white;
        }

        .file-input > .label {
            color: #333;
            white-space: nowrap;
            opacity: .3;
        }

        .file-input.-chosen > .label {
            opacity: 1;
        }
    </style>
@endpush

@section('main')

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('backend.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('backend.services._form')
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('backend.services.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@push('js')

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>--}}
{{--    <script>--}}
{{--        Dropzone.options.imageUpload = {--}}
{{--            url: "{{ route('backend.services.store') }}",  // Your form submit URL--}}
{{--            maxFiles: 5, // Adjust this based on your requirements--}}
{{--            maxFilesize: 5, // In MB--}}
{{--            acceptedFiles: 'image/*',--}}
{{--            addRemoveLinks: true,--}}
{{--            autoProcessQueue: false, // Prevent auto-upload--}}
{{--            parallelUploads: 5, // Number of images to upload in parallel--}}

{{--            init: function () {--}}
{{--                var myDropzone = this;--}}

{{--                // Handle form submission--}}
{{--                document.querySelector("form").addEventListener("submit", function (e) {--}}
{{--                    e.preventDefault();--}}
{{--                    e.stopPropagation();--}}

{{--                    // Process Dropzone images--}}
{{--                    myDropzone.processQueue();--}}
{{--                });--}}

{{--                // When files are added--}}
{{--                this.on("addedfile", function (file) {--}}
{{--                    console.log("File added:", file);--}}
{{--                });--}}

{{--                // When a file is successfully uploaded--}}
{{--                this.on("success", function (file, response) {--}}
{{--                    console.log("File uploaded successfully:", response);--}}
{{--                });--}}

{{--                // When all files are uploaded--}}
{{--                this.on("queuecomplete", function () {--}}
{{--                    console.log("All files uploaded.");--}}
{{--                });--}}
{{--            }--}}
{{--        };--}}
{{--    </script>--}}
@endpush
