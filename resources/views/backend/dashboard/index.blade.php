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

                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Courses</h4>
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="number"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Courses</h4>
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="number"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Courses</h4>
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="number"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Courses</h4>
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="number"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Courses</h4>
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="number"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:0">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="infoBoxDashboard mb-3 mb-lg-0 mb-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Courses</h4>
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="number"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:0">View All</a>
                        </div>
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
