<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(ABS_PATH . '/vendor/autoload.php'); //prod

$dotenv = Dotenv\Dotenv::createImmutable(ABS_PATH);
$dotenv->load();

$dotenv->required(['DB_HOST', 'DB_USERNAME', 'DB_PASSWORD', 'DB_DATABASE']);