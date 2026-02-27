<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'asset_code',
        'name',
        'category',
        'serial_number',
        'ble_mac',
        'status',
        'last_seen_at',
        'last_gateway_mac',
    ];

    protected $casts = [
        'last_seen_at' => 'datetime',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(AssetMovementLog::class);
    }
}
