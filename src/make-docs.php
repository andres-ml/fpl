<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use PhpParser\{
    Node\Stmt\Function_,
    ParserFactory,
};

use Aml\Fpl;

$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);

$fileToStatements = Fpl\compose(
    Fpl\filter(function($statement) {
        return $statement instanceof Function_;
    }),
    Fpl\prop('stmts'),
    Fpl\index(0),
    [$parser, 'parse'],
    'file_get_contents',
);

$functions = $fileToStatements(__DIR__ . '/../' . $argv[1]);

$toMarkdownSnippet = function($function) : string {
    $docComment = (string) $function->getDocComment();
    $matchAll = function($pattern) use($docComment) {
        $matches = [];
        preg_match_all($pattern, $docComment, $matches);
        return $matches;
    };

    $docTextRegex = '/^ \* ([^@\n].+)/m';
    $paramRegex = '/@param (\S+) (\S+)/';
    $returnRegex = '/@return (\S+)/';

    $extractArg = Fpl\compose(
        Fpl\map(Fpl\nAry(1, Fpl\partial('implode', ' '))),
        Fpl\unpack(Fpl\zip),
        Fpl\slice(1, INF),
        $matchAll
    );
    
    // extract text and hint php on code snippets: ``` -> ```php
    $text = implode(PHP_EOL, $matchAll($docTextRegex)[1]);
    $text = preg_replace('/(```)((?:.|\n)*?)(```)/', '```php${2}${3}', $text);

    $params = $extractArg($paramRegex);
    $return = $extractArg($returnRegex)[0];

    $signature = $function->name . '(' . implode(', ', $params) . ') : ' . $return;
    
    return <<<MD
#### `$signature`

$text
MD;
};

echo implode(PHP_EOL.'#'.PHP_EOL, Fpl\map($toMarkdownSnippet, $functions));