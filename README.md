# AssetPulse SaaS (Laravel Blueprint)

Multi-tenant SaaS asset tracking and management platform for beacon host/tag infrastructure.

## Core features implemented
- **Role-based access**: Super Admin, Admin, User.
- **Organization provisioning** by Super Admin with initial Admin credential setup.
- **Annual subscription and renewal** tracking.
- **Organization settings** and asset master data management.
- **Beacon tagging workflow**: map BLE tag MAC to assets.
- **Beacon Host Controller API** (`POST /api/v1/beacon/ingest`) to receive host + tag packet payloads and persist scans.
- **Auto check-in/check-out events** generated from beacon packet activity.
- **Report exports** endpoints for PDF/Excel (controller stubs compatible with packages in full Laravel install).
- **Bootstrap + AJAX** dashboard widgets and ingest monitor.

## Beacon payload supported
```json
[
  { "TimeStamp": "2025-07-09T19:44:20.003Z", "Format": "Gateway", "GatewayMAC": "E438191F48E0" },
  { "TimeStamp": "2025-07-09T19:44:11.199Z", "BLEMAC": "DFB68FA5D691" }
]
```

## Notes
This repository is delivered as a **Laravel-compatible application blueprint** due restricted package download in this environment. Drop these files into a Laravel 11 project, run migrations, and install PDF/Excel packages in production.

## Suggested production stack
- Apache + PHP-FPM (cPanel)
- MySQL 8+
- Queue worker (for heavy report generation)
- Cron for subscription reminders
