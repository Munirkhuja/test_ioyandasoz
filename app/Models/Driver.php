<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'last_name',
        'longitude',
        'latitude',
        'status',
        'balance',
        'rating',
    ];
}
