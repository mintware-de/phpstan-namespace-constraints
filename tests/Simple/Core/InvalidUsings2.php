<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Data\DataDependency;
use MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\UserInterface\UserInterfaceDependency;

class InvalidUsings2
{
    public function __construct(DataDependency $dataDependency, UserInterfaceDependency $userInterfaceDependency)
    {
        var_dump($dataDependency);
        var_dump($userInterfaceDependency);
    }
}
