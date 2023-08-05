<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class TaskFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'task_id'
    ];

    public function task(){
        return $this->belongsTo(Task::class,'task_id', 'id');
    }
}
