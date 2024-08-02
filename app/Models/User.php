<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = array(
        'name',
        'email',
        'username',
        'password',
        'phone',
        'address',
        'house_number',
        'role',
    );

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = array(
        'password',
        'remember_token',
    );

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = array(
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    );

    protected function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
    protected function accessTokens()
    {
        return $this->hasMany('App\Models\User', 'tokenable_id');
    }

    public function withProfile()
    {
        return $this->profile();
    }


    protected function products()
    {
        return $this->hasMany('App\Models\Product', 'user_id');
    }
}
