<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
