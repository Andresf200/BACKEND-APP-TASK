<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use Carbon\Carbon;

class TasksController extends Controller
{
    public function index(){
        $tasks = Task::query()
        ->allowedIncludes(['user', 'checklists', 'files'])
        ->jsonPaginate();

        return TaskResource::collection($tasks);
    }

    public function store(TaskStoreRequest $request){
        $task = Task::make([
            'title' => $request->input('data.title'),
            'description' => $request->input('data.description'),
            'state' => (Carbon::parse($request->input('data.date_start')) <= Carbon::now())? Task::stateProgress : Task::stateTODO,
            'date_start' => Carbon::parse($request->input('data.date_start')),
            'user_id' => auth()->user()->id
        ]);

        $task->save();

        if($request->filled('include.checklists')){
            foreach($request->input('include.checklists') as $checkListData){
                $task->checklists()->create([
                    'item' =>  $checkListData,
                    'completed' => false
                ]);
            }
        }

        if($request->hasFile('include.files')){
            foreach ($request->file('include.files') as $file) {
                $fileName = 'imagen_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('imagenes', $fileName, 'public');

                $task->files()->create([
                    'file_name' => $fileName,
                    'file_path' => $path
                ]);
            }
        }

        return TaskResource::make($task);

    }

    public function update(Task $task,TaskUpdateRequest $request){
       $task->fill([
            'title' => $request->input('data.title'),
            'description' => $request->input('data.description'),
            'state' => (Carbon::parse($request->input('data.date_start')) <= Carbon::now())? Task::stateProgress : Task::stateTODO,
            'date_start' => Carbon::parse($request->input('data.date_start')),
       ]);

       if($task->isClean()){
            return response()->json(['status' => 422,'message' => "Debe especificar al menos un valor diferente para actualizar"]);
        }

        $task->save();
        return TaskResource::make($task);

    }

    public function show($task){
        $task = Task::where('id',$task)
        ->allowedIncludes(['user', 'checklists', 'files'])
        ->firstOrFail();

        return TaskResource::make($task);
    }

    public function destroy(Task $task){
        $task->delete();
        return response()->json("Eliminado Con Exito!!");
    }
}
