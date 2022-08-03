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

    const STATUS_ENTRY = 'entry';
    const STATUS_DRIVER_ASSIGNED = 'driver_assigned';
    const STATUS_DRIVER_IN_SPOT = 'driver_in_spot';
    const STATUS_EXECUTED = 'executed';
    const STATUS_COMPETED = 'completed';


    public static function statusesList(): array
    {
        return [
            self::STATUS_ENTRY => 'поступил',
            self::STATUS_DRIVER_ASSIGNED => 'водитель назначен',
            self::STATUS_DRIVER_IN_SPOT => 'водитель на месте',
            self::STATUS_EXECUTED => 'исполняется',
            self::STATUS_COMPETED => 'выполнен',
        ];
    }
}
