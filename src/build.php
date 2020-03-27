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

$curryFunction = function(Function_ $function) use($namespace, $factory) {
    $path = "$namespace\\functions\\$function->name";
    $curryCall = $factory->funcCall("\\$namespace\\functions\\curry", [$path]);
    $curryCall = $factory->funcCall($curryCall, [new Arg(new Expr\Variable('args'), false, true)]);
    return $factory->function((string) $function->name)
        ->addParam($factory->param('args')->makeVariadic())
        ->addStmt(new Stmt\Return_($curryCall));
};

$functionToConst = function(Function_ $function) use($namespace) {
    $path = "$namespace\\$function->name";
    return new Stmt\Const_([new Const_($function->name, BuilderHelpers::normalizeValue($path))]);
};

$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
$functions = [];
$apiFiles = \Aml\Fpl\slice(2, INF, scandir(__DIR__ . '/api'));

foreach ($apiFiles as $file) {
    $AST = $parser->parse(file_get_contents(__DIR__ . "/api/$file"));
    $functions = array_merge($functions, array_filter($AST[0]->stmts, function($statement) use($shouldCopy) {
        return ($statement instanceof Function_) && $shouldCopy($statement);
    }));
}

// alphabetical sort
usort($functions, function($f1, $f2) {
    return $f1->name <=> $f2->name;
});

foreach ($functions as $function) {
    $node->addStmt($functionToConst($function));
}

// add a separator by injecting a comment to the 1st definition
$node->addStmt($curryFunction($functions[0])->setDocComment(new Comment\Doc('/* ----------------- */')));
foreach (array_slice($functions, 1) as $function) {
    $node->addStmt($curryFunction($function));
}

$code = (new PrettyPrinter\Standard)->prettyPrintFile([$node->getNode()]);
file_put_contents(__DIR__ . '/../' . $argv[1], $code);