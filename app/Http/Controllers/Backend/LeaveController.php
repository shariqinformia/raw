<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Role\UpdateRoleRequest;
use App\Models\Leave;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class LeaveController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if( $user->hasRole('Super Admin')  ) {
            $leaves = Leave::with('user')->get();
            return view('backend.leaves.index', compact('leaves'));
        } elseif( $user->hasRole('Student')  ) {


            $leaves = Leave::where('user_id',$user->id)->first();
            return view('backend.leaves.index', compact('leaves'));
        }
    }

    public function create()
    {
        $role = new Leave();
        return view('backend.leaves.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'type_of_leave' => 'required|string',
            'leave_date' => 'required|date',
            'reason' => 'required|string|max:500',
        ]);

        // Save data to database
        Leave::create([
            'user_id' => auth()->user()->id,
            'type_of_leave' => $request->type_of_leave,
            'leave_date' => $request->leave_date,
            'reason' => $request->reason,
        ]);

        // Redirect with success message
        return redirect()->route('backend.leaves.index')->with('success', 'Leave request submitted successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        return view('backend.leaves.edit', compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Leave $leave)
    {

        // Validate form data
        $request->validate([
            'type_of_leave' => 'required|string',
            'leave_date' => 'required|date',
            'reason' => 'required|string|max:500',
        ]);

        $request->add('user_id', auth()->user()->id);

        $leave->update($request->all());
        return redirect()->route('backend.leaves.index')->with('success', 'Leave updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('backend.leaves.index')->with('success', 'Leave deleted successfully');
    }
}
