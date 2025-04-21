<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderitems extends Model
{
    public function product()
{
    return $this->belongsTo(Product::class);
}
}
