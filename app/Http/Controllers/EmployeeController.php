<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\MediaAddRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\MediaResource;

class EmployeeController extends Controller
{
    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();

        $employee = Employee::where('user_id', auth()->id())->first();

        $employee = Employee::create($validated);

        return response()->json([
            'message' => 'Employee created',
            'data' => new EmployeeResource($employee)
        ], 201);
    }

    //upload image

    public function upload(MediaAddRequest $request,)
    {

        $validated = $request->validated();
        
        //dd('log');

        $media = Media::create($validated);
        
        dd('log');
        return response()->json([

            'message' => 'file Upload Successfully',
            'data'   => new MediaResource($media)

        ], 200);
    }
}
