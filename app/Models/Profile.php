<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = array(
        'user_id',
        'first_name',
        'last_name',
        'address',
        'age',
        'gender',
        'bio',
    );

    protected $table = 'profiles';

    protected function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function withUser()
    {
        return $this->user();
    }
}
