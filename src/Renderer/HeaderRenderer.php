<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use AydinHassan\CliMdRenderer\CliRenderer;
use League\CommonMark\Node\Inline\AbstractInline;

class HeaderRenderer implements CliBlockRendererInterface
{
    public function render(AbstractBlock $block, CliRenderer $renderer): string
    {
        if (!($block instanceof Heading)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        /** @var array<AbstractInline> $nodes */
        $nodes = $block->children();

        $level  = $block->getLevel();
        $text   = $renderer->renderInlines($nodes);

        return sprintf(
            "\n%s %s\n",
            $renderer->style(str_repeat('#', $level), 'dark_gray'),
            $renderer->style($text, ['bold', 'cyan'])
        );
    }
}
