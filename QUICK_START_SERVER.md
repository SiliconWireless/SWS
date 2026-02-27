# Where is `index.php` and how to launch this project?

## 1) Entry file location
The environment file should be at project root: `.env` (copy from `.env.example`).

The public web entrypoint is:

- `public/index.php`

For Apache/cPanel hosting, your domain **DocumentRoot must point to `public/`**.
Do **not** point DocumentRoot to repository root.

## 2) Local launch (development)
Inside a complete Laravel install:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=InitialSaasSeeder
php artisan serve --host=0.0.0.0 --port=8000
```

Then open `http://localhost:8000`.

## 3) Apache/cPanel launch (production)
1. Upload project to e.g. `/home/<cpanel-user>/assetpulse`.
2. Set domain DocumentRoot to `/home/<cpanel-user>/assetpulse/public`.
3. Ensure `.env` has production DB/app values.
4. Run migrations and seeders from cPanel Terminal.
5. Beacon host should POST to:
   - `https://<your-domain>/api/v1/beacon/ingest`

## 4) Important note
If you see bootstrap errors, it means the project files are not yet inside a **full Laravel runtime** (`vendor/`, `bootstrap/`, etc.).
