<div class="card mb-4">
    <div class="card-body">
        <div class="text-right mb-3">
            <a href="{{ route('backend.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Return') }}
            </a>
        </div>
        <div
            class="alert alert-info"><?php echo e(__('User will receive an email containing a randomly generated password')); ?></div>

        <div class="row">

            <div class="form-group col-md-8">
                <label for="user_type">{{ __('User Type') }} <span
                        class="text-red">*</span></label>
                <select name="user_type" id="user_type" class="form-control" required>
                    <option value="" disabled selected>Select User Type</option>
                    @foreach ($roles as $role)
                        <option
                            value="{{ $role->id }}" {{ (in_array($role->id, $user->roles->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                <br>
                <div id="corporate_message" class="alert alert-info" style="display: none;">
                    <?php echo e(__('Please note, this user will have access to view and monitor all delegates assigned to this Corporate Client')); ?>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="user_type">{{ __('Profile Image') }} <span
                        class="text-red">*</span></label>
                <div class='file-input'>
                    <input type='file' name="image">
                    <span class='button'>Choose</span>
                    <span class='label' data-js-label>No file selected</label>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="form-group col-md-4">
                <label>{{ __('First Name') }} <span
                        class="text-red">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}">
                @error('name')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>{{ __('Middle Name(s)') }}</label>
                <input type="text" name="middle_name" class="form-control"
                       value="{{ old('middle_name', $user->middle_name) }}">
            </div>
            <div class="form-group col-md-4">
                <label>{{ __('Last Name') }} <span
                        class="text-red">*</span></label>
                <input type="text" name="last_name"
                       class="form-control @error('last_name') is-invalid @enderror"
                       value="{{ old('last_name', $user->last_name) }}">
                @error('last_name')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>


        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label>{{ __('Email Address') }} <span
                        class="text-red">*</span></label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}">
                @error('email')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>{{ __('D.O.B') }}</label>

                <input type="date" name="birth_date" class="form-control date"
                       value="{{ old('birth_date', $user->birth_date) }}" placeholder="day–month–year"/>

            </div>
            <div class="form-group col-md-4">
                <label>{{ __('Full Address') }}</label>
                <input type="text" name="address" class="form-control"
                       value="{{ old('address', $user->address) }}">
            </div>
        </div>


        <div class="row">
            <div class="form-group col-md-4">
                <label>{{ __('Company Name') }}</label>
                <input type="text" name="company" class="form-control @error('company') is-invalid @enderror"
                       value="{{ old('company', $user->company) }}">
                @error('company')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>{{ __('Website') }}</label>
                <input type="text" name="website" class="form-control"
                       value="{{ old('website', $user->website) }}">
            </div>
            <div class="form-group col-md-4">
                <label>{{ __('Telephone') }} <span
                        class="text-red">*</span></label>


                <input type="text" name="telephone" id="phone"
                       class="form-control @error('telephone') is-invalid @enderror"
                       value="{{ old('telephone', $user->telephone) }}">
                @error('telephone')
                <small class="invalid-feedback" role="alert">
                    {{ $message }}
                </small>
                @enderror


            </div>
        </div>

    </div>
</div>


@push('css')
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

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {


            function inputFile() {
                let inputs = document.querySelectorAll('.file-input')

                for (let i = 0, len = inputs.length; i < len; i++) {
                    customInput(inputs[i])
                }

                function customInput(el) {
                    const fileInput = el.querySelector('[type="file"]')
                    const label = el.querySelector('[data-js-label]')

                    fileInput.onchange =
                        fileInput.onmouseout = function () {
                            if (!fileInput.value) return

                            let value = fileInput.value.replace(/^.*[\\\/]/, '')
                            el.className += ' -chosen'
                            label.innerText = value
                        }
                }
            }

            inputFile();

            $('#phone').mask('+44 00 0000 0000');


            const formId = $('#editFormHandler');
            if (formId) {
                function toggleSections() {
                    var userType = $('#user_type option:selected').val();
                    var userText = $.trim($('#user_type option:selected').text());

                    if (userType === '4' && userText === 'Learner') {
                        $('#cohorts_section').show();
                        $('#classroom_based_courses').show();
                        $('#elearning_courses_section').show();
                    } else {
                        $('#cohorts_section').hide();
                        $('#classroom_based_courses').hide();
                        $('#elearning_courses_section').hide();
                    }
                }

                toggleSections();

                $('#user_type').change(function () {
                    toggleSections();
                });
            }
        });


        $(document).ready(function () {
            // Function to handle AJAX request for sorting
            function sortCohorts(field, order) {
                $.ajax({
                    url: "{{ route('backend.users.create') }}",
                    type: "GET",
                    data: {
                        sortField: field,
                        sortOrder: order
                    },
                    success: function (data) {
                        $('#cohorts_table tbody').html($(data).find('tbody').html());
                    }
                });
            }

            // Click event for sorting
            $('.sort-link').click(function () {
                var field = $(this).data('field');
                var currentOrder = $(this).data('order');
                var newOrder = currentOrder === 'asc' ? 'desc' : 'asc';

                // Update data attributes for next click
                $(this).data('order', newOrder);

                // Change icon based on order
                $(this).find('i').toggleClass('fa-sort-up fa-sort-down');

                // Perform sorting
                sortCohorts(field, newOrder);
            });
        });

    </script>
@endpush

