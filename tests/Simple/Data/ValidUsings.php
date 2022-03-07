<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Data;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core\CoreDependency;

class ValidUsings
{
    public function __construct(CoreDependency $coreDependency, DataDependency $dataDependency)
    {
        var_dump($coreDependency);
        var_dump($dataDependency);
    }
}
