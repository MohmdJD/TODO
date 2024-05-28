<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
//    public function __construct()
//    {
//        Route::middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
//    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tasks = Task::all();

        return Response::json($tasks)->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'task_title'         => ['required', 'string', 'unique:tasks', 'min:2', 'max:255'],
            'task_description'       => ['nullable', 'string', 'max:255'],
            'deadline_at'   => ['nullable', 'sometimes', 'date'],
            'reminder_at'   => ['nullable', 'sometimes', 'date'],
        ], [
            'task_title.unique'  => 'the task is already listed',

        ]);


        $task = Auth::user()->task()->create($attribute);

        return Response::json($task)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return Response::json($task)->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_title'      => 'required|string|min:2|max:255',
            'task_description'   => 'nullable|string|max:255',
            'deadline_at' => 'nullable|sometimes|date',
            'reminder_at' => 'nullable|sometimes|date'
        ]);

        $task->update($request->all());

        return Response::json($task)->setStatusCode(201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return Response::json($task)->setStatusCode(204);
    }

}
