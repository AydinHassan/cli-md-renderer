<?php

namespace AydinHassan\CliMdRendererTest\InlineRenderer;

use AydinHassan\CliMdRendererTest\RendererTestInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use PHPUnit_Framework_TestCase;
use AydinHassan\CliMdRenderer\CliRenderer;
use InvalidArgumentException;

/**
 * Class AbstractInlineRendererTest
 * @package AydinHassan\CliMdRendererTest\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
abstract class AbstractInlineRendererTest extends PHPUnit_Framework_TestCase
{
    public function testExceptionIsThrownIfNotCorrectBlock()
    {
        if (!$this instanceof RendererTestInterface) {
            $this->markTestSkipped('Not a Renderer');
        }

        $block = $this->getMock(AbstractInline::class);
        $class = $this->getRendererClass();

        $cliRenderer = $this->getMockBuilder(CliRenderer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->setExpectedException(
            InvalidArgumentException::class,
            sprintf('Incompatible inline type: "%s"', get_class($block))
        );
        (new $class)->render($block, $cliRenderer);
    }
}
