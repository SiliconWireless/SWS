<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMovementLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'event_type',
        'source',
        'gateway_mac',
        'event_at',
        'notes',
    ];

    protected $casts = [
        'event_at' => 'datetime',
    ];
}
