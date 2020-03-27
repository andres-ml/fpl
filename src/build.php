<?php 

use PhpParser\{
    BuilderFactory,
    BuilderHelpers,
    Comment,
    Node\Arg,
    Node\Expr,
    Node\Const_,
    Node\Stmt,
    Node\Stmt\Function_,
    ParserFactory,
    PrettyPrinter,
};

use Aml\Fpl;

require_once __DIR__ . '/../vendor/autoload.php';

$namespace = 'Aml\Fpl';

$factory = new BuilderFactory;
$node = $factory
    ->namespace($namespace)
    ->setDocComment('/* This file was automatically generated */');

$shouldCopy = function(Function_ $function) {
    $name = (string) $function->name;
    return $name[0] !== '_';
};

$functionToCurriedCall = function(Function_ $function) use($namespace, $factory) {
    $path = "$namespace\\functions\\$function->name";
    $curryCall = $factory->funcCall("\\$namespace\\functions\\curry", [$path]);
    $curryCall = $factory->funcCall($curryCall, [new Arg(new Expr\Variable('args'), false, true)]);
    return $factory->function((string) $function->name)
        ->addParam($factory->param('args')->makeVariadic())
        ->addStmt(new Stmt\Return_($curryCall))
        ->setDocComment($function->getDocComment() ?: '');
};

$functionToConst = function(Function_ $function) use($namespace) {
    $path = "$namespace\\$function->name";
    $const = new Stmt\Const_([new Const_($function->name, BuilderHelpers::normalizeValue($path))]);
    $const->setDocComment($function->getDocComment() ?: new Comment\Doc(''));
    return $const;
};

$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
$functions = [];

$fileToStatements = Fpl\compose(
    Fpl\filter($shouldCopy),
    Fpl\filter(function($statement) {
        return $statement instanceof Function_;
    }),
    Fpl\prop('stmts'),
    Fpl\index(0),
    [$parser, 'parse'],
    'file_get_contents',
    function($file) {
        return __DIR__ . "/api/$file";
    }
);

$apiFiles = Fpl\slice(2, INF, scandir(__DIR__ . '/api'));
$functions = Fpl\compose(
    Fpl\sortBy(Fpl\prop('name')),
    Fpl\flatten(1),
    Fpl\map($fileToStatements)
)($apiFiles);

Fpl\each(Fpl\compose([$node, 'addStmt'], $functionToConst), $functions);
Fpl\each(Fpl\compose([$node, 'addStmt'], $functionToCurriedCall), $functions);

$code = (new PrettyPrinter\Standard)->prettyPrintFile([$node->getNode()]);
file_put_contents(__DIR__ . '/../' . $argv[1], $code);