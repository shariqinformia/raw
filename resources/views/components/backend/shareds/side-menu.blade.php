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

        @php
            $user = auth()->user();
        @endphp

        @if($user->hasRole('Learner'))
            @can('view learner dashboard')
                <li class="nav-item">
                    <a href="{{ route('backend.learner.dashboard') }}"
                       class="nav-link {{ Request::is('backend/learner-dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            {{ __('Learner Dashboard') }}
                        </p>
                    </a>
                </li>
            @endcan
        @endif

        @if($user->hasRole('Trainer'))
            @can('view trainer dashboard')
                <li class="nav-item">
                    <a href="{{ route('backend.trainer.dashboard') }}"
                       class="nav-link {{ Request::is('backend/trainer-dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            {{ __('Trainer Dashboard') }}
                        </p>
                    </a>
                </li>
            @endcan
        @endif


        <li class="nav-header">{{ __('System') }}</li>

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

        {{--        @canany(['see category', 'see awarding_bodies','see qualification','see exam','see elearning_licences','see venue','see course','see cohorts'])--}}
        {{--            <li--}}
        {{--                class="nav-item {{ Request::is('backend/categories/*') ? 'menu-open' : '' }} {{ Request::is('backend/categories') ? 'menu-open' : '' }}--}}
        {{--        {{ Request::is('backend/courses/*') ? 'menu-open' : '' }} {{ Request::is('backend/courses') ? 'menu-open' : '' }}--}}
        {{--        {{ Request::is('backend/qualifications/*') ? 'menu-open' : '' }} {{ Request::is('backend/qualifications') ? 'menu-open' : '' }}--}}
        {{--        {{ Request::is('backend/exams/*') ? 'menu-open' : '' }} {{ Request::is('backend/exams') ? 'menu-open' : '' }}--}}
        {{--        {{ Request::is('backend/venues/*') ? 'menu-open' : '' }} {{ Request::is('backend/venues') ? 'menu-open' : '' }}--}}
        {{--        {{ Request::is('backend/awarding_bodies/*') ? 'menu-open' : '' }} {{ Request::is('backend/awarding_bodies') ? 'menu-open' : '' }}--}}
        {{--        {{ Request::is('backend/elearning_licences/*') ? 'menu-open' : '' }} {{ Request::is('backend/elearning_licences') ? 'menu-open' : '' }}--}}
        {{--        {{ Request::is('backend/cohorts/*') ? 'menu-open' : '' }} {{ Request::is('backend/cohorts') ? 'menu-open' : '' }}">--}}
        {{--                <a href="#"--}}
        {{--                   class="nav-link {{ Request::is('backend/categories/*') ? 'active' : '' }} {{ Request::is('backend/categories') ? 'active' : '' }}--}}
        {{--        {{ Request::is('backend/courses/*') ? 'active' : '' }} {{ Request::is('backend/courses') ? 'active' : '' }}--}}
        {{--        {{ Request::is('backend/qualifications/*') ? 'active' : '' }} {{ Request::is('backend/qualifications') ? 'active' : '' }}--}}
        {{--        {{ Request::is('backend/exams/*') ? 'active' : '' }} {{ Request::is('backend/exams') ? 'active' : '' }}--}}
        {{--        {{ Request::is('backend/venues/*') ? 'active' : '' }} {{ Request::is('backend/venues') ? 'active' : '' }}--}}
        {{--        {{ Request::is('backend/awarding_bodies/*') ? 'active' : '' }} {{ Request::is('backend/awarding_bodies') ? 'active' : '' }}--}}
        {{--        {{ Request::is('backend/elearning_licences/*') ? 'active' : '' }} {{ Request::is('backend/elearning_licences') ? 'active' : '' }}--}}
        {{--        {{ Request::is('backend/cohorts/*') ? 'active' : '' }} {{ Request::is('backend/cohorts') ? 'active' : '' }}">--}}
        {{--                    <i class="nav-icon fas fa-graduation-cap"></i>--}}
        {{--                    <p>--}}
        {{--                        {{ __('Courses') }}--}}
        {{--                        <i class="right fas fa-angle-left"></i>--}}
        {{--                    </p>--}}
        {{--                </a>--}}
        {{--                <ul class="nav nav-treeview">--}}
        @can('see category')
            <li class="nav-item">
                <a href="{{ route('backend.categories.index') }}"
                   class="nav-link {{ Request::is('backend/categories') ? 'active' : '' }} {{ Request::is('backend/categories/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                    <p>{{ __('Categories') }}</p>
                    </p>
                </a>
            </li>
        @endcan
        @can('see awarding_bodies')
            <li class="nav-item">
                <a href="{{ route('backend.awarding_bodies.index') }}"
                   class="nav-link {{ Request::is('backend/awarding_bodies') ? 'active' : '' }} {{ Request::is('backend/awarding_bodies/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>
                    <p>{{ __('Awarding Bodies') }}</p>
                    </p>
                </a>
            </li>
        @endcan
        @can('see qualification')
            <li class="nav-item">
                <a href="{{ route('backend.qualifications.index') }}"
                   class="nav-link {{ Request::is('backend/qualifications') ? 'active' : '' }} {{ Request::is('backend/qualifications/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-certificate"></i>
                    <p>
                    <p>{{ __('Qualification') }}</p>
                    </p>
                </a>
            </li>
        @endcan
        @can('see exam')
            <li class="nav-item">
                <a href="{{ route('backend.exams.index') }}"
                   class="nav-link {{ Request::is('backend/exams') ? 'active' : '' }} {{ Request::is('backend/exams/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>
                        Exams
                    </p>
                </a>
            </li>
        @endcan

        @can('see elearning_licences')
            <li class="nav-item">
                <a href="{{ route('backend.elearning_licences.index') }}"
                   class="nav-link {{ Request::is('backend/elearning_licences') ? 'active' : '' }} {{ Request::is('backend/elearning_licences/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-laptop"></i>
                    <p>
                        E-learning Licences
                    </p>
                </a>
            </li>
        @endcan

        @can('see venue')
            <li class="nav-item">
                <a href="{{ route('backend.venues.index') }}"
                   class="nav-link {{ Request::is('backend/venues') ? 'active' : '' }} {{ Request::is('backend/venues/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-map-marker-alt"></i>
                    <p>
                        Venues
                    </p>
                </a>
            </li>
        @endcan



        @can('see course')
            <li class="nav-item">
                <a href="{{ route('backend.courses.index') }}"
                   class="nav-link {{ Request::is('backend/courses') ? 'active' : '' }} {{ Request::is('backend/courses/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Courses
                    </p>
                </a>
            </li>
        @endcan

        @can('see cohorts')
            <li class="nav-item">
                <a href="{{ route('backend.cohorts.index') }}"
                   class="nav-link {{ Request::is('backend/cohorts') ? 'active' : '' }} {{ Request::is('backend/cohorts/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                        Cohorts
                    </p>
                </a>
            </li>
        @endcan


        {{--                </ul>--}}
        {{--            </li>--}}
        {{--        @endcanany--}}


        @can('see application-forms')
            <li class="nav-item">
                <a href="{{ route('backend.application-forms.index') }}"
                   class="nav-link {{ Request::is('backend/application-forms') ? 'active' : '' }} {{ Request::is('backend/application-forms/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        {{ __('Application Form') }}
                    </p>
                </a>
            </li>
        @endcan

        @can('see profile photo')
            <li class="nav-item">
                <a href="{{ route('backend.profile-photo.index') }}"
                   class="nav-link {{ Request::is('backend/profile-photo') ? 'active' : '' }} {{ Request::is('backend/profile-photo/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-circle"></i>
                    <p>
                        {{ __('Profile Photo') }}
                    </p>
                </a>
            </li>
        @endcan


        @can('see document uploads')
            <li class="nav-item">
                <a href="{{ route('backend.document-uploads.index') }}"
                   class="nav-link {{ Request::is('backend/document-uploads') ? 'active' : '' }} {{ Request::is('backend/document-uploads/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-id-card"></i>
                    <p>
                        {{ __('Proof of ID') }}
                    </p>
                </a>
            </li>
        @endcan

        @can('see messages')
            <li class="nav-item">
                <a href="{{ route('backend.messages.index') }}"
                   class="nav-link {{ Request::is('backend/messages.index') ? 'active' : '' }} {{ Request::is('backend/messages.index/*') ? 'active' : '' }}">
                    <i class="nav-icon far fa-comments"></i>
                    <p>
                        {{ __('Messages') }}
                    </p>
                </a>
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


        {{--        @canany(['see cctv_activity_sheet'])--}}
        {{--            <li--}}
        {{--                class="nav-item {{ Request::is('backend/cctv_activity_sheet/*') ? 'menu-open' : '' }} ">--}}
        {{--                <a href="#"--}}
        {{--                   class="nav-link {{ Request::is('backend/cctv_activity_sheet/*') ? 'active' : '' }} ">--}}
        {{--                    <i class="nav-icon fas fa-graduation-cap"></i>--}}
        {{--                    <p>--}}
        {{--                        {{ __('Learners Tasks') }}--}}
        {{--                        <i class="right fas fa-angle-left"></i>--}}
        {{--                    </p>--}}
        {{--                </a>--}}
        {{--                <ul class="nav nav-treeview">--}}
        {{--                    @can('see cctv_activity_sheet')--}}
        {{--                        <li class="nav-item">--}}
        {{--                            <a href="{{ route('backend.cctv_activity_sheet.index') }}"--}}
        {{--                               class="nav-link {{ Request::is('backend/cctv_activity_sheet') ? 'active' : '' }} {{ Request::is('backend/cctv_activity_sheet/*') ? 'active' : '' }}">--}}
        {{--                                <i class="nav-icon fas fa-th-large"></i>--}}
        {{--                                <p>--}}
        {{--                                <p>{{ __('CCTV Activity Sheet') }}</p>--}}
        {{--                                </p>--}}
        {{--                            </a>--}}
        {{--                        </li>--}}
        {{--                    @endcan--}}
        {{--                </ul>--}}
        {{--            </li>--}}
        {{--        @endcanany--}}

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
