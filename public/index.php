<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Kernel;

$kernel = Kernel::init();
$kernel->run();


