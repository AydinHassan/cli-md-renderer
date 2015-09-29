<?php


namespace AydinHassan\CliMdRendererTest\InlineRenderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\StrongRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Inline\Element\Strong;
use League\CommonMark\Inline\Element\Text;

/**
 * Class StrongRendererTest
 * @package AydinHassan\CliMdRendererTest\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class StrongRendererTest extends AbstractInlineRendererTest implements RendererTestInterface
{

    /**
     * @return string
     */
    public function getRendererClass()
    {
        return StrongRenderer::class;
    }

    public function testRender()
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class;
        $emphasis       = new Strong();
        $emphasis->appendChild(new Text('Some Text'));

        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [
            Text::class => new TextRenderer
        ], $color);

        $this->assertEquals(
            "[1mSome Text[0m",
            $renderer->render($emphasis, $cliRenderer)
        );
    }
}
