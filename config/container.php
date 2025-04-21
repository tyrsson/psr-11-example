<?php

declare(strict_types=1);

use Example\BasicContainer;

// configuration is awesome
$config = require __DIR__ . '/config.php';

$deps = $config['dependencies'];
$deps['services']['config'] = $config;

return new BasicContainer($deps);