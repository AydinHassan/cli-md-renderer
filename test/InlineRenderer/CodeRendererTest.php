<?php


namespace AydinHassan\CliMdRendererTest\InlineRenderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\CodeRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Inline\Element\Code;

/**
 * Class CodeRendererTest
 * @package AydinHassan\CliMdRendererTest\InlineRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class CodeRendererTest extends AbstractInlineRendererTest implements RendererTestInterface
{

    /**
     * @return string
     */
    public function getRendererClass()
    {
        return CodeRenderer::class;
    }

    public function testRender()
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class;
        $code           = new Code('SOME CODE');
        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [], $color);

        $this->assertEquals(
            "[33mSOME CODE[0m",
            $renderer->render($code, $cliRenderer)
        );
    }
}
