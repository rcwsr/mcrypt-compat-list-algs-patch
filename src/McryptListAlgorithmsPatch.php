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

namespace Cwsr\McryptPatch;

use Asmblah\PhpCodeShift\CodeShift;
use Asmblah\PhpCodeShift\CodeShiftInterface;
use Asmblah\PhpCodeShift\Shifter\Filter\FileFilter;
use Asmblah\PhpCodeShift\Shifter\Shift\Shift\FunctionHook\FunctionHookShiftSpec;
use Nytris\Core\Package\PackageContextInterface;
use Nytris\Core\Package\PackageFacadeInterface;
use Nytris\Core\Package\PackageInterface;

class McryptListAlgorithmsPatch implements PackageFacadeInterface
{
    private static bool $installed = false;
    private static ?CodeShiftInterface $codeShift = null;

    public static function getName(): string
    {
        return 'mcrypt-compat-list-algs-patch';
    }

    public static function getVendor(): string
    {
        return 'cwsr';
    }

    public static function install(PackageContextInterface $packageContext, PackageInterface $package): void
    {
        self::$codeShift = new CodeShift();

        self::$codeShift->shift(
            new FunctionHookShiftSpec(
                'mcrypt_list_algorithms',
                fn(callable $original) => static fn($libDir = '') => self::$installed ? phpseclib_mcrypt_list_algorithms($libDir) : $original($libDir)
            ),
            new FileFilter('**/vendor/phpseclib/phpseclib/phpseclib/Crypt/Base.php'),
        );

        self::$installed = true;
    }

    public static function isInstalled(): bool
    {
        return self::$installed;
    }

    public static function uninstall(): void
    {
        if (!self::$installed) {
            return;
        }

        self::$codeShift->uninstall();
        self::$codeShift = null;
        self::$installed = false;
    }
}
