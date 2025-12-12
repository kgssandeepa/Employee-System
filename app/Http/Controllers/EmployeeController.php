<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\MediaResource;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\MediaAddRequest;
use App\Http\Resources\EmployeeResource;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    /*public function upload(MediaAddRequest $request,)
    {

        $file = $request->file('file');
        $validated = $request->validated();
        

        //dd('log');
        $media = Media::create($validated);

        dd('log');
        return response()->json([

            'message' => 'file Upload Successfully',
            'data'   => new MediaResource($media)

        ], 200);
    }  */

        public function upload(MediaAddRequest $request)
{
    // 1. Get file from request
    $file = $request->file('file');

    // 2. Create unique file name
    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

    // 3. Create folder path
    $directory = 'uploads/media';

    // 4. Save file in storage/public/uploads/media
    $path = $file->storeAs($directory, $fileName, 'public');

    // 5. Save record in database
    $media = Media::create([
        'display_name' => $file->getClientOriginalName(),
        'name'         => $fileName,
        'path'         => 'storage/' . $path,   // full usable URL
        'type'         => $file->getClientOriginalExtension()
    ]);

    // 6. Return response
    return response()->json([
        'message' => 'File uploaded successfully',
        'data' => $media
    ], 200);
}

} 
