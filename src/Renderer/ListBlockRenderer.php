<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\HorizontalRule;
use AydinHassan\CliMdRenderer\CliRenderer;
use League\CommonMark\Block\Element\ListBlock;

class ListBlockRenderer implements CliBlockRendererInterface
{
    public function render(AbstractBlock $block, CliRenderer $renderer): string
    {
        if (!($block instanceof ListBlock)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        return $renderer->renderBlocks($block->children());
    }
}
