<?php

/*
 * mcrypt-compat-speed-patch Nytris plugin
 * Copyright (c) Robin Cawser
 * https://github.com/rcwsr/mcrypt-compat-speed-patch
 *
 * Released under the MIT license.
 * https://github.com/rcwsr/mcrypt-compat-speed-patch/raw/main/MIT-LICENSE.txt
 */

declare(strict_types=1);

namespace Cwsr\McryptPatch\Hook;

use Cwsr\McryptPatch\Hook\Trait\InvalidateMcryptEngine;

class Blowfish extends \phpseclib\Crypt\Blowfish
{
    use InvalidateMcryptEngine;
}
