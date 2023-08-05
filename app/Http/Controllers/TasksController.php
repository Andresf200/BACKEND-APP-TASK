<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function index(){
        $tasks = Task::query()
        ->allowedIncludes(['users', 'checklists', 'files'])
        ->jsonPaginate();

        return TaskResource::collection($tasks);
    }

    public function show($task){
        $task = Task::where('id',$task)
        ->allowedIncludes(['users', 'checklists', 'files'])
        ->firstOrFail();

        return TaskResource::make($task);
    }

    public function destroy(Task $task){
        $task->delete();
        return response()->json("Eliminado Con Exito!!");
    }
}
