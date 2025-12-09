<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use App\Http\Resources\LeaveResource;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\Employee;


class LeaveRequestController extends Controller
{
    public function store(StoreLeaveRequest $request)
    {
       
        $validated = $request->validated();
         //dd('log');
       $employee = Employee::where('user_id', auth()->id())->first();

       // Annual leave
    if ($validated['leave_type'] === 'annual') {
        if ($employee->annual_leave_count == 0) {
            return response()->json([
                'message' => 'No annual leave remaining'
            ], 400);
        }

        $employee->annual_leave_count -= 1;
    }
//dd('log');

    // Casual leave
    if ($validated['leave_type'] === 'casual') {
        if ($employee->casual_leave_count == 0) {
            return response()->json([
                'message' => 'No casual leave remaining'
            ], 400);
        }

        $employee->casual_leave_count -= 1;
    }

//dd('log');
    // Savecounts
     $employee->save();
    $employee = LeaveRequest::create($validated);
        //dd('log');
        return response()->json([
            
             'data'=>new LeaveResource($employee),
            'message' => 'Leave request submitted successfully',
            'remaining_annual_leaves'=>$employee->annual_leave_count,
            'remaining_casual_leaves'=>$employee->casual_leave_count,
           
        
        ]);

    
    }
       


}

