<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeaconScan extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'gateway_mac',
        'ble_mac',
        'gateway_timestamp',
        'tag_timestamp',
        'raw_payload',
    ];

    protected $casts = [
        'gateway_timestamp' => 'datetime',
        'tag_timestamp' => 'datetime',
        'raw_payload' => 'array',
    ];
}
