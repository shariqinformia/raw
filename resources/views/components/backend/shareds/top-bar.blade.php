<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @can('view dashboard')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('backend.dashboard.index') }}" class="nav-link">{{ __('Dashboard') }}</a>
            </li>
        @endcan
        @can('see settings')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('backend.setting.index') }}" class="nav-link">{{ __('Settings') }}</a>
            </li>
        @endcan
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"></span>
            </a>

            @php
                $loggedUser = auth()->user();
            @endphp

            <a class="btn btn-success btn-sm" href="{{ route('impersonate.leave') }}">Leave Impersonate</a  >


            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" onclick="markAsRead('NOTIFICATION_ID')">
                    <i class="fas fa-file mr-2"></i> New notification
                    <span class="float-right text-muted text-sm">mins ago</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('backend.notifications.index') }}" class="dropdown-item dropdown-footer">See All
                    Notifications</a>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
