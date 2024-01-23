<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderList extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
        'order_code',
        'total',
    ];
}
