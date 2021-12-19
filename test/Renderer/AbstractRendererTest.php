<?php

namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRendererTest\RendererTestInterface;
use League\CommonMark\Node\Block\AbstractBlock;
use PHPUnit\Framework\TestCase;
use AydinHassan\CliMdRenderer\CliRenderer;
use InvalidArgumentException;

abstract class AbstractRendererTest extends TestCase
{
    public function testExceptionIsThrownIfNotCorrectBlock(): void
    {
        if (!$this instanceof RendererTestInterface) {
            $this->markTestSkipped('Not a Renderer');
        }

        $block = $this->createMock(AbstractBlock::class);
        $class = $this->getRendererClass();

        $cliRenderer = $this->getMockBuilder(CliRenderer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Incompatible block type: "%s"', get_class($block)));
        (new $class())->render($block, $cliRenderer);
    }
}
