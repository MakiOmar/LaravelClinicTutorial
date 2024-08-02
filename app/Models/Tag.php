<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = array(
        'content',
    );

    protected $table = 'tags';

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_tages');
    }
}
