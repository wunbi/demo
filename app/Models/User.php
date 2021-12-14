<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function program()
    {
        return  $this->hasManyThrough(
            'App\Models\Program',
            'App\Models\UserGroupProgram',
            'user_group_id',
            'id',
            'user_group_id',
            'program_id'
        );
    }

    public function userGroupProgram()
    {
        return $this->hasMany('App\Models\UserGroupProgram', 'user_group_id', 'user_group_id');
    }

    public function userGroup()
    {
        return $this->hasMany('App\Models\userGroup', 'id', 'user_group_id');
    }

    public function isGroup($group)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        $userGroup = $this->userGroup->pluck('group_name')->first();
        return $userGroup == $group;
    }

    public function isSuperAdmin()
    {
        return $this->user_group_id == 1;
    }

    public function has($programStr, $action)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        if (is_array($programStr)) {
            $programIds = $this->program->whereIn('path', $programStr)->pluck('id')->all();
        } else {
            $programIds = $this->program->where('path', $programStr)->pluck('id')->all();
        }


        if ($programIds) {
            $rows = $this->userGroupProgram->whereIn('program_id', $programIds)->all();
            foreach ($rows as $row) {
                if ($row->$action == 1) {
                    return true;
                }
            }
        }

        return false;
    }
}
