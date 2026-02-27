@extends('layouts.app')
@section('content')
<div class="card"><div class="card-header">Create Asset</div><div class="card-body">
<form method="POST" action="{{ route('admin.assets.store') }}">@csrf
<div class="row g-3">
<div class="col-md-4"><label>Asset Code</label><input name="asset_code" class="form-control" required></div>
<div class="col-md-4"><label>Name</label><input name="name" class="form-control" required></div>
<div class="col-md-4"><label>Category</label><input name="category" class="form-control" required></div>
<div class="col-md-6"><label>Serial Number</label><input name="serial_number" class="form-control"></div>
<div class="col-md-6"><label>Beacon BLE MAC</label><input name="ble_mac" class="form-control" placeholder="DFB68FA5D691"></div>
</div><button class="btn btn-success mt-3">Save</button>
</form></div></div>
@endsection
