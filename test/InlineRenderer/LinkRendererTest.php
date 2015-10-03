<?php


namespace AydinHassan\CliMdRendererTest\InlineRenderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\LinkRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Element\Text;

/**
 * Class LinkRendererTest
 * @package AydinHassan\CliMdRendererTest\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class LinkRendererTest extends AbstractInlineRendererTest implements RendererTestInterface
{

    /**
     * @return string
     */
    public function getRendererClass()
    {
        return LinkRenderer::class;
    }

    public function testRender()
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class;
        $link           = new Link('http://www.google.com');
        $link->appendChild(new Text('http://www.google.com'));

        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [
            Text::class => new TextRenderer
        ], $color);

        $this->assertSame(
            "[94m[1m[4mhttp://www.google.com[0m[0m[0m",
            $renderer->render($link, $cliRenderer)
        );
    }
}
