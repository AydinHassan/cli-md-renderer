<?php

namespace AydinHassan\CliMdRendererTest\Highlighter;

use AydinHassan\CliMdRenderer\Highlighter\PhpHighlighter;
use PhpSchool\PSX\SyntaxHighlighter;
use PHPUnit_Framework_TestCase;

/**
 * Class PhpHighlighterTest
 * @package AydinHassan\CliMdRendererTest\Highlighter
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class PhpHighlighterTest extends PHPUnit_Framework_TestCase
{
    public function testPhpHighlighter()
    {
        $syntaxHighlighter = $this
            ->getMockBuilder(SyntaxHighlighter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $phpHighlighter = new PhpHighlighter($syntaxHighlighter);

        $expected = '<?php echo "Hello World"';

        $syntaxHighlighter
            ->expects($this->once())
            ->method('highlight')
            ->with($expected)
            ->will($this->returnValue($expected));

        $this->assertEquals(
            $expected,
            $phpHighlighter->highlight($expected)
        );

    }
}
