<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory,SoftDeletes;

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

    public static function statusesList(): array
    {
        return [
            self::STATUS_ACTIVE => 'активен',
            self::STATUS_INACTIVE => 'не активен',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }
}
