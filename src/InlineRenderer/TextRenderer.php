<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Text;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Class TextRenderer
 * @package AydinHassan\CliMdRenderer\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class TextRenderer implements CliInlineRendererInterface
{

    /**
     * @param AbstractInline $inline
     * @param CliRenderer    $renderer
     *
     * @return string
     */
    public function render(AbstractInline $inline, CliRenderer $renderer)
    {
        if (!($inline instanceof Text)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return $inline->getContent();
    }
}
