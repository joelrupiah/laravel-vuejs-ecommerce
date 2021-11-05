<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $with = ['category'];

    protected $casts = [
        'flavor' => 'json',
        'occassion' => 'json'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
