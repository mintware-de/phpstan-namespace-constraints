<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Data;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core\CoreDependency;
use MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\UserInterface\UserInterfaceDependency;

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
