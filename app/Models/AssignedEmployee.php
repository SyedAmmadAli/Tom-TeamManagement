<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedEmployee extends Model
{
 protected  $table = 'assigned_employee';
 public $timestamps = false;
 protected $guarded = [];  
 
    public function employee()
    {
        return $this->belongsTo(User::class , 'user_id', 'id');
    }

  

    public function task()
    {
        return $this->belongsTo(Task::class,'task_id', 'id');
    }
    //
}
