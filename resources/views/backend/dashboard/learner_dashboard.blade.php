@php
    use App\Libraries\ScormApiService;
    use App\Models\ProfilePhoto;
@endphp

@extends('layouts.main')

@section('title', 'Learner Dashboard')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Dashboard') }}</h1>
    </div>
@endsection



@push('css')
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css"
          integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="{{  asset('css/dflip.min.css') }}">
    <link rel="stylesheet" href="{{  asset('css/themify-icons.min.css') }}">
    <style>
        span.numFs {
            font-size: 35px;
        }

        #flipbook {
            width: 800px;
            height: 600px;
            margin: auto;
        }

        .page {
            background: #fff;
            width: 100%;
            height: 100%;
        }
    </style>
    <style>
        ul#myTab {
            margin-bottom: 30px;
            width: 100%;
            border: none;
        }

        ul#myTab li button {
            background: transparent;
            border: solid 1px #000;
            border-radius: 0;
            margin: 0px 2px;
        }

        ul#myTab li button.active {
            background: #343a40;
            color: #fff;
        }

        .table-responsive.elearning tr td span {
            font-size: 20px;
            margin-bottom: 20px !important;
            display: block;
        }

        .table-responsive.myUlpoads {
            background: #fff;
            padding: 50px 100px;
            border-radius: 30px;
            border: solid 1px #cccc;
            margin-bottom: 50px;
        }

        .table-responsive.elearning {
            background: #fff;
            padding: 50px 100px;
            border-radius: 30px;
            border: solid 1px #cccc;
        }

        .table-responsive.elearning tr {
            border: none !important;
        }

        .table-responsive.elearning tr:hover {
            background: transparent;
        }

        .table-responsive.elearning tr img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .table-responsive.elearning tr {
            border: solid 1px #ccc !important;
            margin-bottom: 30px !important;
            display: block;
            border-radius: 10px;
        }

        .table-responsive.elearning tr td {
            border: none;
            display: block;
        }
    </style>
    <style>
        .nav-tabs .nav-link {
            padding: 1rem 1.5rem; /* Increase padding */
            font-size: 1.25rem; /* Increase font size */
            border-radius: 0.5rem; /* Optionally adjust border radius */
        }

        .nav-tabs .nav-link.active {
            font-weight: bold; /* Optionally make the active tab bold */
        }
    </style>
@endpush

