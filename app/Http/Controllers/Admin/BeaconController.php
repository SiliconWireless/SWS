<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BeaconController extends Controller
{
    public function index()
    {
        return view('admin.beacons.index', [
            'assets' => Asset::whereNotNull('ble_mac')->latest()->paginate(10),
        ]);
    }

    public function assign(Request $request, Asset $asset): RedirectResponse
    {
        $data = $request->validate([
            'ble_mac' => ['required', 'string', 'max:32'],
        ]);

        $asset->update(['ble_mac' => strtoupper($data['ble_mac'])]);

        return back()->with('status', 'Beacon tag mapped to asset.');
    }
}
