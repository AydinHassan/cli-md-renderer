<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Node\Inline\AbstractInline;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use AydinHassan\CliMdRenderer\CliRenderer;

class LinkRenderer implements CliInlineRendererInterface
{
    public function render(AbstractInline $inline, CliRenderer $renderer): string
    {
        if (!($inline instanceof Link)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        /** @var array<AbstractInline> $nodes */
        $nodes = $inline->children();
        return $renderer->style($renderer->renderInlines($nodes), ['underline', 'bold', 'light_blue']);
    }
}
