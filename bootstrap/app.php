<?php

declare(strict_types=1);

use Dotenv\Dotenv;

// Init the autoloader
require dirname(__DIR__) . '/vendor/autoload.php';

// Init dotenv
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
