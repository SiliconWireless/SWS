@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h4>Organizations</h4><a href="{{ route('superadmin.organizations.create') }}" class="btn btn-primary">New Organization</a></div>
<table class="table table-striped bg-white"><thead><tr><th>Name</th><th>Code</th><th>Email</th></tr></thead><tbody>
@foreach($organizations as $org)
<tr><td>{{ $org->name }}</td><td>{{ $org->code }}</td><td>{{ $org->email }}</td></tr>
@endforeach
</tbody></table>
@endsection
