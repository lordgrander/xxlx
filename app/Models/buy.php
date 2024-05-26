<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buy extends Model
{
    use HasFactory;
    public $timestamps = false; 
    
    protected $table = 'buy';   
    protected $fillable = [  
        'user_id',
        'buy_order',
        'number',
        'price',
        'type',
        'box_id',
        'created_at',
    ];
}
