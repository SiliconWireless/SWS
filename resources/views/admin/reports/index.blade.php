@extends('layouts.app')
@section('content')
<h4>Asset Reports</h4>
<a href="{{ route('admin.reports.pdf') }}" class="btn btn-danger">Download PDF</a>
<a href="{{ route('admin.reports.excel') }}" class="btn btn-success">Download Excel</a>
@endsection
