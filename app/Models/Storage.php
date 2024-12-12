<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_names',
        'amount',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
