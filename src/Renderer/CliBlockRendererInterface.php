<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Interface CliBlockRendererInterface
 * @package AydinHassan\CliMdRenderer\Renderer
 */
interface CliBlockRendererInterface
{
    /**
     * @param AbstractBlock $block
     * @param CliRenderer   $renderer
     *
     * @return string
     */
    public function render(AbstractBlock $block, CliRenderer $renderer);
}
