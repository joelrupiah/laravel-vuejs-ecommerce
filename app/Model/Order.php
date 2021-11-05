<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\orderItem;
use App\User;

class Order extends Model
{
    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $with = ['user', 'orderItems'];
}
