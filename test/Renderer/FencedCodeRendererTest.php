<?php


namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\FencedCode;
use AydinHassan\CliMdRenderer\Renderer\FencedCodeRenderer;
use PhpSchool\PSX\ColorsAdapter;
use PhpSchool\PSX\Factory;
use PhpSchool\PSX\SyntaxHighlighter;
use PhpSchool\PSX\SyntaxHighlighterConfig;

/**
 * Class FencedCodeRendererTest
 * @package AydinHassan\CliMdRendererTest\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class FencedCodeRendererTest extends AbstractRendererTest implements RendererTestInterface
{

    /**
     * @return string
     */
    public function getRendererClass()
    {
        return FencedCodeRenderer::class;
    }

    public function testRender()
    {
        $highlighterFactory = new Factory;
        $class          = $this->getRendererClass();
        $renderer       = new $class($highlighterFactory->__invoke());

        $code = $this->getMockBuilder(FencedCode::class)
            ->disableOriginalConstructor()
            ->getMock();
        $code
            ->expects($this->once())
            ->method('getStringContent')
            ->will($this->returnValue('<?php echo "Hello World";'));

        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [], $color);

        $this->assertEquals(
            "    [33mecho[0m [32m'Hello World'[0m;",
            $renderer->render($code, $cliRenderer)
        );
    }

    public function testExceptionIsThrownIfNotCorrectBlock()
    {
        $block = $this->getMock(AbstractBlock::class);
        $class = $this->getRendererClass();

        $cliRenderer = $this->getMockBuilder(CliRenderer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->setExpectedException(
            InvalidArgumentException::class,
            sprintf('Incompatible block type: "%s"', get_class($block))
        );
        $highlighterFactory = new Factory;
        (new $class($highlighterFactory->__invoke()))->render($block, $cliRenderer);
    }
}
