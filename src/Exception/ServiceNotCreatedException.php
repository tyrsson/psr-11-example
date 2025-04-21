<?php

declare(strict_types=1);

namespace Example\Exception;

use Psr\Container\ContainerExceptionInterface;

final class ServiceNotCreatedException extends \RuntimeException implements ContainerExceptionInterface {}
