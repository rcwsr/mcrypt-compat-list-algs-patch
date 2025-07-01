# mcrypt-compat-speed-patch for phpseclib & mcrypt_compat

For the rare case that you are using the mcrypt extension at the same time as having phpseclib's mcrypt_compat v1 installed.

mcrypt-compat calls phpseclib's Base.php which calls the mcrypt extension's `mcrypt_list_algorithms()`, which is noticeably
slower than calling the polyfill's `phpseclib_mcrypt_list_algorithms()`.

See this issue for more details on this issue https://github.com/phpseclib/mcrypt_compat/issues/43

## Usage
Install this package with Composer as a Nytris package:

```shell
$ composer require cwsr/mcrypt-compat-speed-patch
```

### Configuring platform boot config

Configure [Nytris platform](https://github.com/nytris/nytris) to use this package:

`nytris.config.php`:

```php
<?php

declare(strict_types=1);

use Cwsr\McryptPatch\McryptCompatSpeedPatchPackage;
use Nytris\Boot\BootConfig;
use Nytris\Boot\PlatformConfig;

$bootConfig = new BootConfig(new PlatformConfig(__DIR__ . '/var/cache/nytris'));

// ...

$bootConfig->installPackage(new McryptCompatSpeedPatchPackage());

// ...

return $bootConfig;
```
