<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalPriceLine extends Model
{
    use HasFactory;

    protected $fillable = ['proposal_id','product_id', 'price', 'amount'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
