<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTage extends Model
{
    protected $fillable = [
        'tag_id', 'product_id'
    ];

    protected $table = 'product_tages';

    protected function tag()
    {
        return $this->belongsTo('App\Models\Tag', 'tag_id');
    }

    protected function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
