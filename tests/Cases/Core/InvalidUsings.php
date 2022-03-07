<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Data\DataDependency;

class InvalidUsings
{
    public function __construct(DataDependency $coreDependency)
    {
        var_dump($coreDependency);
    }
}
