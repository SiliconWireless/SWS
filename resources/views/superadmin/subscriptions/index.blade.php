@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h4>Annual Plans & Renewals</h4><a href="{{ route('superadmin.subscriptions.create') }}" class="btn btn-primary">Add Plan</a></div>
<table class="table bg-white"><thead><tr><th>Organization</th><th>Plan</th><th>From</th><th>To</th><th>Status</th></tr></thead><tbody>
@foreach($subscriptions as $subscription)
<tr><td>{{ $subscription->organization->name }}</td><td>{{ $subscription->plan_name }}</td><td>{{ $subscription->starts_at }}</td><td>{{ $subscription->ends_at }}</td><td>{{ $subscription->status }}</td></tr>
@endforeach
</tbody></table>
@endsection
