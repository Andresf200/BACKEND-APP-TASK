<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\CheckList;
use App\Models\TaskFile;

class Task extends Model
{
    use HasFactory,SoftDeletes;

    const stateTODO = 'todo';
    const stateProgress = 'progress';
    const stateCompleted = 'completed';

    protected $fillable = ['title','description','state','date_start','date_end','user-id'];

    protected $casts = [
        'date-start' => 'datetime',
        'date-end' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checklists(){
        return $this->hasMany(CheckList::class);
    }

    public function files()
    {
        return $this->hasMany(TaskFile::class);
    }
}
