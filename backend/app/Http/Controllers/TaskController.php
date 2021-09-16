<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\TaskResource
     */
    public function index()
    {
        $tasks = Task::with('user')->latest('id')->paginate(50);

        return TaskResource::collection($tasks)->response()->setStatusCode(206);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @return \App\Http\Resources\TaskResource
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());

        return (new TaskResource($task))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \App\Http\Resources\TaskResource
     */
    public function show(Task $task)
    {
        return new TaskResource($task->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
