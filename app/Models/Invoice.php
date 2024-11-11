<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'customer_id',
        'number',
        'quantity',
        'description',
        'price'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
