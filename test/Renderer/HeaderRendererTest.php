<?php

namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRenderer\Renderer\HeaderRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Node\Inline\Text;

class HeaderRendererTest extends AbstractRendererTest implements RendererTestInterface
{
    public function getRendererClass(): string
    {
        return HeaderRenderer::class;
    }

    public function testRender(): void
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class();
        $header         = new Heading(2, 'HEADING!!');
        $header->appendChild(new Text('HEADING!!'));


        $color          = new Color();
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [
            Text::class => new TextRenderer()
        ], $color);

        $this->assertEquals(
            "\n[90m##[0m [36m[1mHEADING!![0m[0m\n",
            $renderer->render($header, $cliRenderer)
        );
    }
}
