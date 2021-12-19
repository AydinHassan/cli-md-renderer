<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Node\Block\AbstractBlock;
use AydinHassan\CliMdRenderer\CliRenderer;

interface CliBlockRendererInterface
{
    public function render(AbstractBlock $block, CliRenderer $renderer): string;
}
