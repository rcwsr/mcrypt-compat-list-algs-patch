<?php

use Asmblah\PhpCodeShift\ShiftPackage;
use Cwsr\McryptPatch\McryptCompatSpeedPatchPackage;
use Nytris\Boot\BootConfig;
use Nytris\Boot\PlatformConfig;

$bootConfig = new BootConfig(new PlatformConfig(dirname(__DIR__) . '/var/nytris/'));
$bootConfig->installPackage(new ShiftPackage());
$bootConfig->installPackage(new McryptCompatSpeedPatchPackage());

return $bootConfig;
