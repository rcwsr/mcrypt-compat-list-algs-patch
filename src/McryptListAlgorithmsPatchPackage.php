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

use Nytris\Core\Package\PackageInterface;

/**
 * For the rare case that you are using the mcrypt extension at the same time as having phpseclib's mcrypt_compat v1 installed.
 *
 * Replaces the call to \mcrypt_list_algorithms() in phpseclib v1, when both the mcrypt extension and mcrypt_compat polyfill
 * are installed. The function call is much slower than mcrypt_compat's version.
 *
 * Once phpseclib is updated to v3, the call to \mcrypt_list_algorithms() no longer happens, so this package can be deleted.
 *
 * @see https://github.com/phpseclib/mcrypt_compat/issues/43
 */
class McryptListAlgorithmsPatchPackage implements PackageInterface
{
    public function getPackageFacadeFqcn(): string
    {
        return McryptListAlgorithmsPatch::class;
    }
}
