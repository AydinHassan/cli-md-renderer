<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Node\Inline\AbstractInline;
use AydinHassan\CliMdRenderer\CliRenderer;

interface CliInlineRendererInterface
{
    public function render(AbstractInline $inline, CliRenderer $renderer): string;
}
