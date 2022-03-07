<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Data;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Core\CoreDependency;

class ValidUsings
{
    public function __construct(CoreDependency $coreDependency, DataDependency $dataDependency)
    {
        var_dump($coreDependency);
        var_dump($dataDependency);
    }
}
