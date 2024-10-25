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
              
                <p class="fakeimg">{{ $slug->description }}</p>
                
                @if ($slug->images && $slug->images->isNotEmpty())
                    <div class="service-images">
                        @foreach($slug->images as $image)
                            <img src="{{ asset('uploads/services/' . $image->file_name) }}"
                                 alt="{{ $slug->name }}" width="250" height="250" class="img-fluid mb-2">
                        @endforeach
                    </div>
                @else
                    <p>No images available for this service.</p>
                @endif
                
            </div>
        </div>
    </div>

    <div class="mt-5 footer text-white text-center">
        <p>Email:informiatech.com</p>
        <p>Phone:(821) 444 5555</p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap JS and Modal Trigger -->
<script>
    // Show the modal on page load if password is not validated
    @if (!$passwordValid)
        var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'), {
            backdrop: 'static',
            keyboard: false
        });
        passwordModal.show();
    @endif
</script>
<script>
    // Show the modal on page load
    window.onload = function() {
        $('#passwordModal').modal('show');
    };
</script>