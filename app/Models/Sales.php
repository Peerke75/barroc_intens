<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'customer_id',
        'user_id',
        'malfunction_id',
        'description',
        'priority',
        'location',
        'date',
        'status',
        'start_appointment',
        'end_appointment',
    ];

    // Relatie met Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relatie met User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
