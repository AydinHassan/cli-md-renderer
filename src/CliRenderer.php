<?php

namespace AydinHassan\CliMdRenderer;

use AydinHassan\CliMdRenderer\InlineRenderer\CliInlineRendererInterface;
use AydinHassan\CliMdRenderer\Renderer\CliBlockRendererInterface;
use Colors\Color;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Inline\Element\AbstractInline;
use RuntimeException;

/**
 * Class CliRenderer
 * @package PhpWorkshop\PhpWorkshop\Md
 * @author  Aydin Hassan <aydin@hotmail.co.uk>
 */
class CliRenderer
{

    /**
     * @var CliBlockRendererInterface[]
     */
    private $renderers = [];

    /**
     * @var CliInlineRendererInterface[]
     */
    private $inlineRenderers = [];

    /**
     * @var Color
     */
    private $color;

    /**
     * @param CliBlockRendererInterface[] $renderers
     * @param CliInlineRendererInterface[] $inlineRenderers
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
     * @param array|string $colourOrStyle
     *
     * @return string
     *
     */
    public function style($string, $colourOrStyle)
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
    public function renderInlines(array $inlines)
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

    /**
     * @param AbstractBlock $block
     *
     * @throws RuntimeException
     *
     * @return string
     */
    public function renderBlock(AbstractBlock $block)
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
    public function renderBlocks(array $blocks)
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
     * @param string $inlineBlockClass
     *
     * @return null|CliBlockRendererInterface
     */
    private function getInlineRendererForClass($inlineBlockClass)
    {
        if (!isset($this->inlineRenderers[$inlineBlockClass])) {
            return null;
        }

        return $this->inlineRenderers[$inlineBlockClass];
    }

    /**
     * @param string $blockClass
     *
     * @return null|CliBlockRendererInterface
     */
    private function getBlockRendererForClass($blockClass)
    {
        if (!isset($this->renderers[$blockClass])) {
            return null;
        }

        return $this->renderers[$blockClass];
    }
}
