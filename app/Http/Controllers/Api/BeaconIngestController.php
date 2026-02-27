<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetMovementLog;
use App\Models\BeaconScan;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BeaconIngestController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $packet = $request->validate([
            '0.TimeStamp' => ['required', 'date'],
            '0.Format' => ['nullable', 'string'],
            '0.GatewayMAC' => ['required', 'string'],
            '1.TimeStamp' => ['required', 'date'],
            '1.BLEMAC' => ['required', 'string'],
        ]);

        $gatewayMac = strtoupper($packet[0]['GatewayMAC']);
        $bleMac = strtoupper($packet[1]['BLEMAC']);

        $asset = Asset::where('ble_mac', $bleMac)->first();

        $scan = BeaconScan::create([
            'organization_id' => $asset?->organization_id,
            'gateway_mac' => $gatewayMac,
            'ble_mac' => $bleMac,
            'gateway_timestamp' => Carbon::parse($packet[0]['TimeStamp']),
            'tag_timestamp' => Carbon::parse($packet[1]['TimeStamp']),
            'raw_payload' => $packet,
        ]);

        if ($asset) {
            $wasStale = ! $asset->last_seen_at || now()->diffInMinutes($asset->last_seen_at) > 5;

            $asset->update([
                'status' => 'checked_in',
                'last_gateway_mac' => $gatewayMac,
                'last_seen_at' => $scan->tag_timestamp,
            ]);

            if ($wasStale) {
                AssetMovementLog::create([
                    'asset_id' => $asset->id,
                    'event_type' => 'check_in',
                    'source' => 'beacon_host',
                    'gateway_mac' => $gatewayMac,
                    'event_at' => $scan->tag_timestamp,
                    'notes' => 'Auto check-in from beacon ingest API.',
                ]);
            }
        }

        return response()->json([
            'status' => 'ok',
            'scan_id' => $scan->id,
            'asset_found' => (bool) $asset,
        ]);
    }
}
