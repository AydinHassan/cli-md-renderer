<?php

namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRenderer\Renderer\HeaderRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Block\Element\Header;
use League\CommonMark\Inline\Element\Text;

/**
 * Class HeaderRendererTest
 * @package AydinHassan\CliMdRendererTest\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class HeaderRendererTest extends AbstractRendererTest implements RendererTestInterface
{

    /**
     * @return string
     */
    public function getRendererClass()
    {
        return HeaderRenderer::class;
    }

    public function testRender()
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class;
        $header         = new Header(2, 'HEADING!!');
        $header->appendChild(new Text('HEADING!!'));


        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [
            Text::class => new TextRenderer
        ], $color);

        $this->assertEquals(
            "\n[90m##[0m [36m[1mHEADING!![0m[0m\n",
            $renderer->render($header, $cliRenderer)
        );
    }
}
