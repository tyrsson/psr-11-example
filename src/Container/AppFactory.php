<?php

declare(strict_types=1);

namespace Example\Container;

use Example\App;
use Example\Handler\ExampleHandler;
use Psr\Container\ContainerInterface;

final class AppFactory
{
    public function __invoke(ContainerInterface $container): App
    {
        // Create and return the App instance
        return new App(
            $container->get(ExampleHandler::class),
            // Add other dependencies here
        );
    }
}
