<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Role extends Model
{
    protected $table = 'functions';
 
    protected $fillable = [
        'name',
        'description'
    ];
   
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}