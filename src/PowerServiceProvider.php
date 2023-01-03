<?php declare(strict_types=1);

namespace Gravatalonga\ContainerBuilder;

abstract class PowerServiceProvider implements ServiceProvider
{
    private \ReflectionObject $objectReflection;

    public function __construct()
    {
        $this->objectReflection = new \ReflectionObject($this);
    }

    public function factories(): array
    {
        $arr = [];
        foreach ($this->objectReflection->getMethods() as $method) {
            $attributes = $method->getAttributes(Factory::class);
            if (count($attributes) <= 0) {
                continue;
            }

            /** @var \Gravatalonga\ContainerBuilder\Factory $instance */
            $instance = $attributes[0]->newInstance();
            $name = $instance->getName();

            $methodName = $method->getName();
            $arr[$name ?: $methodName] = true;
        }
        return $arr;
    }

    public function extensions(): array
    {
        return [];
    }
}