<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core;

class ValidUsings
{
    public function __construct(CoreDependency $coreDependency)
    {
        var_dump($coreDependency);
    }
}
