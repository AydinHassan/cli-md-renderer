<?php

namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRenderer\Renderer\ListBlockRenderer;
use AydinHassan\CliMdRenderer\Renderer\ListItemRenderer;
use AydinHassan\CliMdRenderer\Renderer\ParagraphRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\ListData;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Inline\Text;

class ListBlockRendererTest extends AbstractRendererTest implements RendererTestInterface
{
    public function getRendererClass(): string
    {
        return ListBlockRenderer::class;
    }

    public function testRender(): void
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class();
        $list           = new ListBlock(new ListData());

        $color          = new Color();
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [
            Text::class => new TextRenderer()
        ], $color);

        $this->assertEquals('', $renderer->render($list, $cliRenderer));
    }

    public function testRenderWithChildren(): void
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class();
        $list           = new ListBlock(new ListData());

        $listItem1 = new ListItem(new ListData());
        $paragraph = new Paragraph();
        $paragraph->appendChild(new Text('Item 1'));
        $listItem1->appendChild($paragraph);

        $listItem2 = new ListItem(new ListData());
        $paragraph = new Paragraph();
        $paragraph->appendChild(new Text('Item 2'));
        $listItem2->appendChild($paragraph);

        $list->appendChild($listItem1);
        $list->appendChild($listItem2);

        $color          = new Color();
        $color->setForceStyle(true);
        $cliRenderer = new CliRenderer(
            [
                Paragraph::class => new ParagraphRenderer(),
                ListItem::class => new ListItemRenderer()
            ],
            [
                Text::class => new TextRenderer(),
            ],
            $color
        );

        $this->assertEquals("\e[33m * \e[0mItem 1\n\n\e[33m * \e[0mItem 2\n", $renderer->render($list, $cliRenderer));
    }
}
