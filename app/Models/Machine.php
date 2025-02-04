<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'machines';

    protected $fillable = [
        'name',
        'price',
        'status',
        'malfunction_id',
    ];

    public function leasecontracts()
    {
        return $this->belongsTo(LeaseContract::class);
    }
}
