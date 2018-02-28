<?php

namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\Renderer\HorizontalRuleRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use InvalidArgumentException;
use League\CommonMark\Block\Element\ThematicBreak;

/**
 * Class HorizontalRuleRendererTest
 * @package AydinHassan\CliMdRendererTest\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class HorizontalRuleRendererTest extends AbstractRendererTest implements RendererTestInterface
{

    /**
     * @return string
     */
    public function getRendererClass()
    {
        return HorizontalRuleRenderer::class;
    }

    public function testExceptionIsThrownIfWidthNotInterger()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Width should be an integer. Got: "stdClass"');

        $class = $this->getRendererClass();
        new $class(new \stdClass);
    }

    public function testRender()
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class;
        $rule           = new ThematicBreak();

        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [], $color);

        $this->assertEquals(
            "[90m------------------------------[0m",
            $renderer->render($rule, $cliRenderer)
        );
    }
}
