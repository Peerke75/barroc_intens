<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    // Definieer de tabelnaam als die afwijkt van de standaard (optioneel)
    protected $table = 'machines';

    // Vulbare velden voor mass-assignment
    protected $fillable = [
        'name',      
        'price',     
        'status',   
        'storage_id', 
        'malfunction_id', 
    ];
}
