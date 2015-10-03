<?php

namespace AydinHassan\CliMdRendererTest;

use AydinHassan\CliMdRenderer\CliRendererFactory;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use PHPUnit_Framework_TestCase;

/**
 * Class E2ETest
 * @package AydinHassan\CliMdRendererTest
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class E2ETest extends PHPUnit_Framework_TestCase
{
    /**
     * @param string $markdown
     * @param string $expected
     * @dataProvider e2eProvider
     */
    public function testFullRender($markdown, $expected)
    {
        $factory    = new CliRendererFactory;
        $renderer   = $factory->__invoke();
        $parser     = new DocParser(Environment::createCommonMarkEnvironment());

        $this->assertEquals($expected, $renderer->renderBlock($parser->parse($markdown)));
    }

    /**
     * @return \Generator
     */
    public function e2eProvider()
    {
        foreach (glob(__DIR__ . '/res/e2e/*.md') as $markdownFile) {
            $markdownContent = file_get_contents($markdownFile);
            $expected        = file_get_contents(substr($markdownFile, 0, -2) . 'expected');
            yield [$markdownContent, $expected];
        }
    }
}
