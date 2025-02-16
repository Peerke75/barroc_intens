<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Event extends Model
{
    use HasFactory;
    
    protected $table = 'event';

    protected $fillable = ['user_id', 'customer_id', 'title', 'start', 'end', 'description'];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    
    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

}
 
 