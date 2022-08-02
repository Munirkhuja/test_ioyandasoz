<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'driver_id',
        'client_id',
        'longitude',
        'latitude',
        'status',
        'amount',
    ];
}
