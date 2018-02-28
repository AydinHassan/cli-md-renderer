<?php

namespace AydinHassan\CliMdRendererTest;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\CliInlineRendererInterface;
use AydinHassan\CliMdRenderer\Renderer\CliBlockRendererInterface;
use Colors\Color;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Inline\Element\AbstractInline;
use PHPUnit_Framework_TestCase;
use RuntimeException;

/**
 * Class CliRendererTest
 * @package AydinHassan\CliMdRendererTest
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class CliRendererTest extends PHPUnit_Framework_TestCase
{
    public function testRenderBlockThrowsExceptionIfNoRenderer()
    {
        $block = $this->createMock(AbstractBlock::class);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf('Unable to find corresponding renderer for block type: "%s"', get_class($block))
        );

        $renderer = new CliRenderer([], [], new Color);
        $renderer->renderBlock($block);
    }

    public function testRenderBlock()
    {
        $block = $this->createMock(AbstractBlock::class);
        $class = get_class($block);
        $blockRenderer = $this->createMock(CliBlockRendererInterface::class);
        $renderer = new CliRenderer([
            $class => $blockRenderer
        ], [], new Color);

        $blockRenderer
            ->expects($this->once())
            ->method('render')
            ->with($block, $renderer);

        $renderer->renderBlock($block);
    }

    public function testRenderBlocks()
    {
        $block1         = $this->createMock(AbstractBlock::class);
        $block2         = $this->createMock(AbstractBlock::class);
        $blockRenderer  = $this->createMock(CliBlockRendererInterface::class);

        $renderer = new CliRenderer([
            get_class($block1) => $blockRenderer,
            get_class($block2) => $blockRenderer,
        ], [], new Color);

        $blockRenderer
            ->expects($this->at(0))
            ->method('render')
            ->with($block1, $renderer)
            ->will($this->returnValue('block1'));

        $blockRenderer
            ->expects($this->at(1))
            ->method('render')
            ->with($block2, $renderer)
            ->will($this->returnValue('block2'));

        $renderer->renderBlocks([$block1, $block2]);
    }

    public function testRenderInlineBlocksThrowsExceptionIfNoRenderer()
    {
        $block = $this->createMock(AbstractInline::class);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf('Unable to find corresponding renderer for inline type: "%s"', get_class($block))
        );

        $renderer = new CliRenderer([], [], new Color);
        $renderer->renderInlines([$block]);
    }

    public function testRenderInlineBlocks()
    {
        $block1 = $this->createMock(AbstractInline::class);
        $block2 = $this->createMock(AbstractInline::class);
        $inlineRenderer  = $this->createMock(CliInlineRendererInterface::class);

        $renderer = new CliRenderer([], [
            get_class($block1) => $inlineRenderer,
            get_class($block2) => $inlineRenderer,
        ], new Color);

        $inlineRenderer
            ->expects($this->at(0))
            ->method('render')
            ->with($block1, $renderer)
            ->will($this->returnValue('inline1'));

        $inlineRenderer
            ->expects($this->at(1))
            ->method('render')
            ->with($block2, $renderer)
            ->will($this->returnValue('inline2'));

        $this->assertEquals('inline1inline2', $renderer->renderInlines([$block1, $block2]));
    }
}
