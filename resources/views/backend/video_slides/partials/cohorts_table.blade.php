<table class="table">
    <thead>
    <tr>
        <th><input type="checkbox" id="select_all"></th> <!-- Checkbox to select all -->
        <th>{{ __('Category') }}</th>
        <th>{{ __('Course') }}</th>
        <th>
            <a href="javascript:void(0);" class="sort-link" data-field="start_date_time" data-order="desc">
                From - To
                <i class="fas fa-sort"></i>
            </a>
        </th>
        <th>Availability</th>
        <th>Trainer</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($cohorts as $cohort)
        @php
            // Convert the start and end date times to Carbon instances
            $startDateTime = \Carbon\Carbon::parse($cohort->start_date_time);
            $endDateTime = \Carbon\Carbon::parse($cohort->end_date_time);

            // Format the dates and times
            $formattedDate = $startDateTime->isoFormat('DD/MM/YYYY') . ' – ' . $endDateTime->isoFormat('DD/MM/YYYY');
            $formattedTime = $startDateTime->format('h:i A') . ' – ' . $endDateTime->format('h:i A');
        @endphp
        @php
            $selectedCohortIds = [];
            if(isset($user)){
                 $selectedCohortIds = old('cohort_ids', $user->cohorts->pluck('id')->toArray());
            }
        @endphp
        <tr>
            <td>
                {{-- <input type="checkbox" name="cohort_ids[]" value="{{ $cohort->id }}"> --}}
                <input type="checkbox" name="cohort_ids[]" value="{{ $cohort->id }}"
    {{ in_array($cohort->id, $selectedCohortIds) ? 'checked' : '' }}>
            </td>
            <td>{{ $cohort->course->category->name ?? "" }}</td>
            <td>{{ $cohort->course->name }}</td>
            <td>{{ $formattedDate }}, {{ $formattedTime }}</td>
            <td>{{ $cohort->max_learner }}</td>
            <td>{{ $cohort->trainer->name ?? "" }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pagination-links">
    {{ $cohorts->links() }}
</div>

