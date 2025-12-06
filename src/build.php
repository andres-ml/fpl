<?php 

require_once __DIR__ . '/../vendor/autoload.php';
require 'reflection.php';

use PhpParser\{
    BuilderFactory,
    Node\Arg,
    Node\Expr,
    Node\Name,
    Node\Stmt,
    Node\Stmt\Function_,
    Node\VariadicPlaceholder,
    PrettyPrinter,
};
use PhpParser\Node\Expr\FuncCall;

use function Aml\Fpl\functions\{map, each};

$namespace = 'Aml\Fpl';

$factory = new BuilderFactory;
$node = $factory
    ->namespace($namespace)
    ->setDocComment('/* This file was automatically generated */');

$functionToCurriedCall = function(Function_ $function) use( $factory) {
    $curryCall = new FuncCall(
        new FuncCall(
            new Name("functions\\curry"),
            [
                new FuncCall(
                    new Name("functions\\$function->name"),
                    [new VariadicPlaceholder()]
                )
            ]
        ),
        [
            new Arg(
                new Expr\FuncCall(
                    new Name('func_get_args')
                ),
                false,
                true
            )
        ]
    );
    return $factory->function((string) $function->name)
        ->addStmt(new Stmt\Return_($curryCall))
        ->setDocComment($function->getDocComment() ?: '');
};


getApiFunctions()
    |> (fn($x) => map($functionToCurriedCall, $x))
    |> (fn($x) => each($node->addStmt(...), $x));

$code = (new PrettyPrinter\Standard)->prettyPrintFile([$node->getNode()]);
file_put_contents(__DIR__ . '/../' . $argv[1], $code);