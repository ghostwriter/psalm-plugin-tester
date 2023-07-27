<?php

use Composer\Autoload\ClassLoader;

/** @var ClassLoader $autoloader */
$autoloader = require __DIR__.'/../../../../vendor/autoload.php';
if (!$autoloader instanceof ClassLoader) {
    throw new RuntimeException('Autoloader not found');
}

$autoloader->add('', __DIR__);
