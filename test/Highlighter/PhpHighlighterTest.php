<?php

namespace AydinHassan\CliMdRendererTest\Highlighter;

use AydinHassan\CliMdRenderer\Highlighter\PhpHighlighter;
use Kadet\Highlighter\Formatter\CliFormatter;
use Kadet\Highlighter\KeyLighter;
use Kadet\Highlighter\Language\Php;
use PhpSchool\PSX\SyntaxHighlighter;
use PHPUnit_Framework_TestCase;
use Prophecy\Argument;

/**
 * Class PhpHighlighterTest
 * @package AydinHassan\CliMdRendererTest\Highlighter
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class PhpHighlighterTest extends PHPUnit_Framework_TestCase
{
    public function testPhpHighlighter()
    {
        $expected = '<?php echo "Hello World"';

        $highlighter = $this->prophesize(KeyLighter::class);
        $highlighter->highlight($expected, Argument::type(Php::class), Argument::type(CliFormatter::class))->willReturn($expected);

        $phpHighlighter = new PhpHighlighter($highlighter->reveal());

        self::assertEquals(
            $expected,
            $phpHighlighter->highlight($expected)
        );
    }
}
