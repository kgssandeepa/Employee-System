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

        $employee = Employee::where('user_id', auth()->id())->first();



        // Savecounts
        $employee->save();

        $leaveRequest = LeaveRequest::create($validated);

        //dd('log');

        return response()->json([

            'data' => new LeaveResource($leaveRequest),

            'message' => 'Leave request submitted successfully',


        ]);
    }
}
