<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use AydinHassan\CliMdRenderer\CliRenderer;
use League\CommonMark\Block\Element\ListItem;

/**
 * @package AydinHassan\CliMdRenderer\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class ListItemRenderer implements CliBlockRendererInterface
{

    /**
     * @param AbstractBlock $block
     * @param CliRenderer   $renderer
     *
     * @return string
     */
    public function render(AbstractBlock $block, CliRenderer $renderer)
    {
        if (!($block instanceof ListItem)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        return $renderer->style(' * ', 'yellow') . $renderer->renderBlocks($block->children());
    }
}
