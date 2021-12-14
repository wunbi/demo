<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    public $timestamps = false;
    protected $table = 'user_group';
    use HasFactory;

    public function userGroupProgram()
    {
        return $this->hasMany('App\Models\UserGroupProgram', 'user_group_id', 'id');
    }
}
