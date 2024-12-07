<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Beschikbare velden voor mass-assignment
    protected $fillable = [
        'name', 'price', 'product_category_id', 'storage_id',
    ];

    // Relatie met ProductCategory
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    // Relatie met Storage
    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id');
    }
}
