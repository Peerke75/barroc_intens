<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function malfunctions()
    {
        return $this->hasMany(Malfunction::class);
    }
}
