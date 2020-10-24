<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Link;
use AydinHassan\CliMdRenderer\CliRenderer;

class LinkRenderer implements CliInlineRendererInterface
{
    public function render(AbstractInline $inline, CliRenderer $renderer): string
    {
        if (!($inline instanceof Link)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return $renderer->style($renderer->renderInlines($inline->children()), ['underline', 'bold', 'light_blue']);
    }
}
