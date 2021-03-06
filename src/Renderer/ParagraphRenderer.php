<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Paragraph;
use AydinHassan\CliMdRenderer\CliRenderer;

class ParagraphRenderer implements CliBlockRendererInterface
{
    public function render(AbstractBlock $block, CliRenderer $renderer): string
    {
        if (!($block instanceof Paragraph)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        return $renderer->renderInlines($block->children()) . "\n";
    }
}
