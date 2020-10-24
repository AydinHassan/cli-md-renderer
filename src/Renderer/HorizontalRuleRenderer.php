<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\ThematicBreak;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Class HorizontalRuleRenderer
 * @package AydinHassan\CliMdRenderer\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class HorizontalRuleRenderer implements CliBlockRendererInterface
{
    /**
     * @var int
     */
    private $width;

    /**
     * @param int $width
     */
    public function __construct(int $width = 30)
    {
        $this->width = $width;
    }

    /**
     * @param AbstractBlock $block
     * @param CliRenderer   $renderer
     *
     * @return string
     */
    public function render(AbstractBlock $block, CliRenderer $renderer)
    {
        if (!($block instanceof ThematicBreak)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        return $renderer->style(str_repeat('-', $this->width), 'dark_gray');
    }
}
