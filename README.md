CLI Markdown Renderer
===========
[![Build Status](https://img.shields.io/travis/AydinHassan/cli-md-renderer.svg?style=flat-square&label=Linux)](https://travis-ci.org/AydinHassan/cli-md-renderer)
[![Windows Build Status](https://img.shields.io/appveyor/ci/AydinHassan/cli-md-renderer/master.svg?style=flat-square&label=Windows)](https://ci.appveyor.com/project/AydinHassan/cli-md-renderer)
[![Coverage Status](https://img.shields.io/codecov/c/github/AydinHassan/cli-md-renderer.svg?style=flat-square)](https://codecov.io/github/AydinHassan/cli-md-renderer)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/AydinHassan/cli-md-renderer.svg?style=flat-square)](https://scrutinizer-ci.com/g/AydinHassan/cli-md-renderer/)

## Usage

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

### To Do
- [ ] Make configurable (Line Endings, colors, styles)
- [ ] Image Renderer
- [ ] List Renderer
- [ ] Code Syntax Highlighting
- [ ] Documentation 
