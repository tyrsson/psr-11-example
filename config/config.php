<?php

declare(strict_types=1);

use Example\App;
use Example\Container;
use Example\Handler\ExampleHandler;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'factories' => [
            App::class => Container\AppFactory::class,
            ExampleHandler::class => function (ContainerInterface $container) {
                return new ExampleHandler($container->get('config'));
            },
            // Add other service factories here
        ],
    ],
    'example_config' => [
        'example_key' => 'example_value',
    ],
];