<?php

namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRendererTest\RendererTestInterface;
use League\CommonMark\Block\Element\AbstractBlock;
use PHPUnit_Framework_TestCase;
use AydinHassan\CliMdRenderer\CliRenderer;
use InvalidArgumentException;

/**
 * Class AbstractRendererTest
 * @package AydinHassan\CliMdRendererTest\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
abstract class AbstractRendererTest extends PHPUnit_Framework_TestCase
{
    public function testExceptionIsThrownIfNotCorrectBlock()
    {
        if (!$this instanceof RendererTestInterface) {
            $this->markTestSkipped('Not a Renderer');
        }

        $block = $this->getMock(AbstractBlock::class);
        $class = $this->getRendererClass();

        $cliRenderer = $this->getMockBuilder(CliRenderer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->setExpectedException(
            InvalidArgumentException::class,
            sprintf('Incompatible block type: "%s"', get_class($block))
        );
        (new $class)->render($block, $cliRenderer);
    }
}
