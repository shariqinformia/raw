@extends('layouts.main')

@section('title', 'Dashboard')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Dashboard') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
@endpush

@section('main')

    <div class="content">
        <div class="adminDashboard">
            <div class="row">
                {{-- @php
                    $superAdmin = null;
                    $admin = null;
                    $trainer = null;
                    $learner = null;
                    $client = null;
                @endphp
                @foreach ($usersByRoleCount as $role)
                    @if ($role->name == 'Super Admin')
                        @php
                            $superAdmin = $role->users->count();
                        @endphp
                    @elseif($role->name == 'Admin')
                        @php
                            $admin = $role->users->count();
                        @endphp
                    @elseif($role->name == 'Trainer')
                        @php
                            $trainer = $role->users->count();
                        @endphp
                    @elseif($role->name == 'Learner')
                        @php
                            $learner = $role->users->count();
                        @endphp
                    @elseif($role->name == 'Corporate Client')
                        @php
                            $client = $role->users->count();
                        @endphp
                    @endif
                @endforeach --}}
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Courses</h4>
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="number">{{$courses_count ?? ""}}</div>
                        <div class="d-flex align-items-center justify-content-between">
                            {{--                            <span>{{$courses_count ?? ""}}</span>--}}
                            <a href="{{route('backend.courses.index')}}">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Learners</h4>
                            <i class="fas fa-id-card-alt"></i>
                        </div>
                        <div class="number">{{$learner_count ?? ""}}</div>
                        <div class="d-flex align-items-center text-right">
                            <span></span>
                            <a href="{{route('backend.users.index')}}?search=&role=Learner&sort=desc">View All Learners</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Trainers</h4>
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="number">{{$trainer_count ?? ""}}</div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span></span>
                            <a href="{{route('backend.users.index')}}?search=&role=Trainer&sort=desc">Manage Trainers</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Admins</h4>
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="number">{{$admin_count ?? ""}}</div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span></span>
                            <a href="{{route('backend.users.index')}}?search=&role=Admin&sort=desc">Manage Admins</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">My Tasks</h4>
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div class="number">15 Pending</div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span>4 completed</span>
                            <a href="javascript:;">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">My Messages </h4>
                            <i class="fas fa-comment-alt"></i>
                        </div>
                        <div class="number {{($unreadCount>0) ? 'text-red' : ''}}">{{$unreadCount ?? 0}} Unread</div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span>{{$readCount ?? 0}}</span>
                            <a href="{{route('backend.messages.index')}}">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="row">--}}
            {{--                <div class="col-lg-8 col-md-8 col-12">--}}
            {{--                    <div class="activeCourse">Active Courses</div>--}}
            {{--                </div>--}}
            {{--                <div class="col-lg-4 col-md-4 col-12">--}}
            {{--                    <div class="deactiveCourse">Active Courses</div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="eLarningCourse">
                        <div class="courseListInfo">
                            <h4>E-learning Licenses</h4>
                        </div>
                        <div
                            class="eLaerningBoxes d-flex align-items-center flex-column flex-lg-column-reverse flex-md-column-reverse">
                            <div class="eLaerningBoxeInner">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="boxBorder">
                                        <span>All Licences</span>
                                        <span>{{$total_license ?? ""}}</span>
                                    </div>
                                    <div class="boxBorder">
                                        <span>Active</span>
                                        <span>{{$total_license ?? ""}}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="boxBorder">
                                        <span>Available</span>
                                        <span>{{$total_license ?? ""}}</span>
                                    </div>
                                    <div class="boxBorder">
                                        <span>Available</span>
                                        <span>{{$total_license ?? ""}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <a href="{{route('backend.elearning_licences.index')}}">View available licences</a>
                                <a href="{{route('backend.elearning_licences.index')}}">Purchase additional licences</a>
                                <a href="{{route('backend.elearning_licences.index')}}">Assign a licence to a new or existing user</a>
                                <a href="{{route('backend.elearning_licences.index')}}">View details of your licences</a>
                                <a href="{{route('backend.elearning_licences.index')}}">View available e-learning courses</a>
                                <a href="{{route('backend.elearning_licences.index')}}">View expired licences</a>
                            </div>
                        </div>
                    </div>
                    <div class="upcomingCourse">
                        <div class="courseList">
                            <div class="courseListInfo d-flex align-items-center justify-content-between">

                                <h4>Upcoming Courses</h4>
                                <a href="{{route('backend.cohorts.index')}}">View All Courses</a>
                            </div>
                            @forelse($cohorts as $cohort)
                                <div class="courseListInner">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="courseName">{{ getAcronym($cohort->course->name) }}</div>
                                        <!-- Display acronym -->
                                        <div class="courseInfo">
                                            <h4 class="m-0">{{$cohort->course->name ?? ""}}</h4>
                                            <p class="m-0">
                                                {{ isset($cohort->start_date_time) ? \Carbon\Carbon::parse($cohort->start_date_time)->format('d F, Y, h:i A') : 'N/A' }}
                                                - {{ isset($cohort->end_date_time) ? \Carbon\Carbon::parse($cohort->end_date_time)->format('d F, Y, h:i A') : 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="courseDate">
                                            <p class="m-0">{{ $cohort->users_count }} / {{$cohort->max_learner}}</p>
                                            <p class="m-0">learners</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="courseListInner">
                                    No trainers found.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="activeTrainer">
                        <div class="courseList">
                            <div class="courseListInfo d-flex align-items-center justify-content-between">
                                <h4>Active Trainers</h4>
                                <a href="{{route('backend.users.index')}}">View All Trainers</a>
                            </div>
                            @forelse($trainers as $trainer)
                                <div class="courseListInner">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="courseName"><i class="fas fa-user"></i></div>
                                        <div class="courseInfo">
                                            <h4 class="m-0">{{$trainer->name}}</h4>

                                            @forelse($trainer->trainerCohorts as $cohort)
                                                {{$cohort->course->name}}/
                                            @empty
                                            @endforelse
                                        </div>
                                        <div class="courseDate">
                                            <p class="m-0">&nbsp; &nbsp; &nbsp;</p>
                                            <p class="m-0">&nbsp; &nbsp; &nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="courseListInner">
                                    No trainers found.
                                </div>
                            @endforelse
                        </div>
                        <div class="courseList">
                            <div class="courseListInfo d-flex align-items-center justify-content-between">
                                <h4>Recent Corporate Clients</h4>
                                <a href="{{route('backend.users.index')}}">View All Courses</a>
                            </div>

                            @forelse($clients as $client)
                                <div class="courseListInner">
                                    <div class="d-flex align-items-center"> <!--justify-content-between-->
                                        <div class="courseName"><i class="fas fa-user"></i></div>
                                        <div class="courseInfo">
                                            <h4 class="m-0">{{$client->name??""}}</h4>
{{--                                            <p class="m-0">Finance</p>--}}
                                        </div>
{{--                                        <div class="courseDate">--}}
{{--                                            <div class="text-right font-weight-bold">1</div>--}}
{{--                                            <div class="text-right">courses</div>--}}
{{--                                        </div>--}}
{{--                                        <div class="courseDate">--}}
{{--                                            <div class="text-right font-weight-bold">1</div>--}}
{{--                                            <div class="text-right">courses</div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="notification">
                        <div class="courseListInfo d-flex align-items-center justify-content-between">
                            <h4>Notifications</h4>
                            <a href="{{route('backend.notifications.index')}}">View All Notifications</a>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($notifications as $notification)
                                <li class="list-group-item">
                                    <div class="notifyInner d-flex align-items-center justify-content-between">
                                        <div class="infoDetail">
                                            <p class="m-0"><strong>Title:</strong> {{ $notification->data['message'] }}
                                            </p>
                                            <p class="m-0"><strong>Date,
                                                    Time:</strong> {{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                        <a href="{{ $notification->data['task_url'] }}" class="btn btn-sm btn-danger">View</a>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <div class="notifyInner d-flex align-items-center justify-content-between">
                                        No notifications found.
                                    </div>
                                </li>
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <style>
        .eLarningCourse {
            padding: 20px 10px;
            border-radius: 10px;
            box-shadow: #77777757 0px 4px 10px 0px;
            margin-top: 20px;
        }

        .eLaerningBoxes .eLaerningBoxeInner {
            flex-basis: 60%;
        }

        .eLarningCourse .eLaerningBoxes a {
            font-size: 16px;
            display: block;
        }

        .eLarningCourse .eLaerningBoxes .boxBorder span {
            font-size: 14px;
        }

        .eLaerningBoxes .eLaerningBoxeInner ~ div {
            flex-basis: 40%;
        }

        .eLaerningBoxeInner .boxBorder {
            border: solid 1px;
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .boxBorder {
            flex: 1;
            margin-right: 10px;
            display: flex;
            justify-content: space-between;
        }

        .notifyInner button {
            border: solid 1px #000;
        }

        .notification .courseListInfo {
            border-bottom: solid 1px #cccc;
            padding-bottom: 10px;
        }

        .notification ul li p {
            font-size: 16px;
        }

        .notification {
            padding: 20px 10px;
            border-radius: 10px;
            box-shadow: #77777757 0px 4px 10px 0px;
            margin-top: 20px;
        }

        .notification .courseListInfo h4 {
            font-size: 20px;
            color: #343a40;
            font-weight: 600;
        }

        .notification .courseListInfo a {
            font-size: 16px;
        }

        .activeTrainer .courseListInner .courseDate > .text-right ~ div {
            font-size: 16px;
        }

        .activeTrainer .success {
            background: #dfedd6;
            padding: 2px 10px;
            border: solid 1px #000;
            font-weight: 600;
        }

        .activeTrainer .warning {
            background: #f0dfb5;
            padding: 2px 10px;
            border: solid 1px #000;
            font-weight: 600;
        }

        .activeTrainer .courseName {
            background: transparent !important;
            border: solid 2px #343a40;
        }

        .activeTrainer .courseName i {
            color: #343a40;
        }

        .activeTrainer .courseList {
            padding: 20px 10px;
            border-radius: 10px;
            box-shadow: #77777757 0px 4px 10px 0px;
            margin-top: 20px;
        }

        .activeTrainer .courseList h4 {
            font-size: 18px;
            color: #343a40;
            font-weight: 600;
        }

        .activeTrainer .courseList a {
            font-size: 16px;
        }

        .upcomingCourse {
            padding: 20px 10px;
            border-radius: 10px;
            box-shadow: #77777757 0px 4px 10px 0px;
            margin-top: 20px;
        }

        .adminDashboard {
            padding-bottom: 50px;
        }

        .upcomingCourse .courseListInfo h4 {
            font-size: 20px;
            color: #343a40;
            font-weight: 600;
        }

        .upcomingCourse .courseListInfo a {
            font-size: 16px;
        }

        .upcomingCourse .courseListInfo {
            margin-bottom: 15px;
        }

        .courseListInner .courseInfo h4 {
            font-size: 17px;
            font-weight: 700;
        }

        .courseListInner .courseName {
            background: #777;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border-radius: 100%;
            margin-right: 10px;
        }

        .courseListInner .courseInfo p {
            color: #777;
            font-size: 16px;
        }

        .courseListInner .courseDate > p {
            font-size: 16px;
            color: #343a40;
        }

        .courseListInner .courseDate > p ~ p {
            color: #777;
        }

        .courseListInner {
            background: #f7f7f7;
            border: solid 1.5px #e6e6e6;
            border-radius: 10px;
            padding: 4px 4px;
            margin-bottom: 10px;
        }

        .activeCourse {
            margin-top: 20px;
            background: #cbe8ba;
            padding: 20px;
            height: 100px;
            border-radius: 10px;
            box-shadow: #77777761 0px 10px 10px 0px;
        }

        .deactiveCourse {
            background: #ffc3ae;
            padding: 20px;
            height: 100px;
            border-radius: 10px;
            box-shadow: #77777761 0px 10px 10px 0px;
            margin-top: 20px;
        }

        .adminDashboard .infoBoxDashboard h4 {
            font-size: 17px;
            font-weight: 700;
            color: #343a40;
        }

        .adminDashboard .infoBoxDashboard i {
            color: #343a40;
            font-size: 22px;
        }

        .infoBoxDashboard {
            padding: 6px;
            border: solid 1.5px #343a40;
            border-radius: 8px;
            box-shadow: #0000003b 0px 0px 10px 0px;
        }

        .infoBoxDashboard .number {
            font-size: 18px;
            font-weight: 700;
            color: #343a40;
            margin: 8px 0px;
        }

        .infoBoxDashboard span {
            font-size: 16px;
            color: #777;
        }

        .infoBoxDashboard a {
            font-size: 16px;
            color: #777;
        }

        @media (max-width: 767px) {
            .eLaerningBoxes .eLaerningBoxeInner {
                flex-basis: 100%;
                width: 100%;
            }

            .eLaerningBoxes .eLaerningBoxeInner ~ div {
                flex-basis: 100%;
                width: 100%;
            }
        }

        @media (max-width: 1499px) {
            .eLarningCourse .eLaerningBoxes a {
                font-size: 13px;
            }

            .eLarningCourse .eLaerningBoxes .boxBorder span {
                font-size: 13px;
            }

            .notification ul li p {
                font-size: 13px;
            }

            .notification .courseListInfo a {
                font-size: 13px;
            }

            .activeTrainer .courseListInner .courseDate > .text-right ~ div {
                font-size: 13px;
            }

            .activeTrainer .courseList a {
                font-size: 13px;
            }

            .upcomingCourse .courseListInfo a {
                font-size: 13px;
            }

            .courseListInner .courseInfo p {
                color: #777;
                font-size: 13px;
            }

            .courseListInner .courseDate > p {
                font-size: 13px;
                color: #343a40;
            }

            .infoBoxDashboard .number {
                font-size: 18px;
                font-weight: 700;
                color: #343a40;
                margin: 8px 0px;
            }

            .infoBoxDashboard span {
                font-size: 12px;
                color: #777;
            }

            .infoBoxDashboard a {
                font-size: 13px;
                color: #777;
            }
        }

        @media (max-width: 1169px) {
        }

        @media (max-width: 991px) {
        }

        @media (max-width: 767px) {
        }

        @media (max-width: 479px) {
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                getCourses(url);
            });

            function getCourses(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function () {
                        $('#courses-table').html('Loading...');
                    },
                    success: function (data) {
                        $('#courses-table').html(data);
                    },
                    error: function (xhr) {
                        console.log('AJAX request failed:', xhr);
                    }
                });
            }
        });
    </script>
@endpush
