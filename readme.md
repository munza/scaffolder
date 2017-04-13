## Scaffolder

A package to create generator for Laravel/Lumen to add generator command in a project.

### Installation
- `composer require munza/scaffolder --dev`

#### Laravel
- Add `Munza\Scaffolder\Providers\ScaffolderServiceProvider::class,` at `config/app.php` file.
- `php artisan vendor:publish --provider="Munza\Scaffolder\Providers\ScaffolderServiceProvider"`

#### Lumen
- Add `$app->register(Munza\Scaffolder\Providers\ScaffolderServiceProvider::class);` at `bootstrap/app.php` file.
- Create config folder if it is not there with `mkdir config`.
- `cp vendor/munza/scaffolder/resources/config/scaffolder.php config/scaffolder.php`
- Add following line at `bootstrap/app.php`
- `$app->configure('scaffolder');`

### Configuration
- Edit `config/scaffolder.php` to set namespace, generators path and stubs path.

### Usage
- Create a new generator
    - `php artisan make:generator MakeSomething`


- Edit `app/Console/Generators/MakeSomething.php`

    - Edit `protected $signature = "make:something"`

    - Edit `protected $description = "Create a new something class"`

    - Edit `protected $stub = "Something.php.stub"` (inside `config('scaffolder.paths.stubs')` folder)

    - Edit `setTarget()` function to return the output file path.

    - Edit `setVars()` function to return the variables and values in the stub.
        - The variables (key) in `setVars()`'s return array will be automatically converted to `$KEY$` while replacing with values in stub file. eg. key `name` will be converted to `$NAME$` and will be replaced with it's corrensponding value in stub file.

### License
MIT
