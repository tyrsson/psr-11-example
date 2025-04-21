<?php

declare(strict_types=1);

namespace Example\Exception;

use Psr\Container\NotFoundExceptionInterface;

final class ServiceNotFoundException extends \RuntimeException implements NotFoundExceptionInterface {}
