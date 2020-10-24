<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use AydinHassan\CliMdRenderer\SyntaxHighlighterInterface;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\FencedCode;
use AydinHassan\CliMdRenderer\CliRenderer;

class FencedCodeRenderer implements CliBlockRendererInterface
{
    /**
     * @var array<SyntaxHighlighterInterface>
     */
    private $highlighters;

    /**
     * @param array<SyntaxHighlighterInterface> $syntaxHighlighters
     */
    public function __construct(array $syntaxHighlighters = [])
    {
        foreach ($syntaxHighlighters as $language => $syntaxHighlighter) {
            $this->addSyntaxHighlighter($language, $syntaxHighlighter);
        }
    }

    public function addSyntaxHighlighter(string $language, SyntaxHighlighterInterface $highlighter): void
    {
        $this->highlighters[$language] = $highlighter;
    }

    /**
     * @return array<SyntaxHighlighterInterface>
     */
    public function getSyntaxHighlighters(): array
    {
        return $this->highlighters;
    }

    public function render(AbstractBlock $block, CliRenderer $renderer): string
    {
        if (!($block instanceof FencedCode)) {
            throw new \InvalidArgumentException(sprintf('Incompatible block type: "%s"', get_class($block)));
        }

        $infoWords = $block->getInfoWords();
        $codeType = null;
        if (count($infoWords) !== 0 && strlen($infoWords[0]) !== 0) {
            $codeType = $infoWords[0];
        }

        if (null === $codeType || !isset($this->highlighters[$codeType])) {
            return $this->indent($renderer->style($block->getStringContent(), 'yellow'));
        }

        return $this->indent(
            sprintf("%s\n", $this->highlighters[$codeType]->highlight($block->getStringContent()))
        );
    }

    private function indent(string $string): string
    {
        return implode(
            "\n",
            array_map(
                function ($row) {
                    return sprintf("    %s", $row);
                },
                explode("\n", $string)
            )
        );
    }
}
