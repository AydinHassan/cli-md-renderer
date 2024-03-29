<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Node\Inline\AbstractInline;
use League\CommonMark\Node\Inline\Newline;
use AydinHassan\CliMdRenderer\CliRenderer;

class NewlineRenderer implements CliInlineRendererInterface
{
    public function render(AbstractInline $inline, CliRenderer $renderer): string
    {
        if (!($inline instanceof Newline)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return "\n";
    }
}
