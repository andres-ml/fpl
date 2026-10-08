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

// naive curried mixed type of either the final type or callable
$curriedDocComment = function(Function_ $function) : string {
    $docComment = (string) $function->getDocComment();
    $requiredParams = array_filter($function->params, fn($param) => !$param->default && !$param->variadic);
    if (!$requiredParams) {
        return $docComment;
    }
    return preg_replace_callback('/@return\s+(\S+)/', function($match) {
        $types = explode('|', $match[1]);
        if (array_intersect(['callable', 'mixed'], $types)) {
            return $match[0];
        }
        return '@return callable|' . $match[1];
    }, $docComment);
};

$functionToCurriedCall = function(Function_ $function) use( $factory, $curriedDocComment) {
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
                new Expr\Variable('args'),
                false,
                true
            )
        ]
    );
    return $factory->function((string) $function->name)
        ->addParam($factory->param('args')->makeVariadic())
        ->addStmt(new Stmt\Return_($curryCall))
        ->setDocComment($curriedDocComment($function));
};


getApiFunctions()
    |> (fn($x) => map($functionToCurriedCall, $x))
    |> (fn($x) => each($node->addStmt(...), $x));

$code = (new PrettyPrinter\Standard)->prettyPrintFile([$node->getNode()]);
file_put_contents(__DIR__ . '/../' . $argv[1], $code);