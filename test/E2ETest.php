<?php

namespace AydinHassan\CliMdRendererTest;

use AydinHassan\CliMdRenderer\CliRendererFactory;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Parser\MarkdownParser;
use League\CommonMark\Environment\Environment;
use PHPUnit\Framework\TestCase;

class E2ETest extends TestCase
{
    /**
     * @dataProvider e2eProvider
     */
    public function testFullRender(string $markdown, string $expected): void
    {
        $factory    = new CliRendererFactory();
        $renderer   = $factory->__invoke();
        $env        = (new Environment())->addExtension(new CommonMarkCoreExtension());
        $parser     = new MarkdownParser($env);

        $this->assertEquals($expected, $renderer->renderBlock($parser->parse($markdown)));
    }

    public function e2eProvider(): \Generator
    {
        foreach (glob(__DIR__ . '/res/e2e/*.md') as $markdownFile) {
            $markdownContent = file_get_contents($markdownFile);
            $expected        = file_get_contents(substr($markdownFile, 0, -2) . 'expected');
            yield [$markdownContent, $expected];
        }
    }
}
