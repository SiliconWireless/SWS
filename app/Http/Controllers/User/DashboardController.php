<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard.index', [
            'assets' => Asset::where('organization_id', Auth::user()->organization_id)->latest()->paginate(10),
        ]);
    }
}
