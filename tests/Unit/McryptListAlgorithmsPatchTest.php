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

namespace Cwsr\McryptPatch\Tests\Unit;

use Asmblah\PhpCodeShift\Shifter\Hook\FunctionHooks;
use Nytris\Nytris;
use PHPUnit\Framework\TestCase;

class McryptListAlgorithmsPatchTest extends TestCase
{
    public function testExtensionMcryptListAlgorithmsIsNotCalled(): void
    {
        static::assertSame(phpseclib_mcrypt_list_algorithms(), FunctionHooks::callFunction('mcrypt_list_algorithms', []));
    }

    public function testExtensionMcryptListAlgorithmsIsIsCalledWhenPackageNotInstalled(): void
    {
        Nytris::getPlatform()->shutdown();
        static::assertSame(mcrypt_list_algorithms(), FunctionHooks::callFunction('mcrypt_list_algorithms', []));
    }
}
