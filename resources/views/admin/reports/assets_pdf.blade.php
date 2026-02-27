<h2>Asset Report</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
<tr><th>Code</th><th>Name</th><th>Status</th><th>Last Seen</th></tr>
@foreach($assets as $asset)
<tr><td>{{ $asset->asset_code }}</td><td>{{ $asset->name }}</td><td>{{ $asset->status }}</td><td>{{ $asset->last_seen_at }}</td></tr>
@endforeach
</table>
