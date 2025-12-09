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

      // dd('log');
       if (!$employee) {
        return response()->json(['message' => 'Employee not found'], 404);
    }
   // dd('log');

    // Reduce leave count
    if ($request->leave_type === 'annual') {
        
        dd('log');
            if ($employee->annual_leave_count == 0 ) {
        return response()->json([
            'message' => 'No annual leave remaining'
        ], 400);

        $employee->annual_leave_count -= 1;

        return response()->json(['massage'=>'You are not annual leave'],400);
    }

    if ($request->leave_type === 'casual') {
        $employee->casual_leave_count -= 1;
   //dd('log');
         return response()->json(['massage'=>'You are not casual leave'],400);
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

}