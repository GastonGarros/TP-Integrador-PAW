<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // Should be set to false in production
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
            'db' => [
                'host' => env('DATABASE_HOST'),
                'dbname' => env('DATABASE_NAME'),
                'user' => env('DATABASE_USER'),
                'pass' => env('DATABASE_PASS'),
                'port' => env('DATABASE_PORT'),
            ],
           
        ],
       

    ]);
};
