<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buy_order extends Model
{
    use HasFactory;
    public $timestamps = false; 
    
    protected $table = 'buy_order';   
    protected $fillable = [  
        'user_id',
        'name',
        'type',
        'percent',
        'total_price',
        'box_id',
        'created_at',
    ];
}