@section('main')

    <div class="row">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="learner_dashboard" data-toggle="tab"
                        data-target="#learner-dashboard" type="button"
                        role="tab" aria-controls="learner-dashboard" aria-selected="true">Learner Dashboard
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#my_progress" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">My Progress
                </button>
            </li>
        </ul>



        <div class="tab-content w-100" id="myTabContent">

            <!------------------------------ LEARNER DASHBOARD ------------------------------>
            <div class="tab-pane fade show active w-100" id="learner-dashboard" role="tabpanel"
                 aria-labelledby="learner_dashboard">


                <div class="row">
                    <div class="col text-light">
                        <div class="coursesBox bg-dark h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>My Courses</h4>
                                <div class="icon-and-number">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>{{$totalCourses ?? ""}} {{--<br> complete--}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="coursesBox bg-success text-white h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>My Certificates</h4>
                                <div class="icon-and-number">
                                    <i class="fas fa-certificate"></i>
                                </div>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>0 </h4>
                                    <p class="text-white">0 pending</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="coursesBox bg-danger text-white h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>My Messages</h4>
                                <div class="icon-and-number">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>{{$unreadCount ?? ""}} unnread</h4>
                                    <p class="text-white">{{$readCount??""}} read messages</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="coursesBox bg-primary text-white h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>Outstanding Balance</h4>
                                <div class="icon-and-number">
                                    <i class="fas fa-pound-sign"></i>
                                </div>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4><b>£ 0.00</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <br><br>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h4>My Courses</h4>
                        <div class="otsTaskInner">
                            <div class="otstaskData">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Order Date</th>
                                        <th>Date Enrolled</th>
                                        <th>Location</th>
                                        <th>Date Completed</th>
                                        <th>Date Certificate Issued</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($dashboardData as $data)
                                        @if($data['course']['name'])
                                            <tr>
                                                <td>{{ $data['course']['name'] }}</td>
                                                <td>{{ isset($data['start_date_time']) ? \Carbon\Carbon::parse($data['start_date_time'])->format('d F, Y, h:i A') : 'N/A' }}</td>
                                                <td>{{ isset($data['course']['date_enrolled']) ? \Carbon\Carbon::parse($data['course']['date_enrolled'])->format('d F, Y, h:i A') : 'N/A' }}</td>
                                                <td>{{ $data['course']['venue_name'] ?? 'N/A' }}</td>
                                                <!-- Date Completed -->
                                                <td>{{ $data['course']['date_completed'] ?? '' }}</td>
                                                <!-- Date Certificate Issued -->
                                                <td>{{ $data['course']['date_certificate_issued'] ?? '' }}</td>
                                                <!-- Status -->
                                                <td>{{ $data['course']['cohort_status'] ?? "" }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="6">No course assigned to this
                                                    cohort.
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <p>No cohorts assigned.</p>
                                    @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>


                <br><br>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h4>Outstanding Tasks</h4>
                        <div class="otsTaskInner">
                            <div class="otstaskData">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($dashboardData as $data)
                                        <!-- Row for Task Type -->



                                        @if($data['course']['name'])
                                            <tr>
                                                <td colspan="5">
                                                    <div
                                                        class="card d-flex justify-content-between text-white bg-dark">
                                                        <h2>{{ $data['course']['name'] }}
                                                            ({{ isset($data['start_date_time']) ? \Carbon\Carbon::parse($data['start_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                            - {{ isset($data['end_date_time']) ? \Carbon\Carbon::parse($data['end_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                            )</h2>
                                                    </div>
                                                </td>
                                            </tr>

                                            @php
                                                $flipbook = [
                                                   'DS Distance Learning Booklet',
                                                   'CCTV Distance Learning Booklet',
                                                   'DS Top-Up Textbook',
                                                   'SG Top-Up Textbook'
                                               ];

                                               // Filter tasks to exclude "Reminders" and the specific flipbook tasks
                                               $nonReminders = $data['course']['tasks']->filter(function($task) use ($flipbook) {
                                                   return $task['type'] != "Reminders" && !in_array($task['name'], $flipbook);
                                               });
                                            @endphp

                                            @forelse($nonReminders as $task)


                                                <tr>
                                                    <td>{{ $task['name'] ?? "" }}</td>
                                                    <td>{{ isset($data['end_date_time']) ? \Carbon\Carbon::parse($data['end_date_time'])->format('d F, Y, h:i A') : 'N/A' }}</td>
                                                    <td>
                                                        @if($task['type'] == "Reminders")
                                                        @else

                                                            @switch($task['status'] ?? "")
                                                                @case('Approved')
                                                                <span class="badge"
                                                                      style="background-color: #92d36e; color: black; padding: 0.5em 1em; font-size: 0.8em;">Approved</span>
                                                                @break
                                                                @case('Rejected')
                                                                @if($task['name'] == "English Assessment")
                                                                    <span class="badge"
                                                                          style="background-color: #ff3823; color: black; padding: 0.5em 1em; font-size: 0.8em;">Failed</span>
                                                                @else
                                                                    <span class="badge"
                                                                          style="background-color: #ff3823; color: black; padding: 0.5em 1em; font-size: 0.8em;">Rejected</span>
                                                                @endif
                                                                @break
                                                                @case('In Progress')
                                                                <span class="badge"
                                                                      style="background-color: #fec63d; color: black; padding: 0.5em 1em; font-size: 0.8em;">In Progress</span>
                                                                @break
                                                                @default
                                                                <span class="badge"
                                                                      style="background-color: #ff5d55; color: black; padding: 0.5em 1em; font-size: 0.8em;">Not Submitted</span>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{--                                                            <a href="{{ route('backend.view.task.submission', ['submission' => $task['submission_id'] ]) }}" class="text-dark">--}}
                                                        {{--                                                                Details--}}
                                                        {{--                                                            </a>--}}
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No tasks assigned to this
                                                        course.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @else
                                            <tr>
                                                <td colspan="6">No course assigned to this
                                                    cohort.
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <p>No cohorts assigned.</p>
                                    @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <!------------------------------ MY PROGRESS ------------------------------>
            <div class="tab-pane fade w-100" id="my_progress" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <div class="col text-light">
                        <div class="coursesBox bg-dark h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>All Tasks</h4>
                                <span class="numFs"><b>{{$totalTasks ?? ""}}</b></span>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>My tasks</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="coursesBox bg-success text-white h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>Complete Activities</h4>
                                <span class="numFs"><b>{{$totalCompletedTasks??""}}</b></span>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>All activities that have been completed</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="coursesBox bg-danger text-white h-100">
                            <div class="coursesBoxHeader d-flex align-items-center justify-content-between">
                                <h4>Incomplete Activities</h4>
                                <span class="numFs"><b>{{$totalIncompleteTasks??""}}</b></span>
                            </div>
                            <div class="coursesBoxFooter d-flex align-items-end justify-content-between">
                                <div class="boxFooterInfo">
                                    <h4>Activities that need to be completed</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12 col-sm-12">
                        <div class="card card-secondary card-tabs">

                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab"
                                           data-toggle="pill"
                                           href="#custom-tabs-one-home" role="tab"
                                           aria-controls="custom-tabs-one-home"
                                           aria-selected="true">My Tasks</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                           href="#custom-tabs-one-profile" role="tab"
                                           aria-controls="custom-tabs-one-profile"
                                           aria-selected="false">My E-learning Courses</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                           href="#custom-tabs-one-resources" role="tab"
                                           aria-controls="custom-tabs-one-profile"
                                           aria-selected="false">My Resources</a>
                                    </li>
                                </ul>
                            </div>

                            @php
                                // Define the task-specific messages
                            $taskMessages = [
                                'Proof of ID' => [
                                    'Not Submitted' => 'Proof of ID is required. Please upload your document to proceed.',
                                    'In Progress' => 'Your ID proof has been submitted. We are verifying your document.',
                                    'Approved' => 'Your ID proof has been successfully verified. Thank you!',
                                    'Rejected' => 'Your ID proof was rejected. Please ensure it meets the required guidelines and try again.',
                                ],
                                'English Assessment' => [
                                    'Not Submitted' => 'The Initial English Assessment is ready for you. Complete it to demonstrate your skills.',
                                    'In Progress' => 'Your Initial English Assessment is being reviewed and marked by your instructor.',
                                    'Approved' => "Congratulations! You've finished and passed the English Assessment. Well done!",
                                    'Rejected' => 'Your Initial English Assessment results were not successful. Please review the feedback and retake the assessment.',
                                ],
                                'PI Health Questioner' => [
                                    'Not Submitted' => 'The PI Health Questionnaire is waiting for your input. Complete it to proceed.',
                                    'In Progress' => "You've completed the PI Health Questionnaire. Almost there! Your answers are being reviewed by your instructor.",
                                    'Approved' => 'You\'ve finished PI Health Questionnaire. Well done!',
                                    'Rejected' => 'Your PI Health Questionnaire needs additional information. Please review the feedback and complete it again.',
                                ],
                                'DS Activity Sheet' => [
                                    'Not Submitted' => 'The DS Activity Sheet is ready. Before you start, remember to spend at least 8 hours reading the DS Distance Learning Booklet.',
                                    'In Progress' => 'Well Done! Your submission will be reviewed by your trainer/instructor.',
                                    'Approved' => 'DS Activity Sheet completed. Great job!',
                                    'Rejected' => 'Your DS Activity Sheet was not approved. Please ensure you have spent the required 8 hours on the DS Distance Learning Booklet, review the feedback, and make necessary corrections.',
                                ],
                                'CCTV Activity Sheet' => [
                                    'Not Submitted' => 'The CCTV Activity Sheet is ready. Before you start, remember to spend at least 8 hours reading the CCTV Distance Learning Booklet.',
                                    'In Progress' => 'Well Done! Your submission will be reviewed by your trainer/instructor.',
                                    'Approved' => 'CCTV Activity Sheet completed. Great job!',
                                    'Rejected' => 'Your CCTV Activity Sheet was not approved. Please ensure you have spent the required 8 hours on the CCTV Distance Learning Booklet, review the feedback, and make necessary corrections.',
                                ],
                                'DS Top-Up Workbook' => [
                                    'Not Submitted' => 'The DS Top-Up Workbook is available. Start now to complete this required task.',
                                    'In Progress' => 'Well Done! Your submission will be reviewed by your trainer/instructor.',
                                    'Approved' => 'DS Top-Up Workbook completed. You\'ve made great progress!',
                                    'Rejected' => 'Your DS Top-Up Workbook was not approved. Please review the feedback and make necessary revisions.',
                                ],
                                'SG Top-Up Workbook' => [
                                    'Not Submitted' => 'The SG Top-Up Workbook is available. Start now to complete this required task.',
                                    'In Progress' => 'Well Done! Your submission will be reviewed by your trainer/instructor.',
                                    'Approved' => 'SG Top-Up Workbook completed. You\'ve made great progress!',
                                    'Rejected' => 'Your SG Top-Up Workbook was not approved. Please review the feedback and make necessary revisions.',
                                ],
                                'PI Techniques Questionnaire' => [
                                    'Not Submitted' => 'The Techniques Questionnaire is waiting for you. Complete it to proceed.',
                                    'In Progress' => 'Well done! Your Techniques Questionnaire will be reviewed by your instructor.',
                                    'Approved' => 'Techniques Questionnaire completed. Thank you!',
                                    'Rejected' => 'Your Techniques Questionnaire needs attention. Please review the feedback and complete it again.',
                                ],
                                'DS Top-Up Textbook' => [
                                    'Not Submitted' => 'The DS Top-Up Textbook is available for reading. Review it to proceed.',
                                    'In Progress' => 'You\'re currently reading the DS Top-Up Textbook. Your understanding will be assessed via DS Top-Up Workbook and reviewed by your trainer/instructor.',
                                    'Approved' => 'You\'ve completed the DS Top-Up Textbook. Great job!',
                                    'Rejected' => 'Keep reading.',
                                ],
                                'SG Top-Up Textbook' => [
                                    'Not Submitted' => 'The SG Top-Up Textbook is available for reading. Review it to proceed.',
                                    'In Progress' => 'You\'re currently reading the SG Top-Up Textbook. Your understanding will be assessed via SG Top-Up Workbook and reviewed by your trainer/instructor.',
                                    'Approved' => 'You\'ve completed the SG Top-Up Textbook. Great job!',
                                    'Rejected' => 'Keep reading.',
                                ],
                                'DS Distance Learning Booklet' => [
                                    'Not Submitted' => 'The DS Distance Learning Booklet is available. Begin reading it when you\'re ready. Required reading time approximately 8 hours.',
                                    'In Progress' => 'You\'re making progress on the DS Distance Learning Booklet. Your comprehension will be reviewed by your trainer/instructor.',
                                    'Approved' => 'You\'ve finished reading the DS Distance Learning Booklet. Excellent! Now you can complete the DS Activity Sheet.',
                                    'Rejected' => 'Keep reading.',
                                ],
                                'CCTV Distance Learning Booklet' => [
                                    'Not Submitted' => 'The CCTV Distance Learning Booklet is ready for reading. Begin reading it when you\'re ready. Required reading time approximately 8 hours.',
                                    'In Progress' => 'You\'re currently reading the CCTV Distance Learning Booklet. Your comprehension will be reviewed by your trainer/instructor.',
                                    'Approved' => 'CCTV Distance Learning Booklet reading completed. Nice work! Now you can complete the CCTV Activity Sheet.',
                                    'Rejected' => 'Keep reading.',
                                ],
                            ];

                            @endphp

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-one-home"
                                         role="tabpanel"
                                         aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="otsTaskInner">
                                                    <div class="otstaskData">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Task</th>
                                                                <th>Action</th>
                                                                <th>Trainer Response</th>
                                                                <th>Status</th>
                                                                <th>Progress Information</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>


                                                            @forelse($dashboardData as $data)
                                                                <!-- Row for Task Type -->



                                                                @if($data['course']['name'])
                                                                    <tr>
                                                                        <td colspan="5">
                                                                            <div
                                                                                class="card d-flex justify-content-between text-white bg-dark">
                                                                                <h2>{{ $data['course']['name'] }}
                                                                                    ({{ isset($data['start_date_time']) ? \Carbon\Carbon::parse($data['start_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                                                    - {{ isset($data['end_date_time']) ? \Carbon\Carbon::parse($data['end_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                                                    )</h2>
                                                                            </div>
                                                                        </td>
                                                                    </tr>


                                                                    @php
                                                                        // Split tasks into non-reminders and reminders
                                                                        $flipbook = [
                                                                            'DS Distance Learning Booklet',
                                                                            'CCTV Distance Learning Booklet',
                                                                            'DS Top-Up Textbook',
                                                                            'SG Top-Up Textbook'
                                                                        ];

                                                                        // Filter tasks to exclude "Reminders" and the specific flipbook tasks
                                                                        $nonReminders = $data['course']['tasks']->filter(function($task) use ($flipbook) {
                                                                            return $task['type'] != "Reminders" && !in_array($task['name'], $flipbook);
                                                                        });

                                                                        $reminders = $data['course']['tasks']->filter(function($task) {
                                                                            return $task['type'] == "Reminders";
                                                                        });
                                                                    @endphp


                                                                    @forelse($nonReminders as $task)
                                                                        <tr>
                                                                            <td>{{ $task['name'] ?? "" }}</td>
                                                                            <td style="width: 20%;">
                                                                                @if($task['type'] == "CourseWork" || $task['name']=="Course Evaluation Form")

                                                                                    @php
                                                                                        $flipbook = [
                                                                                            'DS Distance Learning Booklet',
                                                                                            'CCTV Distance Learning Booklet',
                                                                                            'DS Top-Up Textbook',
                                                                                            'SG Top-Up Textbook'
                                                                                        ];
                                                                                    @endphp

                                                                                    @if( in_array($task['name'],$flipbook) )
                                                                                        <a target="_blank"
                                                                                           href="{{ route('backend.flipbook.view', ['task' => $task['id']]) }}"
                                                                                           class="text-dark">
                                                                                            <i class="fas fa-eye"
                                                                                               style="font-size: 1.25em;"></i>&nbsp;&nbsp;
                                                                                            View
                                                                                        </a>
                                                                                    @else
                                                                                        @if($task['status'] == "Not Submitted" || $task['status'] == "Rejected")
                                                                                            <a target="_blank"
                                                                                               href="{{ route('backend.tasks.show', [
                                                                                            'id' => $task['id'],
                                                                                            'course_id' => $data['course']['id'],
                                                                                            'cohort_id' => $data['cohort_id'],
                                                                                            'trainer_id' => $data['course']['trainer_id'],
                                                                                            ]) }}" class="text-dark">
                                                                                                <i class="fas fa-eye"
                                                                                                   style="font-size: 1.25em;"></i>&nbsp;&nbsp;
                                                                                                View
                                                                                            </a>
                                                                                        @endif
                                                                                    @endif

                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if($task['status'] == "Rejected" || $task['status'] == "Approved")
                                                                                    <a href="{{ route('backend.view.task.submission', [
                                                                                            'submission' => $task['submission_id']
                                                                                            ]) }}" class="text-dark">
                                                                                        <i class="fas fa-eye"
                                                                                           style="font-size: 1.25em;"></i>&nbsp;&nbsp;
                                                                                        View
                                                                                    </a>
                                                                                @endif
                                                                            </td>
                                                                            <td>

                                                                                @if( in_array($task['name'],$flipbook) )
                                                                                @else

                                                                                    @if($task['type'] == "Reminders")
                                                                                    @else

                                                                                        @switch($task['status'] ?? "")
                                                                                            @case('Approved')
                                                                                            <span class="badge"
                                                                                                  style="background-color: #92d36e; color: black; padding: 0.5em 1em; font-size: 0.8em;">Approved</span>
                                                                                            @break
                                                                                            @case('Rejected')
                                                                                            @if($task['name'] == "English Assessment")
                                                                                                <span
                                                                                                    class="badge"
                                                                                                    style="background-color: #ff3823; color: black; padding: 0.5em 1em; font-size: 0.8em;">Failed</span>
                                                                                            @else
                                                                                                <span
                                                                                                    class="badge"
                                                                                                    style="background-color: #ff3823; color: black; padding: 0.5em 1em; font-size: 0.8em;">Rejected</span>
                                                                                            @endif
                                                                                            @break
                                                                                            @case('In Progress')
                                                                                            <span class="badge"
                                                                                                  style="background-color: #fec63d; color: black; padding: 0.5em 1em; font-size: 0.8em;">In Progress</span>
                                                                                            @break
                                                                                            @default
                                                                                            <span class="badge"
                                                                                                  style="background-color: #ff5d55; color: black; padding: 0.5em 1em; font-size: 0.8em;">Not Submitted</span>
                                                                                        @endswitch
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if($task['type'] == "Reminders")
                                                                                @else
                                                                                    @php
                                                                                        $taskName = $task['name']; // Assume $task->name contains the task name, e.g., "Application Form"
                                                                                        $taskStatus = $task['status']; // Assume $task->pivot->status contains the status
                                                                                        if(isset($taskMessages[$taskName][$taskStatus])) {
                                                                                            $message = $taskMessages[$taskName][$taskStatus];
                                                                                        } else {
                                                                                            $message = "No message available.";
                                                                                        }
                                                                                    @endphp
                                                                                    {{ $message }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                        <tr>
                                                                            <td colspan="4">No tasks assigned to
                                                                                this
                                                                                course.
                                                                            </td>
                                                                        </tr>
                                                                    @endforelse


                                                                    {{-- Display Reminder Tasks at the End --}}
                                                                    @forelse($reminders as $task)
                                                                        <tr>
                                                                            <td>{{ $task['name'] ?? "" }}</td>
                                                                            <td colspan="4">
                                                                                {{-- Handle the Reminder task display logic here --}}
                                                                                <span class="badge"
                                                                                      style="background-color: #ffd700; padding: 0.5em 1em; font-size: 0.8em;">Reminder</span>
                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                        {{-- No reminders found --}}
                                                                    @endforelse


                                                                @else
                                                                    <tr>
                                                                        <td colspan="6">No course assigned to
                                                                            this
                                                                            cohort.
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @empty
                                                                <p>No cohorts assigned.</p>
                                                            @endforelse
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-profile-tab">

                                        <div class="row">

                                        @forelse($dashboardData as $data)
                                            <!-- Row for Task Type -->



                                                @if($data['course']['name'])
                                                    <tr>
                                                        <td colspan="5">
                                                            <div
                                                                class="card d-flex justify-content-between text-white bg-dark">
                                                                <h2>{{ $data['course']['name'] }}
                                                                    ({{ isset($data['start_date_time']) ? \Carbon\Carbon::parse($data['start_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                                    - {{ isset($data['end_date_time']) ? \Carbon\Carbon::parse($data['end_date_time'])->format('d F, Y, h:i A') : 'N/A' }}
                                                                    )</h2>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    @forelse($data['course']['licenses'] as $license)

                                                        @php
                                                            $name = $license['name'] ?? "";
                                                            $scorm_course_link = $license['scorm_course_link'] ?? "";
                                                            $scorm_registration_id = $license['scorm_registration_id'] ?? "";
                                                        @endphp

                                                        <div class="col-md-6">
                                                            <div class="card mb-4">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">{{ $name }}</h5>
                                                                    <a href="{{ $scorm_course_link }}"
                                                                       target="_blank">
                                                                        <img
                                                                            src="{{ asset('images/course.jpg') }}"
                                                                            class="img-fluid mb-3" alt="">
                                                                    </a>
                                                                    <a href="{{ $scorm_course_link }}"
                                                                       target="_blank" class="btn btn-info">
                                                                        Launch
                                                                    </a>


                                                                    @php
                                                                        // SCORM work only in production environment
                                                                        $scormApiService = new ScormApiService();
                                                                        if(app()->isProduction()){
                                                                            $course_info = $scormApiService->getRegistrationDetails($scorm_registration_id);
                                                                        }
                                                                    @endphp


                                                                    @if (isset($course_info))
                                                                        @php
                                                                            $activityDetails = $course_info['activityDetails'];
                                                                            $title = $activityDetails['title'] ?? 'N/A';
                                                                            $attempts = $activityDetails['attempts'] ?? 'N/A';
                                                                            $activity_completion = $activityDetails['activityCompletion'] ?? 'N/A';
                                                                            $activity_success = $activityDetails['activitySuccess'] ?? 'N/A';
                                                                            $completionAmount = $activityDetails['completionAmount']['scaled'] ?? 'N/A';

                                                                            $totalSecondsTracked = $course_info['totalSecondsTracked'] ?? 0;
                                                                            $hours = floor($totalSecondsTracked / 3600);
                                                                            $minutes = floor(($totalSecondsTracked / 60) % 60);
                                                                            $seconds = $totalSecondsTracked % 60;
                                                                        @endphp

                                                                        <p class="mt-3">
                                                                            <strong>Title:</strong> {{ $title }}
                                                                            <br>
                                                                            <strong>Attempts:</strong> {{ $attempts }}
                                                                            <br>
                                                                            <strong>Completion
                                                                                Status:</strong> {{ $activity_completion }}
                                                                            <br>
                                                                            <strong>Success
                                                                                Status:</strong> {{ $activity_success }}
                                                                            <br>
                                                                            <strong>Score:</strong> {{ $completionAmount }}
                                                                            <br>
                                                                            <strong>Total Time
                                                                                Tracked:</strong> {{ $hours }}
                                                                            hours, {{ $minutes }}
                                                                            minutes, {{ $seconds }}
                                                                            seconds<br>
                                                                        </p>
                                                                    @else
                                                                        <p>No course information available.</p>
                                                                    @endif


                                                                    {{--                                                                    @if (isset($course_info))--}}
                                                                    {{--                                                                        @php--}}
                                                                    {{--                                                                            $activityDetails = $course_info['activityDetails'];--}}
                                                                    {{--                                                                            $title = $activityDetails['title'] ?? 'N/A';--}}
                                                                    {{--                                                                            $attempts = $activityDetails['attempts'] ?? 'N/A';--}}
                                                                    {{--                                                                            $activity_completion = $activityDetails['activityCompletion'] ?? 'N/A';--}}
                                                                    {{--                                                                            $activity_success = $activityDetails['activitySuccess'] ?? 'N/A';--}}
                                                                    {{--                                                                            $completionAmount = $activityDetails['completionAmount']['scaled'] ?? 'N/A';--}}

                                                                    {{--                                                                            $totalSecondsTracked = $course_info['totalSecondsTracked'] ?? 0;--}}
                                                                    {{--                                                                            $hours = floor($totalSecondsTracked / 3600);--}}
                                                                    {{--                                                                            $minutes = floor(($totalSecondsTracked / 60) % 60);--}}
                                                                    {{--                                                                            $seconds = $totalSecondsTracked % 60;--}}
                                                                    {{--                                                                        @endphp--}}

                                                                    {{--                                                                        <p class="mt-3">--}}
                                                                    {{--                                                                            <strong>Title:</strong> {{ $title }}<br>--}}
                                                                    {{--                                                                            <strong>Attempts:</strong> {{ $attempts }}--}}
                                                                    {{--                                                                            <br>--}}
                                                                    {{--                                                                            <strong>Completion--}}
                                                                    {{--                                                                                Status:</strong> {{ $activity_completion }}--}}
                                                                    {{--                                                                            <br>--}}
                                                                    {{--                                                                            <strong>Success--}}
                                                                    {{--                                                                                Status:</strong> {{ $activity_success }}--}}
                                                                    {{--                                                                            <br>--}}
                                                                    {{--                                                                            <strong>Score:</strong> {{ $completionAmount }}--}}
                                                                    {{--                                                                            <br>--}}
                                                                    {{--                                                                            <strong>Total Time--}}
                                                                    {{--                                                                                Tracked:</strong> {{ $hours }}--}}
                                                                    {{--                                                                            hours, {{ $minutes }}--}}
                                                                    {{--                                                                            minutes, {{ $seconds }}--}}
                                                                    {{--                                                                            seconds<br>--}}
                                                                    {{--                                                                        </p>--}}
                                                                    {{--                                                                    @else--}}
                                                                    {{--                                                                        <p>No course information available.</p>--}}
                                                                    {{--                                                                    @endif--}}


                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-md-12">
                                                            <div class="card mb-4">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">No licenses assigned
                                                                        to this
                                                                        course.</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                @else
                                                    <div class="col-md-12">
                                                        <div class="card mb-4">
                                                            <div class="card-body">
                                                                <h5 class="card-title">No course assigned to
                                                                    this
                                                                    cohort.</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="col-md-12">
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <h5 class="card-title">No cohorts assigned.</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse









                                            {{--                                            @forelse ($elearningCourses as $elearningCourse)--}}
                                            {{--                                                <div class="col-md-6">--}}
                                            {{--                                                    <div class="card mb-4">--}}
                                            {{--                                                        <div class="card-body">--}}
                                            {{--                                                            <h5 class="card-title">{{ $elearningCourse->course_name }}</h5>--}}
                                            {{--                                                            <a href="{{ $elearningCourse->course_link }}"--}}
                                            {{--                                                               target="_blank">--}}
                                            {{--                                                                <img src="{{ asset('images/course.jpg') }}"--}}
                                            {{--                                                                     class="img-fluid mb-3" alt="">--}}
                                            {{--                                                            </a>--}}
                                            {{--                                                            <a href="{{ $elearningCourse->course_link }}"--}}
                                            {{--                                                               target="_blank" class="btn btn-info">--}}
                                            {{--                                                                Launch--}}
                                            {{--                                                            </a>--}}


                                            {{--                                                            @php--}}
                                            {{--                                                                // SCORM work only in production environment--}}
                                            {{--                                                                $scormApiService = new ScormApiService();--}}
                                            {{--                                                                $course_info = $scormApiService->getRegistrationDetails($elearningCourse->registration_id);--}}
                                            {{--                                                            @endphp--}}

                                            {{--                                                            @if (isset($course_info))--}}
                                            {{--                                                                @php--}}
                                            {{--                                                                    $activityDetails = $course_info['activityDetails'];--}}
                                            {{--                                                                    $title = $activityDetails['title'] ?? 'N/A';--}}
                                            {{--                                                                    $attempts = $activityDetails['attempts'] ?? 'N/A';--}}
                                            {{--                                                                    $activity_completion = $activityDetails['activityCompletion'] ?? 'N/A';--}}
                                            {{--                                                                    $activity_success = $activityDetails['activitySuccess'] ?? 'N/A';--}}
                                            {{--                                                                    $completionAmount = $activityDetails['completionAmount']['scaled'] ?? 'N/A';--}}

                                            {{--                                                                    $totalSecondsTracked = $course_info['totalSecondsTracked'] ?? 0;--}}
                                            {{--                                                                    $hours = floor($totalSecondsTracked / 3600);--}}
                                            {{--                                                                    $minutes = floor(($totalSecondsTracked / 60) % 60);--}}
                                            {{--                                                                    $seconds = $totalSecondsTracked % 60;--}}
                                            {{--                                                                @endphp--}}

                                            {{--                                                                <p class="mt-3">--}}
                                            {{--                                                                    <strong>Title:</strong> {{ $title }}<br>--}}
                                            {{--                                                                    <strong>Attempts:</strong> {{ $attempts }}<br>--}}
                                            {{--                                                                    <strong>Completion--}}
                                            {{--                                                                        Status:</strong> {{ $activity_completion }}--}}
                                            {{--                                                                    <br>--}}
                                            {{--                                                                    <strong>Success--}}
                                            {{--                                                                        Status:</strong> {{ $activity_success }}<br>--}}
                                            {{--                                                                    <strong>Score:</strong> {{ $completionAmount }}--}}
                                            {{--                                                                    <br>--}}
                                            {{--                                                                    <strong>Total Time--}}
                                            {{--                                                                        Tracked:</strong> {{ $hours }}--}}
                                            {{--                                                                    hours, {{ $minutes }} minutes, {{ $seconds }}--}}
                                            {{--                                                                    seconds<br>--}}
                                            {{--                                                                </p>--}}
                                            {{--                                                            @else--}}
                                            {{--                                                                <p>No course information available.</p>--}}
                                            {{--                                                            @endif--}}


                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            @empty--}}
                                            {{--                                                <div class="col-12">--}}
                                            {{--                                                    <p class="text-center">--}}
                                            {{--                                                        <i>{{ __('My E-learning Courses not found.') }}</i></p>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            @endforelse--}}
                                        </div>


                                    </div>


                                    <div class="tab-pane fade" id="custom-tabs-one-resources" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-profile-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="otsTaskInner">
                                                    <div class="taskHeading d-flex justify-content-between">
                                                        <h4>Resources</h4>
                                                        <i class="fas fa-check-square"></i>
                                                    </div>
                                                    <div class="otstaskData">

                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Resources</th>
                                                                <th>Type</th>
                                                                <th>Action</th>
                                                                <th>Description</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($tasks as $task)
                                                                <tr>
                                                                    <td>{{ $task->name }}</td>
                                                                    <td>Flip Book</td>
                                                                    <td>
                                                                        <a target="_blank"
                                                                           href="{{ route('backend.flipbook.view', ['task' => $task->id]) }}"
                                                                           class="text-dark">
                                                                            <i class="fas fa-eye"
                                                                               style="font-size: 1.25em;"></i>&nbsp;&nbsp;
                                                                            View
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        @switch($task->name)
                                                                            @case('DS Top-Up Textbook')
                                                                            Self-study textbook designed for
                                                                            individuals pursuing the Highfield
                                                                            Level
                                                                            2 Award for Door Supervisors in the
                                                                            Private Security Industry. It
                                                                            focuses on
                                                                            the principles of using equipment
                                                                            relevant to door supervisors.
                                                                            @break
                                                                            @case('SG Top-Up Textbook')
                                                                            This textbook supports learners
                                                                            preparing for the Highfield Level 2
                                                                            Award for Security Officers in the
                                                                            Private Security Industry (Top-Up),
                                                                            focusing on minimizing personal risk
                                                                            for
                                                                            security officers.
                                                                            @break
                                                                            @case('DS Distance Learning Booklet')
                                                                            This Distance Learning Booklet
                                                                            supports
                                                                            learners preparing for the Highfield
                                                                            Level 2 Award for Door Supervisors
                                                                            in
                                                                            the Private Security Industry. It
                                                                            focuses on Module 1: Principles of
                                                                            Working in the Private Security
                                                                            Industry.
                                                                            @break
                                                                            @case('CCTV Distance Learning Booklet')
                                                                            This Distance Learning Booklet
                                                                            supports
                                                                            learners preparing for the Highfield
                                                                            Level 2 Award for CCTV Operators in
                                                                            the
                                                                            Private Security Industry. It
                                                                            focuses on
                                                                            Module 1: Principles of Working in
                                                                            the
                                                                            Private Security Industry.
                                                                            @break
                                                                            @default
                                                                            No description available.
                                                                        @endswitch
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="4">No resources found.</td>
                                                                </tr>
                                                            @endforelse
                                                            </tbody>
                                                        </table>


                                                        {{--                                                        <table class="table table-bordered">--}}
                                                        {{--                                                            <thead>--}}
                                                        {{--                                                            <tr>--}}
                                                        {{--                                                                <th>Resources</th>--}}
                                                        {{--                                                                <th>Type</th>--}}
                                                        {{--                                                                <th>Action</th>--}}
                                                        {{--                                                                <th>Description</th>--}}
                                                        {{--                                                            </tr>--}}
                                                        {{--                                                            </thead>--}}
                                                        {{--                                                            <tbody>--}}
                                                        {{--                                                            <!-- Rows for Each Task -->--}}
                                                        {{--                                                            @forelse ($tasksBooklet as $task)--}}
                                                        {{--                                                                <tr>--}}
                                                        {{--                                                                    <td style="width: 20%;">{{ $task->name }}</td>--}}
                                                        {{--                                                                    <td style="width: 10%;">Flip Book</td>--}}
                                                        {{--                                                                    <td style="width: 20%;">--}}
                                                        {{--                                                                        <a href="{{ route('backend.flipbook.view', ['task' => $task->id]) }}"--}}
                                                        {{--                                                                           class="text-dark"> <i class="fas fa-eye"--}}
                                                        {{--                                                                                                 style="font-size: 1.25em;"></i>&nbsp;&nbsp; View</a>--}}
                                                        {{--                                                                    </td>--}}
                                                        {{--                                                                    <td style="width: 50%;">--}}
                                                        {{--                                                                        @switch($task->name)--}}
                                                        {{--                                                                            @case('DS Top-Up Textbook')--}}
                                                        {{--                                                                                Self-study textbook designed for--}}
                                                        {{--                                                                                individuals pursuing the Highfield Level--}}
                                                        {{--                                                                                2 Award for Door Supervisors in the--}}
                                                        {{--                                                                                Private Security Industry. It focuses on--}}
                                                        {{--                                                                                the principles of using equipment--}}
                                                        {{--                                                                                relevant to door supervisors. The--}}
                                                        {{--                                                                                textbook covers key topics such as--}}
                                                        {{--                                                                                managing venue capacity, effective use--}}
                                                        {{--                                                                                of communication devices (like radios--}}
                                                        {{--                                                                                and CCTV), safety equipment, and--}}
                                                        {{--                                                                                personal protective equipment (PPE).--}}
                                                        {{--                                                                                Additionally, it addresses the actions--}}
                                                        {{--                                                                                that door supervisors should take during--}}
                                                        {{--                                                                                global or critical incidents, with--}}
                                                        {{--                                                                                guidance on maintaining safety and--}}
                                                        {{--                                                                                compliance with government regulations.--}}
                                                        {{--                                                                                @break--}}
                                                        {{--                                                                            @case('SG Top-Up Textbook')--}}
                                                        {{--                                                                                This textbook is designed to support--}}
                                                        {{--                                                                                learners preparing for the Highfield--}}
                                                        {{--                                                                                Level 2 Award for Security Officers in--}}
                                                        {{--                                                                                the Private Security Industry (Top-Up).--}}
                                                        {{--                                                                                It focuses on the principles of--}}
                                                        {{--                                                                                minimising personal risk for security--}}
                                                        {{--                                                                                officers. The content covers crucial--}}
                                                        {{--                                                                                aspects such as understanding--}}
                                                        {{--                                                                                responsibilities for personal safety,--}}
                                                        {{--                                                                                identifying and mitigating risks, and--}}
                                                        {{--                                                                                using personal protective equipment--}}
                                                        {{--                                                                                (PPE). The textbook also provides--}}
                                                        {{--                                                                                guidance on the appropriate actions to--}}
                                                        {{--                                                                                take during global or critical--}}
                                                        {{--                                                                                incidents, ensuring that security--}}
                                                        {{--                                                                                officers remain compliant with the--}}
                                                        {{--                                                                                latest government regulations and best--}}
                                                        {{--                                                                                practices.--}}
                                                        {{--                                                                                @break--}}
                                                        {{--                                                                            @case('DS Distance Learning Booklet')--}}
                                                        {{--                                                                                This Distance Learning Booklet is--}}
                                                        {{--                                                                                designed to support learners preparing--}}
                                                        {{--                                                                                for the Highfield Level 2 Award for Door--}}
                                                        {{--                                                                                Supervisors in the Private Security--}}
                                                        {{--                                                                                Industry. It focuses on the Module 1:--}}
                                                        {{--                                                                                Principles of Working in the Private--}}
                                                        {{--                                                                                Security Industry. Learners are required--}}
                                                        {{--                                                                                to spend at least 8 hours studying this--}}
                                                        {{--                                                                                material.--}}
                                                        {{--                                                                                @break--}}
                                                        {{--                                                                            @case('CCTV Distance Learning Booklet')--}}
                                                        {{--                                                                                This Distance Learning Booklet is--}}
                                                        {{--                                                                                designed to support learners preparing--}}
                                                        {{--                                                                                for the Highfield Level 2 Award for CCTV--}}
                                                        {{--                                                                                Operators in the Private Security--}}
                                                        {{--                                                                                Industry. It focuses on the Module 1:--}}
                                                        {{--                                                                                Principles of Working in the Private--}}
                                                        {{--                                                                                Security Industry. Learners are required--}}
                                                        {{--                                                                                to spend at least 8 hours studying this--}}
                                                        {{--                                                                                material.--}}
                                                        {{--                                                                                @break--}}
                                                        {{--                                                                            @default--}}
                                                        {{--                                                                                No description available.--}}
                                                        {{--                                                                        @endswitch--}}
                                                        {{--                                                                    </td>--}}
                                                        {{--                                                                </tr>--}}
                                                        {{--                                                            @empty--}}
                                                        {{--                                                                <tr>--}}
                                                        {{--                                                                    <td colspan="3">No tasks found for this type.</td>--}}
                                                        {{--                                                                </tr>--}}
                                                        {{--                                                            @endforelse--}}
                                                        {{--                                                            </tbody>--}}
                                                        {{--                                                        </table>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{  asset('js/dflip.min.js') }}"></script>
@endpush
