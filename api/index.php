<?php

use Illuminate\Http\Request;

echo "1. PHP MASUK<br>";

require __DIR__.'/../vendor/autoload.php';

echo "2. COMPOSER BERHASIL<br>";

$app = require_once __DIR__.'/../bootstrap/app.php';

echo "3. LARAVEL BERHASIL BOOTSTRAP<br>";

$request = Request::capture();

echo "4. REQUEST BERHASIL DIBUAT<br>";

$response = $app->handleRequest($request);

echo "5. HANDLE REQUEST SELESAI<br>";