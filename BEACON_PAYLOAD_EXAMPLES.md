# Beacon Host POST Sample

Endpoint: `/api/v1/beacon/ingest`

```http
POST /api/v1/beacon/ingest
Content-Type: application/json
Accept: application/json
```

```json
[
  {"TimeStamp":"2025-07-09T19:44:20.003Z","Format":"Gateway","GatewayMAC":"E438191F48E0"},
  {"TimeStamp":"2025-07-09T19:44:11.199Z","BLEMAC":"DFB68FA5D691"}
]
```

Response:
```json
{"status":"ok","scan_id":1024,"asset_found":true}
```
