<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Malfunction extends Model
{
    use HasFactory;

    protected $table = 'malfunctions';

    protected $dates = ['date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
