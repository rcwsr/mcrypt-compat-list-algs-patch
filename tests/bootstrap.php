<?php

/*
 * mcrypt-compat-list-algs-patch Nytris plugin
 * Copyright (c) Robin Cawser
 * https://github.com/rcwsr/mcrypt-compat-list-algs-patch
 *
 * Released under the MIT license.
 * https://github.com/rcwsr/mcrypt-compat-list-algs-patch/raw/main/MIT-LICENSE.txt
 */

declare(strict_types=1);

use Cwsr\McryptPatch\McryptListAlgorithmsPatchPackage;
use Nytris\Boot\BootConfig;
use Nytris\Boot\PlatformConfig;
use Nytris\Nytris;

require_once __DIR__ . '/../vendor/autoload.php';

$bootConfig = new BootConfig(new PlatformConfig(dirname(__DIR__) . '/var/nytris/'));
$bootConfig->installPackage(new McryptListAlgorithmsPatchPackage());
Nytris::boot($bootConfig);
