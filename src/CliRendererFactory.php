<?php

namespace AydinHassan\CliMdRenderer;

use AydinHassan\CliMdRenderer\Highlighter\PhpHighlighter;
use AydinHassan\CliMdRenderer\InlineRenderer\LinkRenderer;
use AydinHassan\CliMdRenderer\Renderer\DocumentRenderer;
use AydinHassan\CliMdRenderer\Renderer\FencedCodeRenderer;
use AydinHassan\CliMdRenderer\Renderer\HeaderRenderer;
use AydinHassan\CliMdRenderer\Renderer\HorizontalRuleRenderer;
use AydinHassan\CliMdRenderer\Renderer\ListBlockRenderer;
use AydinHassan\CliMdRenderer\Renderer\ListItemRenderer;
use AydinHassan\CliMdRenderer\Renderer\ParagraphRenderer;
use Colors\Color;
use Kadet\Highlighter\KeyLighter;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\Block\Element\Header;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\Block\Element\HorizontalRule;
use League\CommonMark\Block\Element\ListBlock;
use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\Block\Element\FencedCode;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\CodeRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\EmphasisRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\StrongRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\NewlineRenderer;
use League\CommonMark\Block\Element\ThematicBreak;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Element\Text;
use League\CommonMark\Inline\Element\Code;
use League\CommonMark\Inline\Element\Emphasis;
use League\CommonMark\Inline\Element\Strong;
use League\CommonMark\Inline\Element\Newline;

/**
 * Class CliRendererFactory
 * @package AydinHassan\CliMdRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class CliRendererFactory
{
    /**
     * @return CliRenderer
     */
    public function __invoke()
    {

        $codeRender = new FencedCodeRenderer();
        $keyLighter = new KeyLighter;
        $keyLighter->init();
        $codeRender->addSyntaxHighlighter('php', new PhpHighlighter($keyLighter));

        $blockRenderers = [
            Document::class         => new DocumentRenderer,
            Heading::class          => new HeaderRenderer,
            ThematicBreak::class    => new HorizontalRuleRenderer,
            Paragraph::class        => new ParagraphRenderer,
            FencedCode::class       => $codeRender,
            ListBlock::class        => new ListBlockRenderer,
            ListItem::class         => new ListItemRenderer,
        ];

        $inlineBlockRenderers = [
            Text::class             => new TextRenderer,
            Code::class             => new CodeRenderer,
            Emphasis::class         => new EmphasisRenderer,
            Strong::class           => new StrongRenderer,
            Newline::class          => new NewlineRenderer,
            Link::class             => new LinkRenderer,
        ];

        $colors = new Color;
        $colors->setForceStyle(true);

        return new CliRenderer($blockRenderers, $inlineBlockRenderers, $colors);
    }
}
