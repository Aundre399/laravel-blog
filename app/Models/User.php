<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    //protected $guarded= []; placed in serviceproviders
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $fillable[
    //     'name',
    //     'email',
    //     'password',
    // ];

    // public function getUsernameAttribute($username)
    // {
    //     return ucwords($username);
    // }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);;
    }



    public function posts()
    {
        return $this-> hasMany(Post::class);
    }
}
