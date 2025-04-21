<?php

declare(strict_types=1);

namespace Example;

use Example\Handler\ExampleHandler;

final class App
{
    public function __construct(
        private readonly ExampleHandler $handler,
        // Add other dependencies here
    ) {}

    public function run(): void
    {
        $this->handler->handle();
    }
}
