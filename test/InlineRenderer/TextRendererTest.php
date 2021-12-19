<?php

namespace AydinHassan\CliMdRendererTest\InlineRenderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Node\Inline\Text;

class TextRendererTest extends AbstractInlineRendererTest implements RendererTestInterface
{
    public function getRendererClass(): string
    {
        return TextRenderer::class;
    }

    public function testRender(): void
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class();
        $text           = new Text('HEY');

        $color          = new Color();
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [], $color);

        $this->assertEquals(
            "HEY",
            $renderer->render($text, $cliRenderer)
        );
    }
}
