<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Iluminate\Container\Container;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getContainer(array $classes)
    {
        $container = Mockery::mock(Container::class);

        foreach ($classes as $class => $mock) {
            $container
                ->shouldReceive('getInstance')
                ->andReturnSelf();

            if (is_array($mock)) {
                $container
                    ->shouldReceive('make')
                    ->with($class, $mock[1])
                    ->andReturn($mock[0]);
            } else {
                $container
                    ->shouldReceive('make')
                    ->with($class)
                    ->andReturn($mock);
            }
        }

        return $container;
    }

    protected function getContainerSpy()
    {
        return Mockery::spy(Container::class);
    }
}

