<?php

/*
|--------------------------------------------------------------------------
| Scaffolder Configuration
|--------------------------------------------------------------------------
|
| Here you may set the configuration for the file generators. Set the
| namespace for the generator classes, and set the paths for the
| generators and stubs location.
|
*/

return [
    'namespace' => 'App\\Console\\Generators',

    'paths' => [
        'generators' => base_path('app/Console/Generators'),
        'stubs' => base_path('resources/stubs/scaffolder'),
    ],
];
