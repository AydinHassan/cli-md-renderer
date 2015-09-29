<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Code;

/**
 * Class CodeRenderer
 * @package AydinHassan\CliMdRenderer\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class CodeRenderer implements CliInlineRendererInterface
{

    /**
     * @param AbstractInline $inline
     * @param CliRenderer    $renderer
     *
     * @return string
     */
    public function render(AbstractInline $inline, CliRenderer $renderer)
    {
        if (!($inline instanceof Code)) {
            throw new \InvalidArgumentException(sprintf('Incompatible inline type: "%s"', get_class($inline)));
        }

        return $renderer->style($inline->getContent(), 'yellow');
    }
}
