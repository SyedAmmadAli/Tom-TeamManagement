<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskNotification extends Model
{
    protected $fillable = ['task_id', 'user_id', 'message', 'is_read'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id')->with('assignedFrom'); 
    }
}