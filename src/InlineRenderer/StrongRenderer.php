<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Strong;
use AydinHassan\CliMdRenderer\CliRenderer;

class StrongRenderer implements CliInlineRendererInterface
{
    public function render(AbstractInline $inline, CliRenderer $renderer): string
    {
        if (!($inline instanceof Strong)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return $renderer->style($renderer->renderInlines($inline->children()), 'bold');
    }
}
