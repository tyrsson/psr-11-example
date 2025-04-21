<?php

declare(strict_types=1);

namespace Example\Handler;

final class ExampleHandler
{
    public function __construct(
        // Add dependencies here
    ) {
        // Initialize dependencies
    }

    public function handle(): void
    {
        // Handle the request
        echo "Handling request...";
    }
}
