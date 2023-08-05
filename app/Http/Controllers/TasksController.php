<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;

class TasksController extends Controller
{
    public function index(){
        return TaskResource::collection(Task::all());
    }

    public function show(Task $task){
        return TaskResource::make($task);
    }

    public function destroy(Task $task){
        $task->delete();
        return response()->json("Eliminado Con Exito!!");
    }
}
