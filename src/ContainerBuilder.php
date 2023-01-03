<?php declare(strict_types=1);

namespace Gravatalonga\ContainerBuilder;

use Gravatalonga\Container\Container;
use Psr\Container\ContainerInterface;

final class ContainerBuilder
{

    public function __construct()
    {
    }

    public function build(): ContainerInterface
    {
        return new Container();
    }
}