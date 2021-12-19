<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Node\Inline\AbstractInline;
use League\CommonMark\Node\Inline\Text;
use AydinHassan\CliMdRenderer\CliRenderer;

class TextRenderer implements CliInlineRendererInterface
{
    public function render(AbstractInline $inline, CliRenderer $renderer): string
    {
        if (!($inline instanceof Text)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return $inline->getLiteral();
    }
}
