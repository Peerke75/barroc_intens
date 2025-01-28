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

    public function index()
    {
        $customers = Customer::with('invoices')->get();  
        return view('customers.index', compact('customers'));
    }

    
    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'customer_id');
    }

    public function events()
    {
        return $this->HasMany(Event::class, 'customer_id');
    }
}


