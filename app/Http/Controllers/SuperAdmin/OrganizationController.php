<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrganizationController extends Controller
{
    public function index()
    {
        return view('superadmin.organizations.index', [
            'organizations' => Organization::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('superadmin.organizations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'code' => ['required', 'string', 'max:30', 'unique:organizations,code'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'admin_name' => ['required', 'string'],
            'admin_email' => ['required', 'email', 'unique:users,email'],
            'admin_password' => ['required', 'string', 'min:8'],
        ]);

        $org = Organization::create($data);

        User::create([
            'organization_id' => $org->id,
            'name' => $data['admin_name'],
            'email' => $data['admin_email'],
            'password' => Hash::make($data['admin_password']),
            'role' => 'admin',
            'is_active' => true,
        ]);

        return redirect()->route('superadmin.organizations.index')->with('status', 'Organization created successfully.');
    }
}
