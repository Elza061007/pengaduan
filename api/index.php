<?php

echo "1. PHP MASUK<br>";

require __DIR__.'/../vendor/autoload.php';

echo "2. COMPOSER BERHASIL<br>";

$app = require_once __DIR__.'/../bootstrap/app.php';

echo "3. LARAVEL BERHASIL BOOTSTRAP<br>";

$app->handleRequest(
    Illuminate\Http\Request::capture()
);

echo "4. REQUEST SELESAI";