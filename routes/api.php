<?php

use App\Http\Controllers\Api\BeaconIngestController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('beacon/ingest', [BeaconIngestController::class, 'store']);
});
