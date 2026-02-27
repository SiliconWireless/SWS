@extends('layouts.app')
@section('content')
<div class="card"><div class="card-header">Create Organization + Main Admin</div><div class="card-body">
<form method="POST" action="{{ route('superadmin.organizations.store') }}">@csrf
<div class="row g-2">
<div class="col-md-4"><input class="form-control" name="name" placeholder="Organization Name" required></div>
<div class="col-md-2"><input class="form-control" name="code" placeholder="Code" required></div>
<div class="col-md-3"><input class="form-control" name="email" placeholder="Org Email" required></div>
<div class="col-md-3"><input class="form-control" name="phone" placeholder="Phone"></div>
<div class="col-md-12"><textarea class="form-control" name="address" placeholder="Address"></textarea></div>
<hr class="my-3"><h6>Admin Credentials</h6>
<div class="col-md-4"><input class="form-control" name="admin_name" placeholder="Admin Name" required></div>
<div class="col-md-4"><input class="form-control" name="admin_email" placeholder="Admin Email" required></div>
<div class="col-md-4"><input class="form-control" name="admin_password" type="password" placeholder="Password" required></div>
</div><button class="btn btn-primary mt-3">Create</button>
</form></div></div>
@endsection
