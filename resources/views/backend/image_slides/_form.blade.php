<div class="card mb-4">
    <div class="card-body">
        <div class="text-right mb-3">
            <a href="{{ route('backend.image_slides.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Return') }}
            </a>
        </div>
        <div class="row">

            <div class="form-group col-md-12">
                <label>{{ __('Name') }} <span class="text-red">*</span></label>
                <input type="text" name="name" id="serviceName" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $image_slide->name) }}">
                @error('name')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>

            <div class="form-group col-md-12">
                <label>{{ __('URL') }} <span class="text-red">*</span></label>
               <input type="text" name="url" id="serviceUrl" class="form-control @error('url') is-invalid @enderror"
                    value="{{ old('url', $image_slide->url) }}" readonly
                     data-url-template="{{ config('app.url') }}/service/">
                @error('url')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>

            <input type="hidden" name="slug" id="slug" >

            <div class="form-group col-md-12">
                <label>{{ __('Password') }} <span
                        class="text-red">*</span></label>
                <input type="text" name="password"  onkeypress='return isNumber(event)'
                       class="form-control @error('password') is-invalid @enderror"
                       value="{{ old('password', $image_slide->password) }}">
                @error('password')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>

{{--            <div class="form-group col-md-6">--}}
{{--                <label>{{ __('Default No. of Images') }} <span--}}
{{--                        class="text-red">*</span></label>--}}
{{--                <input type="text" name="default_no_of_images" onkeypress='return isNumber(event)'--}}
{{--                       class="form-control @error('default_no_of_images') is-invalid @enderror"--}}
{{--                       value="{{ old('default_no_of_images', $image_slide->default_no_of_images) }}">--}}
{{--                @error('default_no_of_images')--}}
{{--                <small class="invalid-feedback" role="alert">--}}
{{--                    {{ $message }}--}}
{{--                </small>--}}
{{--                @enderror--}}
{{--            </div>--}}
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="images">{{ __('Images') }} <span class="text-red">*</span></label>
                <input {{($idFormEdit == true) ? '': 'required'}}  type="file" name="images[]" multiple
                       class="form-control @error('images.*') is-invalid @enderror">
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
            @if ($image_slide->images && $image_slide->images->isNotEmpty())
                <div class="col-md-12">
                    <label>Current Images</label>
                    <div class="service-images">
                        @foreach($image_slide->images as $image)
                            <img src="{{ asset('uploads/image_slides/' . $image->file_name) }}" alt="{{ $image_slide->name }}"
                                 width="70" height="70" class="img-fluid mb-2">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label>{{ __('Description') }}</label>
                <textarea id="description" name="description" class="form-control" rows="4"
                          cols="50">{{ old('description', $image_slide->description) }}</textarea>
            </div>
        </div>

    </div>
</div>



