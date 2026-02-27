<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('superadmin.subscriptions.index', [
            'subscriptions' => Subscription::with('organization')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('superadmin.subscriptions.create', [
            'organizations' => Organization::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'organization_id' => ['required', 'exists:organizations,id'],
            'plan_name' => ['required', 'string'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'amount' => ['required', 'numeric'],
            'status' => ['required', 'in:active,expired,cancelled'],
            'renewal_notes' => ['nullable', 'string'],
        ]);

        Subscription::create($data);

        return redirect()->route('superadmin.subscriptions.index')->with('status', 'Subscription saved.');
    }
}
