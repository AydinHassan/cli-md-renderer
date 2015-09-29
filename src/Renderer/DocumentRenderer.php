<?php


namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Document;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Class DocumentRenderer
 * @package AydinHassan\CliMdRenderer\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class DocumentRenderer implements CliBlockRendererInterface
{

    /**
     * @param AbstractBlock $block
     * @param CliRenderer   $renderer
     *
     * @return string
     */
    public function render(AbstractBlock $block, CliRenderer $renderer)
    {
        if (!($block instanceof Document)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        $wholeDoc = $renderer->renderBlocks($block->children());
        return $wholeDoc === '' ? '' : $wholeDoc . "\n";
    }
}
