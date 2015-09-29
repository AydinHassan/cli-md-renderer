<?php


namespace AydinHassan\CliMdRendererTest\Renderer;

use AydinHassan\CliMdRenderer\CliRenderer;
use AydinHassan\CliMdRenderer\Renderer\DocumentRenderer;
use AydinHassan\CliMdRenderer\Renderer\ParagraphRenderer;
use AydinHassan\CliMdRendererTest\RendererTestInterface;
use Colors\Color;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\Block\Element\Paragraph;

/**
 * Class DocumentRendererTest
 * @package AydinHassan\CliMdRendererTest\Renderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class DocumentRendererTest extends AbstractRendererTest implements RendererTestInterface
{

    /**
     * @return string
     */
    public function getRendererClass()
    {
        return DocumentRenderer::class;
    }

    public function testRender()
    {
        $class          = $this->getRendererClass();
        $renderer       = new $class;
        $doc            = new Document;
        $doc->appendChild(new Paragraph);

        $color          = new Color;
        $color->setForceStyle(true);
        $cliRenderer    = new CliRenderer([
            Paragraph::class => new ParagraphRenderer
        ], [], $color);

        $this->assertEquals(
            "\n\n",
            $renderer->render($doc, $cliRenderer)
        );
    }
}
