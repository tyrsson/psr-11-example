<?php

declare(strict_types=1);

namespace Example;

use Example\Exception\ServiceNotCreatedException;
use Example\Exception\ServiceNotFoundException;
use Psr\Container\ContainerInterface;

use function class_exists;
use function is_callable;
use function is_string;
use function sprintf;

class BasicContainer implements ContainerInterface
{
    private ContainerInterface $container;

    private array $factories = [];

    private array $services = [];

    public function __construct(
        array $config = [],
    ) {
        $this->container = $this;
        $this->configure($config);
    }

    public function configure(array $config): self
    {
        if (isset($config['services'])) {
            $this->services = $config['services'] + $this->services;
        }

        if (isset($config['factories'])) {
            $this->factories = $config['factories'] + $this->factories;
        }

        return $this;
    }

    public function set(string $id, object $service): void
    {
        $this->services[$id] = $service;
    }

    public function get(string $id): array|object
    {
        if (isset($this->services[$id])) {
            return $this->services[$id];
        }

        return $this->createService($id);
    }

    private function getFactory(string $id): callable
    {
        $factory    = $this->factories[$id] ?? null;
        $lazyLoaded = false;
        if (is_string($factory) && class_exists($factory)) {
            $factory = new $factory();
            $lazyLoaded = true;
        }

        if (is_callable($factory)) {
            if ($lazyLoaded) {
                $this->factories[$id] = $factory;
            }
            return $factory;
        }

        throw new ServiceNotFoundException(sprintf('Service "%s" not found.', $id));
    }

    public function has(string $id): bool
    {
        if (isset($this->services[$id]) || isset($this->factories[$id])) {
            return true;
        }
        return false;
    }

    private function createService(string $id, ?array $options = null): object
    {
        try {
            $factory = $this->getFactory($id);
            $instance = $factory($this->container, $id, $options);
        } catch (ServiceNotFoundException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ServiceNotCreatedException(sprintf(
                'Service with id "%s" could not be created. Reason: %s',
                $id,
                $e->getMessage()
            ), (int) $e->getCode(), $e);
        }

        return $factory($this);
    }
}
