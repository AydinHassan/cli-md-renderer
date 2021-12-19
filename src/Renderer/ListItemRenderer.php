<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Node\Block\AbstractBlock;
use AydinHassan\CliMdRenderer\CliRenderer;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;

class ListItemRenderer implements CliBlockRendererInterface
{
    public function render(AbstractBlock $block, CliRenderer $renderer): string
    {
        if (!($block instanceof ListItem)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        return $renderer->style(' * ', 'yellow') . $renderer->renderBlocks($block->children());
    }
}
