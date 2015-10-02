<?php

namespace AydinHassan\CliMdRenderer\Renderer;

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
     * @var SyntaxHighlighter
     */
    private $syntaxHighlighter;

    /**
     * @param SyntaxHighlighter $syntaxHighlighter
     */
    public function __construct(SyntaxHighlighter $syntaxHighlighter)
    {
        $this->syntaxHighlighter = $syntaxHighlighter;
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

        if ('php' !== $codeType) {
            return $this->indent($renderer->style($block->getStringContent(), 'yellow'));
        }

        return sprintf(
            "    %s\n%s",
            $renderer->style('<?php', 'cyan'),
            $this->indent($this->syntaxHighlighter->highlight($block->getStringContent())) . "\n"
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
