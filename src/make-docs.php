<?php 

require 'reflection.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Aml\Fpl;
use PhpParser\PrettyPrinter;

$printer = (new PrettyPrinter\Standard);

$toMarkdownSnippet = function($function) use($printer) : string
{
    $matchAll = function($pattern, $string) {
        $matches = [];
        preg_match_all($pattern, $string, $matches);
        return $matches;
    };

    $docTextRegex = '/^ \* ([^@\n].*)/m';
    $headerRegex = '/^function (.+)/m';

    // extract doc comments
    $docComment = (string) $function->getDocComment();
    $text = implode(PHP_EOL, $matchAll($docTextRegex, $docComment)[1]);
    // hint php on code snippets: ``` -> ```php
    $text = preg_replace('/(```)((?:.|\n)*?)(```)/', '```php${2}${3}', $text);

    $functionString = $printer->prettyPrintFile([$function]);
    $signature = $matchAll($headerRegex, $functionString)[1][0];
    
    return <<<MD
#### `$signature`

$text
MD;
};

$separator = PHP_EOL . '#' . PHP_EOL;
$markdown = implode($separator, Fpl\map($toMarkdownSnippet, getApiFunctions()));
echo $markdown;