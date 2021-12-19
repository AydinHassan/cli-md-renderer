<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Node\Block\Document;
use AydinHassan\CliMdRenderer\CliRenderer;

class DocumentRenderer implements CliBlockRendererInterface
{
    public function render(AbstractBlock $block, CliRenderer $renderer): string
    {
        if (!($block instanceof Document)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        $wholeDoc = $renderer->renderBlocks($block->children());
        return $wholeDoc === '' ? '' : $wholeDoc . "\n";
    }
}
