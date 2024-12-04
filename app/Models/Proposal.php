<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposals';

    // Voeg de velden toe die je wilt toestaan voor mass assignment
    protected $fillable = [
        'user_id',
        'customer_id',
        'date',
    ];

    protected $dates = ['date'];


    public function getDateAttribute($value)
    {
        return Carbon::parse($value);  // Zet de datum om naar een Carbon object
    }

    // Relatie met de Customer: elke offerte behoort tot één klant
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relatie met ProposalPriceLine: een offerte kan meerdere prijsregels hebben
    public function priceLines()
    {
        return $this->hasMany(ProposalPriceLine::class);
    }

}
