<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckListRequest;
use App\Http\Resources\CheckListsResource;
use App\Models\CheckList;
use App\Models\Task;

class CheckListController extends Controller
{
    public function show($checkList){
        $checkList = CheckList::where('id',$checkList)
        ->firstOrFail();

        return CheckListsResource::make($checkList);
    }

    public function store(CheckListRequest $request){

        $task = Task::find($request->input('data.task_id'));

        $checklist = CheckList::create([
            'item' => $request->input('data.item'),
            'task_id' => $task->id
        ]);

        return CheckListsResource::make($checklist);
    }

    public function update($checkList, CheckListRequest $request){

       $checkList = CheckList::firstOrFail('id',$checkList);
       $task = Task::firstOrFail('id', $request->input('data.task_id'));

       $checkList->fill([
            'item' => $request->input('data.item'),
            'task_id' => $task->id
       ]);


       if($checkList->isClean()){
            return response()->json(['status' => 422,'message' => "Debe especificar al menos un valor diferente para actualizar"]);
        }

        $checkList->save();
        return CheckListsResource::make($checkList);
    }

    public function destroy($checkList){
        $checkList = CheckList::find($checkList);
        $checkList->delete();
        return response()->json("Eliminado Con Exito!!");
    }

    public function toggleCompleted($checkList){
        $checkList = CheckList::find($checkList);
        $checkList->toggleCompleted();

        return CheckListsResource::make($checkList);
    }

}
