<div class="form-group">
    <label class="form-label" for="type_of_leave">Leave Type</label>
    <div class="form-control-wrap">
        <select name="type_of_leave" class="form-control type_of_leave">
            <option value="sick" {{ isset($leave) && $leave->type_of_leave == 'sick' ? 'selected' : '' }}>Sick Leave</option>
            <option value="casual" {{ isset($leave) && $leave->type_of_leave == 'casual' ? 'selected' : '' }}>Casual Leave</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="leave_date">Leave Date</label>
    <div class="form-control-wrap">
        <input type="date" name="leave_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ isset($leave) ? $leave->leave_date : '' }}">
    </div>
</div>


<div class="form-group">
    <label class="form-label" for="reason">Reason</label>
    <div class="form-control-wrap">
        <textarea name="reason" class="form-control" rows="3" placeholder="Enter reason">{{ isset($leave) ? $leave->reason : '' }}</textarea>
    </div>
</div>
