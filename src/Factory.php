<?php declare(strict_types=1);

namespace Gravatalonga\ContainerBuilder;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class Factory
{
    public function __construct(private ?string $name = null)
    {
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}