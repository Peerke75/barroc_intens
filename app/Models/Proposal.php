<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposals';

    protected $fillable = [
        'user_id',
        'customer_id',
        'date',
    ];

    protected $dates = ['date'];


    public function getDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function priceLines()
    {
        return $this->hasMany(ProposalPriceLine::class);
    }

}
