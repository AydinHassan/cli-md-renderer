<?php

namespace AydinHassan\CliMdRendererTest;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\CliRendererFactory;
use PHPUnit\Framework\TestCase;

class CliRendererFactoryTest extends TestCase
{
    public function testFactoryReturnsInstance(): void
    {
        $factory = new CliRendererFactory();
        $this->assertInstanceOf(CliRenderer::class, $factory->__invoke());
    }
}
