<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 */
class Partner extends Model
{
    public function partner()
    {
        return $this->hasMany(Order::class);
    }
}
