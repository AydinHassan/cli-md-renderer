<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\ThematicBreak;
use AydinHassan\CliMdRenderer\CliRenderer;

class HorizontalRuleRenderer implements CliBlockRendererInterface
{
    /**
     * @var int
     */
    private $width;

    public function __construct(int $width = 30)
    {
        $this->width = $width;
    }

    public function render(AbstractBlock $block, CliRenderer $renderer): string
    {
        if (!($block instanceof ThematicBreak)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        return $renderer->style(str_repeat('-', $this->width), 'dark_gray');
    }
}
