<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseContract extends Model
{
    use HasFactory;

    protected $table = 'leasecontracts';

    protected $fillable = [
        'customer_id',
        'user_id',
        'start_date',
        'end_date',
        'payment_method',
        'machine_amount',
        'notice_period',
        'status',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}
