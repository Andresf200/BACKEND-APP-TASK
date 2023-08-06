<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskFile;
use App\Http\Requests\TaskFileRequest;
use Illuminate\Support\Facades\Storage;

class TaskFileController extends Controller
{
    public function store(TaskFileRequest $request){
        $task = Task::firstOrFail('id', $request->input('data.task_id'));

        if($request->hasFile('data.files')){
            foreach ($request->file('data.files') as $file) {
                $fileName = 'imagen_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('imagenes', $fileName, 'public');

                $task->files()->create([
                    'file_name' => $fileName,
                    'file_path' => $path
                ]);
            }
            return response()->json(["Se Guardo la imagen correctamente"]);
        }
    }

    public function destroy($id){

        $taskFile = TaskFile::find($id);

        if (Storage::exists('public/'. $taskFile->file_path)) {
            Storage::delete('public/'.$taskFile->file_path);
            $taskFile->delete();
            return response()->json("Eliminado Con Exito!!");
        }else{
            return response()->json("Ocurrio un Error");
        }
    }
}
