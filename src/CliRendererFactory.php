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
use League\CommonMark\Node\Block\Document;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Block\ThematicBreak;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\CodeRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\EmphasisRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\StrongRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\NewlineRenderer;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Node\Inline\Emphasis;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use League\CommonMark\Node\Inline\Newline;

class CliRendererFactory
{
    public function __invoke(): CliRenderer
    {

        $codeRender = new FencedCodeRenderer();
        $keyLighter = new KeyLighter();
        $keyLighter->init();
        $codeRender->addSyntaxHighlighter('php', new PhpHighlighter($keyLighter));

        $blockRenderers = [
            Document::class         => new DocumentRenderer(),
            Heading::class          => new HeaderRenderer(),
            ThematicBreak::class    => new HorizontalRuleRenderer(),
            Paragraph::class        => new ParagraphRenderer(),
            FencedCode::class       => $codeRender,
            ListBlock::class        => new ListBlockRenderer(),
            ListItem::class         => new ListItemRenderer(),
        ];

        $inlineBlockRenderers = [
            Text::class             => new TextRenderer(),
            Code::class             => new CodeRenderer(),
            Emphasis::class         => new EmphasisRenderer(),
            Strong::class           => new StrongRenderer(),
            Newline::class          => new NewlineRenderer(),
            Link::class             => new LinkRenderer(),
        ];

        $colors = new Color();
        $colors->setForceStyle(true);

        return new CliRenderer($blockRenderers, $inlineBlockRenderers, $colors);
    }
}
