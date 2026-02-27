@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('superadmin.subscriptions.store') }}" class="card card-body">@csrf
<h5>Add Annual Subscription</h5>
<select name="organization_id" class="form-select mb-2" required>@foreach($organizations as $organization)<option value="{{ $organization->id }}">{{ $organization->name }}</option>@endforeach</select>
<input name="plan_name" class="form-control mb-2" placeholder="Plan Name" required>
<input type="date" name="starts_at" class="form-control mb-2" required>
<input type="date" name="ends_at" class="form-control mb-2" required>
<input name="amount" class="form-control mb-2" placeholder="Amount" required>
<select name="status" class="form-select mb-2"><option value="active">Active</option><option value="expired">Expired</option><option value="cancelled">Cancelled</option></select>
<textarea name="renewal_notes" class="form-control mb-2" placeholder="Renewal Notes"></textarea>
<button class="btn btn-success">Save</button>
</form>
@endsection
