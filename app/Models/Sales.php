<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'customer_services';
    
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
}
