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

namespace Cwsr\McryptPatch\Tests\Unit;

use phpseclib\Crypt\Base;
use PHPUnit\Framework\TestCase;

class McryptCompatSpeedPatchTest extends TestCase
{
    /**
     * @return list<array{string}>
     */
    public static function algorithmProvider(): array
    {
        return [
            ['rijndael-128'],
            ['twofish'],
            ['rijndael-192'],
            ['des'],
            ['rijndael-256'],
            ['blowfish'],
            ['rc2'],
            ['tripledes'],
            ['arcfour'],
        ];
    }

    /**
     * @dataProvider algorithmProvider
     */
    public function testMcryptEngineIsDisabledWhenUsingPolyfillFunction(string $algorithm): void
    {
        $cipher = phpseclib_mcrypt_module_open($algorithm, '', $algorithm === 'arcfour' ? 'stream' : 'cbc', '');

        static::assertFalse($cipher->isValidEngine(Base::ENGINE_MCRYPT));
    }
}
