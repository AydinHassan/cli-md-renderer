<?php


namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\Highlighter\PhpHighlighter;
use AydinHassan\CliMdRenderer\SyntaxHighlighterInterface;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use InvalidArgumentException;
use Kadet\Highlighter\KeyLighter;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\FencedCode;
use AydinHassan\CliMdRenderer\Renderer\FencedCodeRenderer;

/**
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

    public function testAddSyntaxHighlighterViaConstructor()
    {
        new FencedCodeRenderer(['php' => $this->getMock(SyntaxHighlighterInterface::class)]);
    }

    public function testConstructorThrowsExceptionIfLanguageNotString()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Language must be a string. Got: "integer"'
        );

        new FencedCodeRenderer([0 => $this->getMock(SyntaxHighlighterInterface::class)]);
    }

    public function testAddSyntaxHighlighter()
    {
        $renderer = new FencedCodeRenderer;
        $renderer->addSyntaxHighlighter('php', $this->getMock(SyntaxHighlighterInterface::class));
    }

    public function testAddSyntaxHighlighterThrowsExceptionIfLanguageNotString()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Language must be a string. Got: "stdClass"'
        );

        $renderer = new FencedCodeRenderer;
        $renderer->addSyntaxHighlighter(new \stdClass, $this->getMock(SyntaxHighlighterInterface::class));
    }

    public function testRenderPhpCode()
    {
        $renderer = $this->getRenderer();
        $code = $this->getMockBuilder(FencedCode::class)
            ->disableOriginalConstructor()
            ->getMock();
        $code
            ->expects($this->once())
            ->method('getStringContent')
            ->will($this->returnValue('<?php echo \'Hello World\';'));

        $code
            ->expects($this->once())
            ->method('getInfoWords')
            ->will($this->returnValue(['php']));

        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [], $color);

        $this->assertEquals(
            "    \e[93;1m<?php\e[0m \e[33mecho\e[0m \e[32m'Hello World'\e[0m\e[33m;\e[0m\e[0m\e[0m\n    ",
            $renderer->render($code, $cliRenderer)
        );
    }

    public function testRenderNonePhpCodeIsRendererYellow()
    {
        $renderer = $this->getRenderer();

        $code = $this->getMockBuilder(FencedCode::class)
            ->disableOriginalConstructor()
            ->getMock();
        $code
            ->expects($this->once())
            ->method('getStringContent')
            ->will($this->returnValue('console.log("lol js???")'));

        $code
            ->expects($this->once())
            ->method('getInfoWords')
            ->will($this->returnValue(['js']));

        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([], [], $color);

        $this->assertEquals(
            '    [33mconsole.log("lol js???")[0m',
            $renderer->render($code, $cliRenderer)
        );
    }

    public function testExceptionIsThrownIfNotCorrectBlock()
    {
        $block = $this->getMock(AbstractBlock::class);

        $cliRenderer = $this->getMockBuilder(CliRenderer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->setExpectedException(
            InvalidArgumentException::class,
            sprintf('Incompatible block type: "%s"', get_class($block))
        );
        $this->getRenderer()->render($block, $cliRenderer);
    }

    /**
     * @return FencedCodeRenderer
     */
    private function getRenderer()
    {
        $class = $this->getRendererClass();
        $renderer = new $class;
        $renderer->addSyntaxHighlighter(
            'php',
            new PhpHighlighter(new KeyLighter)
        );

        return $renderer;
    }
}
