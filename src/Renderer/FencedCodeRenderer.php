<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\FencedCode;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Class FencedCodeRender
 * @package AydinHassan\CliMdRenderer\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class FencedCodeRenderer implements CliBlockRendererInterface
{

    /**
     * @param AbstractBlock $block
     * @param CliRenderer   $renderer
     *
     * @return string
     */
    public function render(AbstractBlock $block, CliRenderer $renderer)
    {
        if (!($block instanceof FencedCode)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        $text = $renderer->style($block->getStringContent(), ['yellow']);
        return implode(
            "\n",
            array_map(
                function ($row) {
                    return sprintf("    %s", $row);
                },
                explode("\n", $text)
            )
        );
    }
}
