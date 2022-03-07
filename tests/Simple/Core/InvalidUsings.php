<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Data\DataDependency;

class InvalidUsings
{
    public function __construct(DataDependency $coreDependency)
    {
        var_dump($coreDependency);
    }
}
