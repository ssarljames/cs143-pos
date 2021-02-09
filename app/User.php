<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const ADMIN = 'admin';
    const MANAGER = 'manager';
    const CASHIER = 'cashier';

    const ROLES = [
        self::ADMIN,
        self::MANAGER,
        self::CASHIER,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "first_name",
        "last_name",
        "username",
        "password",
        "role",
        "reset_password_required"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSearch(Builder $builder, $search = '')
    {
        $search = trim($search);
        return empty($search)
            ? $builder
            : $builder->where(function (Builder $builder) use (&$search) {
                $builder->where("first_name", "like", "%$search%")
                    ->orWhere("last_name", "like", "%$search%")
                    ->orWhere("username", "like", "%$search%");
            });
    }

    public function getFullNameAttribute()
    {
        return ucwords(strtolower($this->first_name . " " . $this->last_name));
    }
}
