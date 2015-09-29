<?php

namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRenderer\Renderer\ParagraphRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\Inline\Element\Text;

/**
 * Class ParagraphRendererTest
 * @package AydinHassan\CliMdRendererTest\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class ParagraphRendererTest extends AbstractRendererTest implements RendererTestInterface
{

    /**
     * @return string
     */
    public function getRendererClass()
    {
        return ParagraphRenderer::class;
    }

    public function testRender()
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class;
        $paragraph      = new Paragraph;
        $paragraph->appendChild(new Text('Some Text 1'));
        $paragraph->appendChild(new Text('Some Text 2'));


        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [
            Text::class => new TextRenderer
        ], $color);

        $this->assertEquals(
            "Some Text 1Some Text 2\n",
            $renderer->render($paragraph, $cliRenderer)
        );
    }
}
