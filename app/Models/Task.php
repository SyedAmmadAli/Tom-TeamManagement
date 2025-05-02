<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    // protected $casts = [
    //     'attachments' => 'array',
    // ];

    public function assignedfrom()
    {
        return $this->belongsTo(User::class, 'assigned_from', 'id');
    }


    public function assignedusers()
    {
        return $this->hasMany(AssignedEmployee::class, 'task_id');
    }


   

  

}
