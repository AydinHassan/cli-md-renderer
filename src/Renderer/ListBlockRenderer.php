<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\HorizontalRule;
use AydinHassan\CliMdRenderer\CliRenderer;
use League\CommonMark\Block\Element\ListBlock;

/**
 * @package AydinHassan\CliMdRenderer\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class ListBlockRenderer implements CliBlockRendererInterface
{

    /**
     * @param AbstractBlock $block
     * @param CliRenderer   $renderer
     *
     * @return string
     */
    public function render(AbstractBlock $block, CliRenderer $renderer)
    {
        if (!($block instanceof ListBlock)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        return $renderer->renderBlocks($block->children());
    }
}
