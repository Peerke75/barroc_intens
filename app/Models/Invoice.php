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
        'description',
        'price',
        'quantity',
        'total'

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
