<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory,SoftDeletes;

    const stateTODO = 'todo';
    const stateProgress = 'progress';
    const stateCompleted = 'completed';

    protected $fillable = ['title','description','state','date-start','date-end','user-id'];

    protected $casts = [
        'date-start' => 'datetime',
        'date-end' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
