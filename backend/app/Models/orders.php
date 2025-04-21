<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    public function items()
    {
        return $this->hasMany(orderitems::class,'order_id');
    }
}
