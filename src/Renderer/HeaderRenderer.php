<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Header;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Class HeaderRenderer
 * @package AydinHassan\CliMdRenderer\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class HeaderRenderer implements CliBlockRendererInterface
{

    /**
     * @param AbstractBlock $block
     * @param CliRenderer   $renderer
     *
     * @return string
     */
    public function render(AbstractBlock $block, CliRenderer $renderer)
    {
        if (!($block instanceof Header)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        $level  = $block->getLevel();
        $text   = $renderer->renderInlines($block->children());

        return sprintf(
            "\n%s %s\n",
            $renderer->style(str_repeat('#', $level), 'dark_gray'),
            $renderer->style($text, ['bold', 'cyan'])
        );
    }
}
