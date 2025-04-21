<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function product()
{
    return $this->hasMany(product::class);
}
}
