@extends('layouts.app')
@section('content')
<div class="row g-3 mb-3">
    <div class="col-md-4"><div class="card stat-card"><div class="card-body"><h6>Total Assets</h6><h2>{{ $assetCount }}</h2></div></div></div>
    <div class="col-md-4"><div class="card stat-card"><div class="card-body"><h6>Checked In</h6><h2>{{ $checkedInCount }}</h2></div></div></div>
    <div class="col-md-4"><div class="card stat-card"><div class="card-body"><h6>Beacon Ingest</h6><h2 id="scanCount">{{ $recentScans->count() }}</h2></div></div></div>
</div>
<div class="card"><div class="card-header">Recent Beacon Scans</div><div class="card-body">
<table class="table table-sm"><thead><tr><th>Gateway</th><th>Tag</th><th>Timestamp</th></tr></thead><tbody id="scanRows">
@foreach($recentScans as $scan)
<tr><td>{{ $scan->gateway_mac }}</td><td>{{ $scan->ble_mac }}</td><td>{{ $scan->tag_timestamp }}</td></tr>
@endforeach
</tbody></table>
</div></div>
@endsection
@push('scripts')
<script>
setInterval(function(){
    $.get(window.location.href, function(html){
        const rows = $(html).find('#scanRows').html();
        const count = $(html).find('#scanRows tr').length;
        $('#scanRows').html(rows);
        $('#scanCount').text(count);
    });
}, 20000);
</script>
@endpush
