CLI Markdown Renderer
===========
[![Build Status](https://img.shields.io/travis/AydinHassan/cli-md-renderer.svg?style=flat-square&label=Linux)](https://travis-ci.org/AydinHassan/cli-md-renderer)
[![Windows Build Status](https://img.shields.io/appveyor/ci/AydinHassan/cli-md-renderer/master.svg?style=flat-square&label=Windows)](https://ci.appveyor.com/project/AydinHassan/cli-md-renderer)
[![Coverage Status](https://img.shields.io/codecov/c/github/AydinHassan/cli-md-renderer.svg?style=flat-square)](https://codecov.io/github/AydinHassan/cli-md-renderer)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/AydinHassan/cli-md-renderer.svg?style=flat-square)](https://scrutinizer-ci.com/g/AydinHassan/cli-md-renderer/)

### Usage

```php
<?php
require_once 'vendor/autoload.php';

use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use AydinHassan\CliMdRenderer\CliRendererFactory;

$parser       = new DocParser(Environment::createCommonMarkEnvironment());
$cliRenderer  = (new CliRendererFactory)->__invoke();
$ast          = $parser->parse(file_get_contents('path/to/file.md'));

echo $cliRenderer->renderBlock($ast);
```

### Syntax Highlighting

`FencedCode` can be syntax highlighted. By default only PHP source code is Syntax Highlighted using: [php-school/psx](https://github.com/php-school/psx)
If you want to add syntax highlighting for other languages you should create a class which implements `\AydinHassan\CliMdRenderer\SyntaxHighlighterInterface`

It accepts code as a string and should return highlighted code as a string. You register your highlighter like so

```php
<?php

use AydinHassan\CliMdRenderer\Renderer\FencedCodeRenderer;

$codeRenderer = new FencedCodeRenderer;
$codeRenderer->addSyntaxHighlighter('js', new JsSyntaxHighlighter);

```

If you need to do this you cannot use the factory so construction will look something like:

```php
<?php 
require_once 'vendor/autoload.php';

use AydinHassan\CliMdRenderer\Highlighter\PhpHighlighter;
use AydinHassan\CliMdRenderer\InlineRenderer\LinkRenderer;
use AydinHassan\CliMdRenderer\Renderer\DocumentRenderer;
use AydinHassan\CliMdRenderer\Renderer\FencedCodeRenderer;
use AydinHassan\CliMdRenderer\Renderer\HeaderRenderer;
use AydinHassan\CliMdRenderer\Renderer\HorizontalRuleRenderer;
use AydinHassan\CliMdRenderer\Renderer\ParagraphRenderer;
use Colors\Color;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\Block\Element\Header;
use League\CommonMark\Block\Element\HorizontalRule;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\Block\Element\FencedCode;
use AydinHassan\CliMdRenderer\InlineRenderer\TextRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\CodeRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\EmphasisRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\StrongRenderer;
use AydinHassan\CliMdRenderer\InlineRenderer\NewlineRenderer;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Element\Text;
use League\CommonMark\Inline\Element\Code;
use League\CommonMark\Inline\Element\Emphasis;
use League\CommonMark\Inline\Element\Strong;
use League\CommonMark\Inline\Element\Newline;
use PhpSchool\PSX\Factory;

$highlighterFactory = new Factory;
$codeRender = new FencedCodeRenderer();
$codeRender->addSyntaxHighlighter('php', new PhpHighlighter($highlighterFactory->__invoke()));
$codeRender->addSyntaxHighlighter('js', new JsSyntaxHighlighter);

$blockRenderers = [
    Document::class         => new DocumentRenderer,
    Header::class           => new HeaderRenderer,
    HorizontalRule::class   => new HorizontalRuleRenderer,
    Paragraph::class        => new ParagraphRenderer,
    FencedCode::class       => $codeRender,
];

$inlineBlockRenderers = [
    Text::class             => new TextRenderer,
    Code::class             => new CodeRenderer,
    Emphasis::class         => new EmphasisRenderer,
    Strong::class           => new StrongRenderer,
    Newline::class          => new NewlineRenderer,
    Link::class             => new LinkRenderer,
];

$colors = new Color;
$colors->setForceStyle(true);

return new CliRenderer($blockRenderers, $inlineBlockRenderers, $colors);

```


### To Do
- [ ] Make configurable (Line Endings, colors, styles)
- [x] Image Renderer
- [ ] List Renderer
- [x] Code Syntax Highlighting
- [x] Documentation 
