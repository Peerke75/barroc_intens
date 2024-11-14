<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    public function malfunctions()
    {
        return $this->hasMany(Malfunction::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
