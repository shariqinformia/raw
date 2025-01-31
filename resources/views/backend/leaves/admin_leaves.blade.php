@extends('layouts.main')

@section('title', 'Leave')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Leave') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Leave') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Leave') }}
                    </h3>
                </div>
                <div class="card-body">
                    @can('add leave')
                        <div class="text-right mb-3">
                            <a href="{{ route('backend.leaves.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle mr-2"></i>
                                {{ __('Add leave') }}
                            </a>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('Type of leave') }}</th>
                                <th>{{ __('Student') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Reason') }}</th>
                                <th>{{ __('Reject Reason') }}</th>
                                <th>{{ __('Date created') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($leaves as $leave)
                                <tr>
                                    <td>{{ $leave->id }}</td>
                                    <td>{{ $leave->user->name }}</td>
                                    <td>{{ strtoupper(str_replace("_"," ",$leave->type_of_leave)) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave->leave_date)->format('d M, Y') }}</td>
                                    <td>
                                        @switch($leave->status)
                                            @case('Approved')
                                                <span class="badge badge-success">Approved</span>
                                                @break

                                            @case('Rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                                @break

                                            @case('Not Submitted')
                                                <span class="badge badge-secondary">Not Submitted</span>
                                                @break

                                            @default
                                                <span class="badge badge-warning">In Progress</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $leave->reason }}</td>
                                    <td>{{ $leave->comments }}</td>
                                    <td>{{ $leave->created_at->diffForHumans() }}</td>
                                    <td colspan="2">
                                        @if (isset($leave) && $leave->status == 'In Progress')
                                            <a href="{{ route('backend.leaves.approve', $leave->id) }}"
                                               class="btn btn-success btn-sm">Approve</a>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#rejectModal"
                                                    data-profilephotoid="{{ $leave->id }}">
                                                Reject
                                            </button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <i>{{ __('No leaves found') }}</i>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="rejectForm" method="POST" action="{{ route('backend.leaves.reject', ['id' => 0]) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
            integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#rejectModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var profilePhotoId = button.data('profilephotoid'); // Extract info from data-* attributes

            var form = $('#rejectForm');
            var action = form.attr('action').replace('/0', '/' + profilePhotoId);
            form.attr('action', action);
        });
    </script>
@endpush
