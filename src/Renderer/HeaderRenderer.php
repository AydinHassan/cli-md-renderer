<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use AydinHassan\CliMdRenderer\CliRenderer;

class HeaderRenderer implements CliBlockRendererInterface
{
    public function render(AbstractBlock $block, CliRenderer $renderer): string
    {
        if (!($block instanceof Heading)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        $level  = $block->getLevel();
        $text   = $renderer->renderInlines($block->children());

        return sprintf(
            "\n%s %s\n",
            $renderer->style(str_repeat('#', $level), 'dark_gray'),
            $renderer->style($text, ['bold', 'cyan'])
        );
    }
}
