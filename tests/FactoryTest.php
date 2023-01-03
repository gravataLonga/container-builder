<?php

namespace Tests;

use Gravatalonga\ContainerBuilder\Factory;
use Gravatalonga\ContainerBuilder\PowerServiceProvider;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    /**
     * @test
     */
    public function can_get_factories_entries ()
    {
        $service = new class() extends PowerServiceProvider
        {
            #[Factory]
            public function env(): string
            {
                return 'PRD';
            }
        };

        $factories = $service->factories();

        $this->assertNotEmpty($factories);
        $this->assertIsArray($factories);
        $this->assertArrayHasKey('env', $factories);
    }

    /**
     * @test
     */
    public function can_define_name_entry ()
    {
        $service = new class() extends PowerServiceProvider
        {
            #[Factory(name: 'my_env')]
            public function env(): string
            {
                return 'PRD';
            }
        };

        $factories = $service->factories();

        $this->assertNotEmpty($factories);
        $this->assertIsArray($factories);
        $this->assertArrayHasKey('my_env', $factories);
    }

    /**
     * @test
     */
    public function array_is_empty ()
    {
        $service = new class() extends PowerServiceProvider
        {
            public function env(): string
            {
                return 'PRD';
            }
        };

        $factories = $service->factories();

        $this->assertEmpty($factories);
        $this->assertIsArray($factories);
    }
}