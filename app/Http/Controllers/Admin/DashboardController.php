<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\BeaconScan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $orgId = Auth::user()->organization_id;

        return view('admin.dashboard.index', [
            'assetCount' => Asset::where('organization_id', $orgId)->count(),
            'checkedInCount' => Asset::where('organization_id', $orgId)->where('status', 'checked_in')->count(),
            'recentScans' => BeaconScan::where('organization_id', $orgId)->latest()->limit(10)->get(),
        ]);
    }
}
