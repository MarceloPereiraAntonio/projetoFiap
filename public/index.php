<?php
session_start();

require "../vendor/autoload.php";
require "../routes/web.php";

use App\Core\Route;

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__));
$dotenv->load();

Route::dispatch();