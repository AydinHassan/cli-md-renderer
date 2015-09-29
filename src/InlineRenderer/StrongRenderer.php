<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Strong;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Class StrongRenderer
 * @package AydinHassan\CliMdRenderer\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class StrongRenderer implements CliInlineRendererInterface
{

    /**
     * @param AbstractInline $inline
     * @param CliRenderer    $renderer
     *
     * @return string
     */
    public function render(AbstractInline $inline, CliRenderer $renderer)
    {
        if (!($inline instanceof Strong)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return $renderer->style($renderer->renderInlines($inline->children()), 'bold');
    }
}
