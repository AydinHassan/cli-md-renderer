<?php

namespace AydinHassan\CliMdRendererTest\InlineRenderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\EmphasisRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Inline\Element\Emphasis;
use League\CommonMark\Inline\Element\Text;

class EmphasisRendererTest extends AbstractInlineRendererTest implements RendererTestInterface
{

    /**
     * @return string
     */
    public function getRendererClass()
    {
        return EmphasisRenderer::class;
    }

    public function testRender()
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class();
        $emphasis       = new Emphasis();
        $emphasis->appendChild(new Text('Some Text'));

        $color          = new Color();
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [
            Text::class => new TextRenderer()
        ], $color);

        $this->assertEquals(
            "[3mSome Text[0m",
            $renderer->render($emphasis, $cliRenderer)
        );
    }
}
