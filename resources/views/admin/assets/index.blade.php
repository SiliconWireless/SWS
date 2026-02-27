@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h4>Assets</h4><a href="{{ route('admin.assets.create') }}" class="btn btn-primary">Add Asset</a></div>
<table class="table table-bordered bg-white"><thead><tr><th>Code</th><th>Name</th><th>Category</th><th>BLE MAC</th><th>Status</th></tr></thead><tbody>
@foreach($assets as $asset)
<tr><td>{{ $asset->asset_code }}</td><td>{{ $asset->name }}</td><td>{{ $asset->category }}</td><td>{{ $asset->ble_mac }}</td><td>{{ $asset->status }}</td></tr>
@endforeach
</tbody></table>
@endsection
