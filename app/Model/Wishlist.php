<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;

class Wishlist extends Model
{
    protected $guarded = [];
    protected $with = ['product'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
