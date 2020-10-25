<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Inline\Element\AbstractInline;
use AydinHassan\CliMdRenderer\CliRenderer;

interface CliInlineRendererInterface
{
    public function render(AbstractInline $inline, CliRenderer $renderer): string;
}
