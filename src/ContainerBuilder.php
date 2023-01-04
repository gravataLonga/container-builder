<?php declare(strict_types=1);

namespace Gravatalonga\ContainerBuilder;

use Gravatalonga\Container\Container;
use Psr\Container\ContainerInterface;

final class ContainerBuilder
{
    private Container $container;

    /** @var \Gravatalonga\ContainerBuilder\ServiceProvider[] $providers */
    private array $providers = [];

    public function __construct()
    {
        $this->container = new Container();
    }

    public function services(array $providers): void
    {
        $this->providers = $providers;
    }

    public function build(): ContainerInterface
    {
        foreach ($this->providers as $provider) {
            $factories = $provider->factories();
            foreach ($factories as $entry => $factory) {
                $this->container->share($entry, $factory);
            }
        }

        foreach ($this->providers as $provider) {
            $extensions = $provider->extensions();
            foreach ($extensions as $entry => $extension) {
                $this->container->extend($entry, $extension);
            }
        }
        return $this->container;
    }
}