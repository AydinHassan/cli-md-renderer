<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Emphasis;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Class EmphasisRenderer
 * @package AydinHassan\CliMdRenderer\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class EmphasisRenderer implements CliInlineRendererInterface
{

    /**
     * @param AbstractInline $inline
     * @param CliRenderer    $renderer
     *
     * @return string
     */
    public function render(AbstractInline $inline, CliRenderer $renderer)
    {
        if (!($inline instanceof Emphasis)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return $renderer->style($renderer->renderInlines($inline->children()), 'italic');
    }
}
