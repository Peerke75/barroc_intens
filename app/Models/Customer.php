<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'contact_persons_id',
        'company_name',
        'name',
        'mail',
        'BKR_check',
        'order_status',
    ];

    

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
