<?php

namespace Tests;

use Gravatalonga\Container\Container;
use Gravatalonga\ContainerBuilder\ContainerBuilder;
use Gravatalonga\ContainerBuilder\ServiceProvider;
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

    /**
     * @test
     */
    public function can_register_service_provider ()
    {
        $builder = new ContainerBuilder();
        $builder->services([
            new class() implements ServiceProvider
            {
                public function factories(): array
                {
                    return ['env' => function() { return 'PRD'; } ];
                }

                public function extensions(): array
                {
                    return [];
                }
            }
        ]);

        $container = $builder->build();

        $this->assertTrue($container->has('env'));
        $this->assertEquals('PRD', $container->get('env'));
    }

    /**
     * @test
     */
    public function can_extend_entries ()
    {
        $builder = new ContainerBuilder();
        $builder->services([
            new class() implements ServiceProvider
            {
                public function factories(): array
                {
                    return ['env' => function() { return 'PRD'; } ];
                }

                public function extensions(): array
                {
                    return [
                        'env' => function() { return 'DEV'; }
                    ];
                }
            }
        ]);

        $container = $builder->build();

        $this->assertTrue($container->has('env'));
        $this->assertEquals('DEV', $container->get('env'));
    }
}