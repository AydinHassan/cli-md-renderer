<?php

namespace AydinHassan\CliMdRenderer\Renderer;

use AydinHassan\CliMdRenderer\SyntaxHighlighterInterface;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\FencedCode;
use AydinHassan\CliMdRenderer\CliRenderer;
use PhpSchool\PSX\SyntaxHighlighter;

/**
 * Class FencedCodeRender
 * @package AydinHassan\CliMdRenderer\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class FencedCodeRenderer implements CliBlockRendererInterface
{
    /**
     * @var SyntaxHighlighterInterface[]
     */
    private $highlighters;

    /**
     * @param SyntaxHighlighterInterface[] $syntaxHighlighters
     */
    public function __construct(array $syntaxHighlighters = [])
    {
        foreach ($syntaxHighlighters as $language => $syntaxHighlighter) {
            $this->addSyntaxHighlighter($language, $syntaxHighlighter);
        }
    }

    /**
     * @param string $language
     * @param SyntaxHighlighterInterface $highlighter
     */
    public function addSyntaxHighlighter($language, SyntaxHighlighterInterface $highlighter)
    {
        if (!is_string($language)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Language must be a string. Got: "%s"',
                    is_object($language) ? get_class($language) : gettype($language)
                )
            );
        }

        $this->highlighters[$language] = $highlighter;
    }

    /**
     * @param AbstractBlock $block
     * @param CliRenderer   $renderer
     *
     * @return string
     */
    public function render(AbstractBlock $block, CliRenderer $renderer)
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

    /**
     * @param string $string
     * @return string
     */
    private function indent($string)
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
