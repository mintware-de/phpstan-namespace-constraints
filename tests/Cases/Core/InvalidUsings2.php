<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Data\DataDependency;
use MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\UserInterface\UserInterfaceDependency;

class InvalidUsings2
{
    public function __construct(DataDependency $dataDependency, UserInterfaceDependency $userInterfaceDependency)
    {
        var_dump($dataDependency);
        var_dump($userInterfaceDependency);
    }
}
