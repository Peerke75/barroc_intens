<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    // Beschikbare velden voor mass-assignment
    protected $fillable = [
        'product_names',
        'amount',
    ];

    // Relatie met Product model
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
