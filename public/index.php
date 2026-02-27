<?php

declare(strict_types=1);

/**
 * AssetPulse public entrypoint for Apache/cPanel hosting.
 *
 * In a full Laravel install this file boots the framework through
 * bootstrap/app.php and handles the HTTP request lifecycle.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$maintenance = __DIR__.'/../storage/framework/maintenance.php';
if (file_exists($maintenance)) {
    require $maintenance;
}

require __DIR__.'/../vendor/autoload.php';

$appBootstrap = __DIR__.'/../bootstrap/app.php';
if (! file_exists($appBootstrap)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "AssetPulse bootstrap file not found.\n";
    echo "This repository is a Laravel blueprint. Copy it into a full Laravel project (or run composer install in a complete app) so bootstrap/app.php exists.\n";
    exit;
}

/** @var Application $app */
$app = require_once $appBootstrap;

$app->handleRequest(Request::capture());
