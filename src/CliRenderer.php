<?php

namespace AydinHassan\CliMdRenderer;

use AydinHassan\CliMdRenderer\InlineRenderer\CliInlineRendererInterface;
use AydinHassan\CliMdRenderer\Renderer\CliBlockRendererInterface;
use Colors\Color;
use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Node\Inline\AbstractInline;
use RuntimeException;

class CliRenderer
{
    /**
     * @var array<CliBlockRendererInterface>
     */
    private $renderers;

    /**
     * @var array<CliInlineRendererInterface>
     */
    private $inlineRenderers;

    /**
     * @var Color
     */
    private $color;

    /**
     * @param array<CliBlockRendererInterface> $renderers
     * @param array<CliInlineRendererInterface> $inlineRenderers
     * @param Color $color
     */
    public function __construct(array $renderers, array $inlineRenderers, Color $color)
    {
        $this->color            = $color;
        $this->renderers        = $renderers;
        $this->inlineRenderers  = $inlineRenderers;
    }

    /**
     * @param string $string
     * @param array<string>|string $colourOrStyle
     *
     * @return string
     */
    public function style(string $string, $colourOrStyle): string
    {
        if (is_array($colourOrStyle)) {
            $this->color->__invoke($string);

            while ($style = array_shift($colourOrStyle)) {
                $this->color->apply($style);
            }
            return $this->color->__toString();
        }

        return $this->color->__invoke($string)->apply($colourOrStyle, $string);
    }

    /**
     * @param AbstractInline[] $inlines
     *
     * @return string
     */
    public function renderInlines(array $inlines): string
    {
        return implode(
            "",
            array_map(
                function (AbstractInline $inline) {
                    $renderer = $this->getInlineRendererForClass(get_class($inline));
                    if (!$renderer) {
                        throw new RuntimeException(
                            sprintf('Unable to find corresponding renderer for inline type: "%s"', get_class($inline))
                        );
                    }

                    return $renderer->render($inline, $this);
                },
                $inlines
            )
        );
    }

    public function renderBlock(AbstractBlock $block): string
    {
        $renderer = $this->getBlockRendererForClass(get_class($block));
        if (!$renderer) {
            throw new RuntimeException(
                sprintf('Unable to find corresponding renderer for block type: "%s"', get_class($block))
            );
        }

        return $renderer->render($block, $this);
    }

    /**
     * @param AbstractBlock[] $blocks
     *
     * @return string
     */
    public function renderBlocks(array $blocks): string
    {
        return implode(
            "\n",
            array_map(
                function (AbstractBlock $block) {
                    return $this->renderBlock($block);
                },
                $blocks
            )
        );
    }

    /**
     * @param class-string $inlineBlockClass
     * @return CliInlineRendererInterface|null
     */
    private function getInlineRendererForClass(string $inlineBlockClass): ?CliInlineRendererInterface
    {
        if (!isset($this->inlineRenderers[$inlineBlockClass])) {
            return null;
        }

        return $this->inlineRenderers[$inlineBlockClass];
    }

    /**
     * @param class-string $blockClass
     *
     * @return CliBlockRendererInterface|null
     */
    private function getBlockRendererForClass($blockClass): ?CliBlockRendererInterface
    {
        if (!isset($this->renderers[$blockClass])) {
            return null;
        }

        return $this->renderers[$blockClass];
    }
}
