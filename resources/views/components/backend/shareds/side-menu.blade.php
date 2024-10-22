<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


        @can('view dashboard')
            <li class="nav-item">
                <a href="{{ route('backend.dashboard.index') }}"
                   class="nav-link {{ Request::is('backend/dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        {{ __('Admin Dashboard') }}
                    </p>
                </a>
            </li>
        @endcan


        @can('see user')
            <li class="nav-item">
                <a href="{{ route('backend.users.index') }}"
                   class="nav-link {{ Request::is('backend/users') ? 'active' : '' }} {{ Request::is('backend/users/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('User') }}
                    </p>
                </a>
            </li>
        @endcan

        @can('see service')
            <li class="nav-item">
                <a href="{{ route('backend.services.index') }}"
                   class="nav-link {{ Request::is('backend/services') ? 'active' : '' }} {{ Request::is('backend/services/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Service') }}
                    </p>
                </a>
            </li>
        @endcan

        @can('see roles', 'look at permissions', 'see assign permissions')
            <li
                class="nav-item {{ Request::is('backend/roles/*') ? 'menu-open' : '' }} {{ Request::is('backend/roles') ? 'menu-open' : '' }}
                {{ Request::is('backend/permissions/*') ? 'menu-open' : '' }} {{ Request::is('backend/permissions') ? 'menu-open' : '' }}
                {{ Request::is('backend/assignpermission') ? 'menu-open' : '' }} {{ Request::is('backend/assignpermission/*') ? 'menu-open' : '' }}">
                <a href="#"
                   class="nav-link {{ Request::is('backend/roles/*') ? 'active' : '' }} {{ Request::is('backend/roles') ? 'active' : '' }}
                   {{ Request::is('backend/permissions/*') ? 'active' : '' }} {{ Request::is('backend/permissions') ? 'active' : '' }}
                   {{ Request::is('backend/assignpermission') ? 'active' : '' }} {{ Request::is('backend/assignpermission/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-lock"></i>
                    <p>
                        {{ __('Role & Permission') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('see roles')
                        <li class="nav-item">
                            <a href="{{ route('backend.roles.index') }}"
                               class="nav-link
                    {{ Request::is('backend/roles') ? 'active' : '' }} {{ Request::is('backend/roles/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>{{ __('Role') }}</p>
                            </a>
                        </li>
                    @endcan
                    @can('look at permissions')
                        <li class="nav-item">
                            <a href="{{ route('backend.permissions.index') }}"
                               class="nav-link
                    {{ Request::is('backend/permissions') ? 'active' : '' }} {{ Request::is('backend/permissions/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>{{ __('Permission') }}</p>
                            </a>
                        </li>
                    @endcan
                    @can('see assign permissions')
                        <li class="nav-item">
                            <a href="{{ route('backend.assignpermission.index') }}"
                               class="nav-link
                    {{ Request::is('backend/assignpermission') ? 'active' : '' }} {{ Request::is('backend/assignpermission/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-check"></i>
                                <p>{{ __('Assign permission') }}</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan


        <li class="nav-item">
            <a href="{{ route('clear-cache') }}"
               class="nav-link">
                <i class="nav-icon fas fa-braille"></i>
                <p>
                    {{ __('Clear Cache') }}
                </p>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    {{ __('Logout') }}
                </p>
            </a>
        </li>


    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>
