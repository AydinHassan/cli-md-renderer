<?php


namespace AydinHassan\CliMdRenderer;

/**
 * Interface SyntaxHighlighterInterface
 * @package AydinHassan\CliMdRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
interface SyntaxHighlighterInterface
{
    /**
     * @param string $code
     * @return string
     */
    public function highlight($code);
}
