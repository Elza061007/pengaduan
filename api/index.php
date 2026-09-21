<?php

echo "1. PHP MASUK<br>";

require __DIR__.'/../vendor/autoload.php';

echo "2. COMPOSER BERHASIL<br>";

$app = require_once __DIR__.'/../bootstrap/app.php';

echo "3. LARAVEL BERHASIL BOOTSTRAP<br>";

echo "4. COBA LOAD VIEW<br>";

echo view('welcome');