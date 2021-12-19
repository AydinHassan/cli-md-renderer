<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Node\Block\AbstractBlock;
use AydinHassan\CliMdRenderer\CliRenderer;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;

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
