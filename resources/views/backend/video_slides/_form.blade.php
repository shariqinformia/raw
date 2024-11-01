<div class="card mb-4">
    <div class="card-body">
        <div class="text-right mb-3">
            <a href="{{ route('backend.video_slides.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Return') }}
            </a>
        </div>
        <div class="row">

            <div class="form-group col-md-12">
                <label>{{ __('Name') }} <span class="text-red">*</span></label>
                <input type="text" name="name" id="serviceName" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $video_slide->name) }}">
                @error('name')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>

            <div class="form-group col-md-12">
                <label>{{ __('URL') }} <span class="text-red">*</span></label>
               <input type="text" name="url" id="serviceUrl" class="form-control @error('url') is-invalid @enderror"
                    value="{{ old('url', $video_slide->url) }}" readonly
                     data-url-template="{{ config('app.url') }}/video-slides/">
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
                       value="{{ old('password', $video_slide->password) }}">
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
{{--                       value="{{ old('default_no_of_images', $video_slide->default_no_of_images) }}">--}}
{{--                @error('default_no_of_images')--}}
{{--                <small class="invalid-feedback" role="alert">--}}
{{--                    {{ $message }}--}}
{{--                </small>--}}
{{--                @enderror--}}
{{--            </div>--}}
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="videos">{{ __('Videos') }} <span class="text-red">*</span></label>
                <input {{($idFormEdit == true) ? '': 'required'}}  type="file" name="videos[]" multiple
                       class="form-control @error('videos.*') is-invalid @enderror">
                @error('videos')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
                @error('videos.*')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>


        <!-- Display current images if they exist -->
        <div class="row">
            @if ($video_slide->videos && $video_slide->videos->isNotEmpty())
                <div class="col-md-12">
                    <label>Current Videos</label>
                    <div class="service-videos">
                        @foreach($video_slide->videos as $video)
                            <video width="320" height="240" controls class="mb-2">
                                <source src="{{ asset('uploads/video_slides/' . $video->file_name) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>


        <div class="row">
            <div class="form-group col-md-12">
                <label>{{ __('Description') }}</label>
                <textarea id="description" name="description" class="form-control" rows="4"
                          cols="50">{{ old('description', $video_slide->description) }}</textarea>
            </div>
        </div>

    </div>
</div>



