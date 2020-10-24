<?php

namespace AydinHassan\CliMdRendererTest\Highlighter;

use AydinHassan\CliMdRenderer\Highlighter\PhpHighlighter;
use Kadet\Highlighter\Formatter\CliFormatter;
use Kadet\Highlighter\KeyLighter;
use Kadet\Highlighter\Language\Php;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class PhpHighlighterTest extends TestCase
{
    public function testPhpHighlighter()
    {
        $expected = '<?php echo "Hello World"';

        $highlighter = $this->createMock(KeyLighter::class);
        $highlighter
            ->method('highlight')
            ->with(
                $expected,
                $this->isInstanceOf(Php::class),
                $this->isInstanceOf(CliFormatter::class)
            )
            ->willReturn($expected);

        $phpHighlighter = new PhpHighlighter($highlighter);

        self::assertEquals(
            $expected,
            $phpHighlighter->highlight($expected)
        );
    }
}
