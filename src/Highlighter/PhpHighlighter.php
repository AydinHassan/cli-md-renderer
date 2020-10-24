<?php

namespace AydinHassan\CliMdRenderer\Highlighter;

use AydinHassan\CliMdRenderer\SyntaxHighlighterInterface;
use Kadet\Highlighter\Formatter\CliFormatter;
use Kadet\Highlighter\KeyLighter;
use Kadet\Highlighter\Language\Php;

class PhpHighlighter implements SyntaxHighlighterInterface
{
    /**
     * @var KeyLighter
     */
    private $keyLighter;

    public function __construct(KeyLighter $keyLighter)
    {
        $this->keyLighter = $keyLighter;
    }

    public function highlight(string $code): string
    {
        return $this->keyLighter->highlight($code, new Php(), new CliFormatter());
    }
}
