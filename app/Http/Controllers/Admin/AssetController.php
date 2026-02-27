<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function index()
    {
        return view('admin.assets.index', [
            'assets' => Asset::where('organization_id', Auth::user()->organization_id)->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.assets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'asset_code' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:150'],
            'category' => ['required', 'string'],
            'serial_number' => ['nullable', 'string'],
            'ble_mac' => ['nullable', 'string'],
        ]);
        $data['organization_id'] = Auth::user()->organization_id;
        $data['status'] = 'checked_out';

        Asset::create($data);

        return redirect()->route('admin.assets.index')->with('status', 'Asset created successfully.');
    }
}
