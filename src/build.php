<?php 

require_once __DIR__ . '/../vendor/autoload.php';
require 'reflection.php';

use PhpParser\{
    BuilderFactory,
    BuilderHelpers,
    Comment,
    Node\Arg,
    Node\Expr,
    Node\Const_,
    Node\Name,
    Node\Stmt,
    Node\Stmt\Function_,
    PrettyPrinter,
};

use Aml\Fpl;

$namespace = 'Aml\Fpl';

$factory = new BuilderFactory;
$node = $factory
    ->namespace($namespace)
    ->setDocComment('/* This file was automatically generated */');

$functionToCurriedCall = function(Function_ $function) use($namespace, $factory) {
    $curryCall = $factory->funcCall(
        $factory->funcCall("\\$namespace\\functions\\curry", ["$namespace\\functions\\$function->name"]),
        [
            new Arg(new Expr\FuncCall(new Name('func_get_args')), false, true)
        ]);
    return $factory->function((string) $function->name)
        ->addStmt(new Stmt\Return_($curryCall))
        ->setDocComment($function->getDocComment() ?: '');
};

$functionToConst = function(Function_ $function) use($namespace) {
    $path = "$namespace\\$function->name";
    $const = new Stmt\Const_([new Const_($function->name, BuilderHelpers::normalizeValue($path))]);
    $const->setDocComment($function->getDocComment() ?: new Comment\Doc(''));
    return $const;
};

$functions = getApiFunctions();
Fpl\each(Fpl\compose([$node, 'addStmt'], $functionToConst), $functions);
Fpl\each(Fpl\compose([$node, 'addStmt'], $functionToCurriedCall), $functions);

$code = (new PrettyPrinter\Standard)->prettyPrintFile([$node->getNode()]);
file_put_contents(__DIR__ . '/../' . $argv[1], $code);