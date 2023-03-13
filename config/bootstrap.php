<?php

declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
define('ASSETS_PATH', '/app/assets');

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..');
$dotenv->safeLoad();
