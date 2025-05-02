<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   protected $timpstamps = false;
   protected $guarded = [];

   public function user()
   {
      return $this->hasMany(User::class, 'role_id', 'id');
   }
}
