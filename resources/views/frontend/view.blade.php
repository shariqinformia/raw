<!DOCTYPE html>
<html lang="en">
<head>
    <title>Emarketing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>

        .container-fluid.header {
            background: #000000;
            justify-content: center;
            display: flex;
            align-items: center;
        }

        p.fakeimg {
            text-align: center;
            font-size: 18px;
            padding: 20px;
            margin-bottom: 50px;
        }

        .container-fluid.header .fakeimg {
            color: #fff;
            font-size: 60px;
            text-align: center;
            font-weight: 600;
        }

        .footer {
            background: #000;
            display: flex;
            justify-content: center;
            gap: 50px;
            font-size: 20px;
        }
    </style>
</head>
<body>

<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if ($errors->has('password'))
                    <p style="color: red;">{{ $errors->first('password') }}</p>
                @endif

                <form action="{{ route('service.show', $slug->slug) }}" method="POST" id="passwordForm">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="serviceContent" style="display: {{ $passwordValid ? 'block' : 'none' }};">
    <div class="container-fluid header">
        <div class="row">
            <div class="col-sm-12 col-sm-12">
                <div class="fakeimg">{{ $slug->name }}</div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">


                <div id="fullView" class="fullView" style="display: none">
                    <p class="fakeimg">{{ $slug->description }}</p>
                    @if ($slug->images && $slug->images->isNotEmpty())
                        <div class="service-images">
                            @foreach($slug->images as $image)
                                <img src="{{ asset('uploads/image_slides/' . $image->file_name) }}"
                                     alt="{{ $slug->name }}" width="250" height="250" class="img-fluid mb-2">
                            @endforeach
                        </div>
                    @else
                        <p>No images available for this service.</p>
                    @endif
                </div>

                <div id="passView" class="passView">
                    <p class="fakeimg">{{ $slug->description }}</p>
                    @if ($slug->images && $slug->images->isNotEmpty())
                        <div class="service-images">
                            @foreach($slug->images->take($slug->default_no_of_images) as $image)
                                <img src="{{ asset('uploads/image_slides/' . $image->file_name) }}"
                                     alt="{{ $slug->name }}" width="250" height="250" class="img-fluid mb-2">
                            @endforeach
                        </div>
                    @else
                        <p>No images available for this service.</p>
                    @endif
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                            data-bs-target="#readMoreModal">
                        Read More
                    </button>
                </div>


            </div>


            <div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="readMoreModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="readMoreModalLabel">Contact Us</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="contactForm" method="POST">
                                @csrf
                                <input type="hidden" name="service_id" value="{{$slug->id}}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <div id="formMessage" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="mt-5 footer text-white text-center">
        <p>Email:informiatech.com</p>
        <p>Phone:(821) 444 5555</p>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Show the modal on page load if password is not validated
    @if (!$passwordValid)
    var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'), {
        backdrop: 'static',
        keyboard: false
    });
    passwordModal.show();
    @endif

    window.onload = function () {
        $('#passwordModal').modal('show');
    };



    $(document).ready(function () {
        $('#contactForm').on('submit', function (event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('leads.store') }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    $('#formMessage').html('<div class="alert alert-success">Message sent successfully!</div>');
                    $('#contactForm')[0].reset(); // Reset the form
                    $('#passView').hide();
                    $('#fullView').show();
                    $('#readMoreModal').modal('hide'); // Close the modal
                },
                error: function (xhr) {
                    $('.error-message').remove(); // Clear any previous error messages
                    if (xhr.status === 422) { // Laravel validation error status
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (field, messages) {
                            let inputField = $('[name="' + field + '"]');
                            inputField.after('<div class="error-message text-danger">' + messages[0] + '</div>');
                        });
                    } else {
                        $('#formMessage').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                    }
                }
            });
        });

        // Reset scroll behavior when modal is closed
        $('#readMoreModal').on('hidden.bs.modal', function () {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $('body').css('overflow', 'auto'); // Ensure scrolling is enabled
        });
    });



</script>



