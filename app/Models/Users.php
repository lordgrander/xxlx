<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'users';   
    protected $fillable = [
        'name', 
        'user_name', 
        'password',
        'phone',
        'email', 
        'po_1', 
        'po_2', 
        'po_3', 
        'bank_id', 
        'bank_number', 
        'line_id', 
        'facebook_id', 
        'status', 
        'created_at', 
        'updated_at', 
        'encode', 
        // Add other fields as needed
    ];
  
    public function userHaveChat()
    {
        return $this->hasMany(wallet_transaction::class, 'user_id');
    }
}
