<div class="card mb-4">
    <div class="card-body">
        <div class="text-right mb-3">
            <a href="{{ route('backend.pdf.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Return') }}
            </a>
        </div>
        <div class="row">

            <div class="form-group col-md-12">
                <label>{{ __('Name') }} <span class="text-red">*</span></label>
                <input type="text" name="name" id="serviceName" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $pdf->name) }}">
                @error('name')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>

            <div class="form-group col-md-12">
                <label>{{ __('URL') }} <span class="text-red">*</span></label>
               <input type="text" name="url" id="serviceUrl" class="form-control @error('url') is-invalid @enderror"
                    value="{{ old('url', $pdf->url) }}" readonly
                     data-url-template="{{ config('app.url') }}/pdf/">
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
                       value="{{ old('password', $pdf->password) }}">
                @error('password')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>

        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="pdfs">{{ __('PDFs') }} <span class="text-red">*</span></label>
                <input {{($idFormEdit == true) ? '' : 'required'}} type="file" name="pdfs[]" multiple accept=".pdf"
                       class="form-control @error('pdfs.*') is-invalid @enderror">
                @error('pdfs')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
                @error('pdfs.*')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>


        <!-- Display current images if they exist -->
        <div class="row">
            @if ($pdf->service_pdfs && $pdf->service_pdfs->isNotEmpty())
                <div class="col-md-12">
                    <label>Current PDFs</label>
                    <div class="service-images">
                        @foreach($pdf->service_pdfs as $service_pdf)
                            <a href="{{ asset('uploads/pdfs/' . $service_pdf->file_name) }}" target="_blank" class="pdf-link">
                                <i class="fas fa-file-pdf"></i> {{ $service_pdf->file_name }}
                            </a><br>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label>{{ __('Description') }}</label>
                <textarea id="description" name="description" class="form-control" rows="4"
                          cols="50">{{ old('description', $pdf->description) }}</textarea>
            </div>
        </div>

    </div>
</div>



