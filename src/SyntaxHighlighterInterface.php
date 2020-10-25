<?php

namespace AydinHassan\CliMdRenderer;

interface SyntaxHighlighterInterface
{
    public function highlight(string $code): string;
}
