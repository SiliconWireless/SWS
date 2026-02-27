# cPanel + Apache Deployment Guide

1. Create MySQL database and user in cPanel.
2. Upload project to `~/assetpulse`.
3. Point document root to `~/assetpulse/public`.
4. At project root, copy `.env.example` to `.env`, then set values:
   - `APP_ENV=production`
   - `APP_URL=https://your-domain.com`
   - `DB_CONNECTION=mysql`
   - `DB_HOST=localhost`
   - `DB_DATABASE=...`
   - `DB_USERNAME=...`
   - `DB_PASSWORD=...`
5. Import SQL bootstrap (optional alternative to migrations):
   - `mysql -u <db_user> -p siliconcpanel_basset < database/sql/siliconcpanel_basset.sql`
6. Run in Terminal:
   - `php artisan key:generate`
   - `php artisan migrate --force`
   - `php artisan db:seed --class=InitialSaasSeeder`
7. Install report packages:
   - `composer require barryvdh/laravel-dompdf`
   - `composer require maatwebsite/excel`
8. Create cron jobs:
   - `* * * * * php /home/<cpanel-user>/assetpulse/artisan schedule:run >> /dev/null 2>&1`

## Beacon Host configuration
- URL: `https://your-domain.com/api/v1/beacon/ingest`
- Method: `POST`
- Header: `Content-Type: application/json`
- Body: JSON array with gateway and BLE records.
