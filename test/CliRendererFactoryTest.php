<?php

namespace AydinHassan\CliMdRendererTest;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\CliRendererFactory;
use PHPUnit_Framework_TestCase;

/**
 * Class CliRendererFactoryTest
 * @package AydinHassan\CliMdRendererTest
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class CliRendererFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testFactoryReturnsInstance()
    {
        $factory = new CliRendererFactory;
        $this->assertInstanceOf(CliRenderer::class, $factory->__invoke());
    }
}
