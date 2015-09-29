<?php

namespace AydinHassan\CliMdRenderer\InlineRenderer;

use League\CommonMark\Inline\Element\AbstractInline;
use AydinHassan\CliMdRenderer\CliRenderer;

/**
 * Interface CliInlineRendererInterface
 * @package PhpWorkshop\PhpWorkshop\Md\InlineRenderer
 * @author  Aydin Hassan <aydin@hotmail.co.uk>
 */
interface CliInlineRendererInterface
{

    /**
     * @param AbstractInline $inline
     * @param CliRenderer    $renderer
     *
     * @return string
     */
    public function render(AbstractInline $inline, CliRenderer $renderer);
}
