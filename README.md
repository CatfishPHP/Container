# Container (Dependency Injection)

![Logo](https://avatars0.githubusercontent.com/u/38306540?s=200&v=4)

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/catfishphp/container/master.svg?style=flat-square)](https://travis-ci.org/catfishphp/container)

This package is compliant with [PSR-1], [PSR-2] and [PSR-4]. If you notice compliance oversights,
please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md
[PSR-11]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md

## Install

Via Composer

``` bash
$ composer require catfishphp/container
```

## Requirements

The following versions of PHP are supported by this version.

* PHP 7.1
* PHP 7.2

## Usage

```php
<?php

$container = new Catfish\Container\Container;

// add a service to the container
$container->add('service', 'Acme\Service\SomeService');

// retrieve the service from the container
$service = $container->get('service');

var_dump($service instanceof Acme\Service\SomeService); // true

```

## Testing

``` bash
$ vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/catfishphp/container/blob/master/CONTRIBUTING) for details.

## License

The MIT License (MIT). Please see [License File](https://github.com/catfishphp/container/blob/master/LICENSE) for more information.
