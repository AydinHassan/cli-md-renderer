<?php

namespace AydinHassan\CliMdRenderer\Highlighter;

use AydinHassan\CliMdRenderer\SyntaxHighlighterInterface;
use PhpSchool\PSX\SyntaxHighlighter;

/**
 * Class PhpHighlighter
 * @package AydinHassan\CliMdRenderer\Highlighter
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class PhpHighlighter implements SyntaxHighlighterInterface
{
    /**
     * @var SyntaxHighlighter
     */
    private $phpHighlighter;

    /**
     * @param SyntaxHighlighter $phpHighlighter
     */
    public function __construct(SyntaxHighlighter $phpHighlighter)
    {
        $this->phpHighlighter = $phpHighlighter;
    }

    /**
     * @param string $code
     * @return string
     */
    public function highlight($code)
    {
        return $this->phpHighlighter->highlight($code);
    }
}
