<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Malfunction extends Model
{

    protected $dates = ['date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
