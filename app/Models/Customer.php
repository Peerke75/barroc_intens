<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContactPerson;
use App\Models\Contract;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    public function malfunctions()
    {
        return $this->hasMany(Malfunction::class);
    }
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
