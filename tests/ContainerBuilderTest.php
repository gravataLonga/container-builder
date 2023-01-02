<?php

namespace Tests;

use Gravatalonga\Container\Container;
use Gravatalonga\ContainerBuilder\ContainerBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class ContainerBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function it_get_container ()
    {
        $builder = new ContainerBuilder();

        $container = $builder->build();

        $this->assertInstanceOf(ContainerInterface::class, $container);
    }
}