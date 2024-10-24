<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 5 Website Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>
<body>

<div class="p-5 bg-primary text-white text-center">
    <h1>{{$slug->name}}</h1>
    <p>{{$slug->description}}</p>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
        </div>
    </div>
</div>

<div class="mt-5 p-4 bg-dark text-white text-center">
    <p>Footer</p>
</div>

</body>
</html>
