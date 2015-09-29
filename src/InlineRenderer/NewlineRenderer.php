<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Newline;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Class NewlineRenderer
 * @package AydinHassan\CliMdRenderer\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class NewlineRenderer implements CliInlineRendererInterface
{

    /**
     * @param AbstractInline $inline
     * @param CliRenderer    $renderer
     *
     * @return string
     */
    public function render(AbstractInline $inline, CliRenderer $renderer)
    {
        if (!($inline instanceof Newline)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return "\n";
    }
}
