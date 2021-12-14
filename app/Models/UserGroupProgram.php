<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroupProgram extends Model
{
    public $timestamps = false;
    protected $table = 'user_group_program';

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_group_id",
        "program_id",
        "create",
        "update",
        "read",
        "delete",
        'state'
    ];
}
