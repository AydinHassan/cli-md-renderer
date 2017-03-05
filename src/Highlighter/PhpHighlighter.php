<?php

namespace AydinHassan\CliMdRenderer\Highlighter;

use AydinHassan\CliMdRenderer\SyntaxHighlighterInterface;
use Kadet\Highlighter\Formatter\CliFormatter;
use Kadet\Highlighter\KeyLighter;
use Kadet\Highlighter\Language\Php;

/**
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class PhpHighlighter implements SyntaxHighlighterInterface
{

    /**
     * @var KeyLighter
     */
    private $keyLighter;

    /**
     * @param KeyLighter $keyLighter
     */
    public function __construct(KeyLighter $keyLighter)
    {
        $this->keyLighter = $keyLighter;
    }

    /**
     * @param string $code
     * @return string
     */
    public function highlight($code)
    {
        return $this->keyLighter->highlight($code, new Php, new CliFormatter);
    }
}
