<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

// --- PERBAIKAN DI SINI ---
// Kita pisahkan prosesnya menjadi 3 langkah agar lebih aman:

// 1. Tangkap Request
$request = Request::capture();

// 2. Proses Request menjadi Response
$response = $kernel->handle($request);

// 3. Kirim Response ke browser
$response->send();

// 4. Terminasi (Selesaikan proses)
$kernel->terminate($request, $response);