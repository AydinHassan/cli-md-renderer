<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Code;

class CodeRenderer implements CliInlineRendererInterface
{
    public function render(AbstractInline $inline, CliRenderer $renderer): string
    {
        if (!($inline instanceof Code)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return $renderer->style($inline->getContent(), 'yellow');
    }
}
