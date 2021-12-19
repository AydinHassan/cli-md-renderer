<?php

namespace AydinHassan\CliMdRendererTest\InlineRenderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\CodeRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class CodeRendererTest extends AbstractInlineRendererTest implements RendererTestInterface
{
    public function getRendererClass(): string
    {
        return CodeRenderer::class;
    }

    public function testRender(): void
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class();
        $code           = new Code('SOME CODE');
        $color          = new Color();
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [], $color);

        $this->assertEquals(
            "[33mSOME CODE[0m",
            $renderer->render($code, $cliRenderer)
        );
    }
}
