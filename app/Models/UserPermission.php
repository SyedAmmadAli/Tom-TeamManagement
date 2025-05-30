<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    public $timestamps = false;
    protected $table = 'user_permissions';
    protected $fillable = [
        'user_id',
        'permission_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
