<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Node\Block\Paragraph;
use AydinHassan\CliMdRenderer\CliRenderer;
use League\CommonMark\Node\Inline\AbstractInline;

class ParagraphRenderer implements CliBlockRendererInterface
{
    public function render(AbstractBlock $block, CliRenderer $renderer): string
    {
        if (!($block instanceof Paragraph)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        /** @var array<AbstractInline> $nodes */
        $nodes = $block->children();
        return $renderer->renderInlines($nodes) . "\n";
    }
}
