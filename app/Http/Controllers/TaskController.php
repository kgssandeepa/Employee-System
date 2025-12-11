<?php

namespace App\Http\Controllers;

use id;
use App\Models\Task;
use App\Models\Employee;
use App\Models\TaskComment;

use App\Models\EmployeeTask;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignTaskRequest;
use App\Http\Requests\createTaskCommentRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{

    
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        //$employee = Employee::where('user_id', auth()->id())->first();

        //$validated = $request->safe()->only(['name', 'priority']);
        // $validated = $request->safe()->except(['name', 'priority']);

        $task = Task::create($validated);

        return response()->json([
            'message' => 'Task Created Successfully',
            'data' => new TaskResource($task)
        ], 200);
    }


    public function index()
    {
      $task=Task::all();
        return response()->json([
            'data'=> TaskResource::collection($task),
        ]);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $validated = $request->validated();
        
        //dd('log');
        $task = Task::find($id);

        // dd('log');

        $task->update($validated);

        return response()->json([
            'massage' => 'Task Update Succesfully',
            'data' => new TaskResource($task)

        ], 200);
    }

    /////

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return response()->json(['massage' => 'Task Delete Succesfully']);
    }

    public function AssignTask(AssignTaskRequest $request)
    {
        $validated = $request->validated();

        $employee = Employee::find($request->employee_id);
        $task = Task::find($request->task_id);


        if (!$employee || !$task) {
            return response()->json(['message' => 'Employee or Task not found'], 404);
        }

        $employeeTask = EmployeeTask::create($validated);

        return response()->json([
            'massage' => "Task assigned successfully",
            'data'=>new TaskResource($task)
        ], 200);
    }

    //comment

    public function TaskComment(createTaskCommentRequest $request)

    {
        //dd('log');
        $validated = $request->validated();
        //dd('log');
        if (!validator()) {

            return response()->json(['massage' => 'employee task note found'], 404);
        }

        $taskComment = TaskComment::create($validated);

        return response()->json([
            
            'massage' => 'comment added successfully'], 200);
    }

    //view all comment

    public function ViewAllComment(Request $request)
    {
        return TaskComment::all();
    }

    //update comment
    public function UpdateComment(UpdateCommentRequest $request, $id )
    {   
        $validated = $request->validated();
        $taskComment = TaskComment::find($id);

        //dd('log'); 
      

        $taskComment->update($validated);

      //  dd('log');

        return response()->json(['massage' => 'comments update succesfully'], 200);
    }

    //delete comment

    public function DeleteComment($id)

    {

        $taskComment = TaskComment::find($id);

        $taskComment->delete();

        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
}
