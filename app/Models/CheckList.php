<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Task;

class CheckList extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'completed',
        'task_id'
    ];

    public function task(){
        return  $this->belongsTo(Task::class,'task_id','id');
    }
}
