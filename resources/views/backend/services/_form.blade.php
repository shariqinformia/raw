

<div class="card mb-4">
    <div class="card-body">
        <div class="text-right mb-3">
            <a href="{{ route('backend.services.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Return') }}
            </a>
        </div>
        <div class="row">

            <div class="form-group col-md-4">
                <label>{{ __('Name') }} <span
                        class="text-red">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $service->name) }}">
                @error('name')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label>{{ __('URL') }} <span
                        class="text-red">*</span></label>
                <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                       value="{{ old('url', $service->url) }}">
                @error('url')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label>{{ __('Default No. of Images') }} <span
                        class="text-red">*</span></label>
                <input type="number" name="default_no_of_images"
                       class="form-control @error('default_no_of_images') is-invalid @enderror"
                       value="{{ old('default_no_of_images', $service->default_no_of_images) }}">
                @error('default_no_of_images')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="images">{{ __('Images') }} <span class="text-red">*</span></label>
                <input type="file" name="images[]" multiple class="form-control @error('images.*') is-invalid @enderror">
                @error('images')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
                @error('images.*')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>

        <!-- Display current images if they exist -->
        <div class="row">
            @if ($service->images && $service->images->isNotEmpty())
                <div class="col-md-12">
                    <label>Current Images</label>
                    <div class="service-images">
                        @foreach($service->images as $image)
                            <img src="{{ asset('uploads/services/' . $image->file_name) }}" alt="{{ $service->name }}" width="70" height="70" class="img-fluid mb-2">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label>{{ __('Description') }}</label>
                <textarea id="description" name="description" class="form-control" rows="4"
                          cols="50">{{ old('description', $service->description) }}</textarea>
            </div>
        </div>

    </div>
</div>



