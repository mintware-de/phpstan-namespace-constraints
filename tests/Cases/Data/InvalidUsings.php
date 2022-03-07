<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Data;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Core\CoreDependency;
use MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\UserInterface\UserInterfaceDependency;

class InvalidUsings
{
    public function __construct(
        CoreDependency $coreDependency,
        DataDependency $dataDependency,
        UserInterfaceDependency $userInterfaceDependency
    ) {
        var_dump($coreDependency);
        var_dump($dataDependency);
        var_dump($userInterfaceDependency);
    }
}
