<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckListRequest;
use App\Http\Resources\CheckListsResource;
use App\Models\CheckList;
use App\Models\Task;

class CheckListController extends Controller
{
    public function store(CheckListRequest $request){


        $task = Task::firstOrFail('id', $request->input('data.task_id'));

        $checklist = CheckList::create([
            'item' => $request->input('data.item'),
            'task_id' => $task->id
        ]);

        return CheckListsResource::make($checklist);
    }


}
