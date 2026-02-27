@extends('layouts.app')
@section('content')
<h4>Assets View</h4>
<table class="table bg-white"><thead><tr><th>Code</th><th>Name</th><th>Status</th></tr></thead><tbody>
@foreach($assets as $asset)
<tr><td>{{ $asset->asset_code }}</td><td>{{ $asset->name }}</td><td>{{ $asset->status }}</td></tr>
@endforeach
</tbody></table>
<a href="{{ route('user.reports.pdf') }}" class="btn btn-danger">PDF</a>
<a href="{{ route('user.reports.excel') }}" class="btn btn-success">Excel</a>
@endsection
