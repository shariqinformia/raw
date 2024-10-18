<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ __('Admin area') }}</title>

    <x-shared.ico />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet"
        href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
    @stack('css')
    <style>
        ul.navbar-nav.ml-auto li.nav-item.dropdown.show .dropdown-menu.dropdown-menu-lg.dropdown-menu-right.show {
            max-width: 400px;
            min-width: 400px;
        }

        .notificationWrapper a span {
            display: block;
            width: 100%;
        }

        .notificationWrapper a span.float-right.text-muted.text-sm {
            padding-left: 23px;
        }

        .notificationWrapper {
            border-bottom: solid 1px #ccc;
            display: block;

            padding-bottom: 20px;
        }

        .form-group .d-flex>label {
            font-weight: 400 !important;
        }

        div#loadingSpinner,
        div#loadingSpinner2 {
            position: fixed;
            left: 0;
            right: 0;
            margin: auto;
            top: 0;
            bottom: 0;
            z-index: 99;
            background: #00000036;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        div#loadingSpinner i,
        div#loadingSpinner2 i {
            color: #007bff;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <x-backend.shareds.top-bar />
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <x-backend.shareds.side-menu-logo />

            <!-- Sidebar -->
            <div class="sidebar">

                <x-backend.shareds.side-menu-panel />

                <!-- Sidebar Menu -->
                <x-backend.shareds.side-menu />
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @yield('breadcump')
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('main')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <x-backend.shareds.bottom-bar />
    </div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('admin') }}/plugins/moment/moment.min.js"></script>
    <script>
        // Set Moment.js locale to English
        moment.locale('en');
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin') }}/dist/js/adminlte.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>



    <script>
        // resources/js/app.js or a separate JavaScript file
        function fetchNotifications() {
            $.ajax({
                url: '{{ route('backend.notifications.fetch') }}',
                method: 'GET',
                success: function(data) {
                    var notificationCount = data.length;
                    $('.navbar-badge').text(notificationCount);

                    var notificationList = '';
                    data.forEach(function(notification) {
                        // var formattedDate = new Date(notification.created_at);
                        var formattedDate = new Date(notification.created_at).toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        });
                        notificationList += `
                    <div class="notificationWrapper">
                        <a href="${notification.data.task_url}" class="dropdown-item" onclick="markAsRead('${notification.id}')">
                            <span><i class="fas fa-file mr-2"></i> ${notification.data.message}</span>
                            <span class="float-right text-muted text-sm">${formattedDate}</span>
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                `;
                    });

                    $('.dropdown-menu').html(`
                <span class="dropdown-item dropdown-header">${notificationCount} Notifications</span>
                <div class="dropdown-divider"></div>
                ${notificationList}
                <a href="{{ route('backend.notifications.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            `);
                }
            });
        }

        function markAsRead(id) {
            $.ajax({
                url: '{{ route('backend.notifications.markAsRead') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function() {
                    fetchNotifications();
                }
            });
        }

        $(document).ready(function() {
            fetchNotifications(); // Initial fetch

            // Fetch notifications every 15 seconds
            setInterval(fetchNotifications, 15000);
        });
    </script>

    @stack('js')
</body>

</html>
