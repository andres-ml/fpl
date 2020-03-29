<?php

use Aml\Fpl;
use PhpParser\Node\Stmt\Function_;
use PhpParser\ParserFactory;

/**
 * Returns a list of Function_ nodes corresponding to the api functions
 *
 * @return array
 */
function getApiFunctions() : array
{
    $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);

    $shouldCopy = function(Function_ $function) {
        $name = (string) $function->name;
        return $name[0] !== '_';
    };

    $fileToStatements = Fpl\compose(
        Fpl\filter($shouldCopy),
        Fpl\filter(Fpl\partial(Fpl\flip('is_a'), Function_::class)),
        Fpl\prop('stmts'),
        Fpl\index(0),
        [$parser, 'parse'],
        'file_get_contents',
        function($file) {
            return __DIR__ . "/api/$file";
        }
    );

    return Fpl\compose(
        Fpl\sortBy(Fpl\prop('name')),
        Fpl\flatten(1),
        Fpl\map($fileToStatements),
        Fpl\slice(2, INF), // skip '.', '..',
    )(scandir(__DIR__ . '/api'));
}