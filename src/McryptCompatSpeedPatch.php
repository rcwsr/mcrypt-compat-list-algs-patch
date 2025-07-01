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

namespace Cwsr\McryptPatch;

use Asmblah\PhpCodeShift\CodeShift;
use Asmblah\PhpCodeShift\CodeShiftInterface;
use Asmblah\PhpCodeShift\Shifter\Filter\FileFilter;
use Asmblah\PhpCodeShift\Shifter\Shift\Shift\ClassHook\ClassHookShiftSpec;
use Nytris\Core\Package\PackageContextInterface;
use Nytris\Core\Package\PackageFacadeInterface;
use Nytris\Core\Package\PackageInterface;

class McryptCompatSpeedPatch implements PackageFacadeInterface
{
    private static bool $installed = false;
    private static ?CodeShiftInterface $codeShift = null;

    public static function getName(): string
    {
        return 'mcrypt-compat-speed-patch';
    }

    public static function getVendor(): string
    {
        return 'cwsr';
    }

    public static function install(PackageContextInterface $packageContext, PackageInterface $package): void
    {
        self::$codeShift = new CodeShift();

        $replacements = [
            \phpseclib\Crypt\Blowfish::class => Hook\Blowfish::class,
            \phpseclib\Crypt\DES::class => Hook\DES::class,
            \phpseclib\Crypt\RC2::class => Hook\RC2::class,
            \phpseclib\Crypt\RC4::class => Hook\RC4::class,
            \phpseclib\Crypt\Rijndael::class => Hook\Rijndael::class,
            \phpseclib\Crypt\TripleDES::class => Hook\TripleDES::class,
            \phpseclib\Crypt\Twofish::class => Hook\Twofish::class,
        ];

        $fileFilter = new FileFilter('**/vendor/phpseclib/mcrypt_compat/lib/mcrypt.php');

        foreach ($replacements as $original => $replacement) {
            self::$codeShift->shift(
                new ClassHookShiftSpec($original, $replacement),
                $fileFilter
            );
        }

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
