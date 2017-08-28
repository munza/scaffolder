# Scaffolder

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]



## Install

- Install via Composer

``` bash
$ composer require munza/scaffolder
```

- Register service provider

```php
// config/app.php
[
    'providers' => [
        Munza\Scaffolder\ScaffolderServiceProvider::class,
    ]
]
```
- Publish config file
    - Laravel 5.4
    
    ```bash
    $ php artisan vendor:publish --provider="Munza\Scaffolder\ScaffolderServiceProvider"
    ```
    
    - Laravel 5.5 (select the provider after runniing)
    
    ```bash
    $ php artisan vendor:publish
    ```

    - Lumen

    ```bash
    $ cp vendor/munza/scaffolder/resources/config/scaffolder.php config/scaffolder.php
    ```

    ```php
    // bootstrap/app.php
    $app->configure('scaffolder');
    ```

## Configration

- Edit `config/scaffolder.php`
    - `namespace`: The namespace for the generator classes.
    - `paths.generators`: The location for the generator classes.
    - `stubs.generators`: The location for the stub files.

## Usage

- Create generator

```bash
$ php artisan make:generator NewGenerator
```

- Create stub

```bash
$ php artisan make:stub new
```

- Edit generator class

```php
// app/Console/Generators/NewGenerator.php

class NewGenerator extends Command
{
    protected $signature = 'make:new {name}';

    protected $description = 'Command description';

    public function create()
    {
        return $this->createFileFromStub(
            base_path("/app/NewFolder/{$this->argument('name')}.php"),
            'scaffolder::new',
            [
                'class' => $this->argument('name'),
            ]
        );
    }
}
```

- Register generator

```php
// app/Console/Kernel.php

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Generators\NewGenerator::class,
    ];
}
```

- Run generator
```bash
$ php artisan make:new NewFile
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

No testing available right now.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email tawsif.aqib@gmail.com instead of using the issue tracker.

## Credits

- [Tawsif Aqib][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/munza/scaffolder.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/munza/scaffolder/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/munza/scaffolder.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/munza/scaffolder.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/munza/scaffolder.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/munza/scaffolder
[link-travis]: https://travis-ci.org/munza/scaffolder
[link-scrutinizer]: https://scrutinizer-ci.com/g/munza/scaffolder/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/munza/scaffolder
[link-downloads]: https://packagist.org/packages/munza/scaffolder
[link-author]: https://github.com/munza
[link-contributors]: ../../contributors
