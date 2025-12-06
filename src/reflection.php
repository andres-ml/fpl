<?php

use Aml\Fpl\functions;
use PhpParser\Node\Stmt\Function_;
use PhpParser\ParserFactory;

/**
 * Returns a list of Function_ nodes corresponding to the api functions
 *
 * @return array
 */
function getApiFunctions() : array
{
    $parser = (new ParserFactory)->createForNewestSupportedVersion();

    $shouldCopy = function(Function_ $function) {
        $name = (string) $function->name;
        return $name[0] !== '_';
    };

    $fileToStatements = fn(string $file) => __DIR__ . "/api/$file"
        |> file_get_contents(...)
        |> $parser->parse(...)
        |> (fn($x) => $x[0]->stmts)
        |> (fn($x) => array_filter($x, fn($item) => is_a($item, Function_::class)))
        |> (fn($x) => array_filter($x, $shouldCopy));

    return __DIR__ . '/api'
        |> scandir(...)
        |> (fn($x) => array_slice($x, 2))
        |> (fn($x) => array_map($fileToStatements, $x))
        |> (fn($x) => functions\flatten(1, $x))
        |> (fn($x) => functions\sortBy(fn($x) => $x->name, $x));
}