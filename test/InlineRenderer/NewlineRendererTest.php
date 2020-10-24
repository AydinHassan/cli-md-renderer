<?php

namespace AydinHassan\CliMdRendererTest\InlineRenderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\NewlineRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Inline\Element\Newline;

class NewlineRendererTest extends AbstractInlineRendererTest implements RendererTestInterface
{
    public function getRendererClass(): string
    {
        return NewlineRenderer::class;
    }

    public function testRender(): void
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class();
        $emphasis       = new Newline();

        $color          = new Color();
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [], $color);

        $this->assertEquals(
            "\n",
            $renderer->render($emphasis, $cliRenderer)
        );
    }
}
