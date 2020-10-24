<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use AydinHassan\CliMdRenderer\CliRenderer;

interface CliBlockRendererInterface
{
    public function render(AbstractBlock $block, CliRenderer $renderer): string;
}
