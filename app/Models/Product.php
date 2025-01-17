<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = array(
        'user_id',
        'title',
        'description',
        'price',
        'rate',
    );
    protected $table    = 'products';

    protected function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'product_tages');
    }
}
