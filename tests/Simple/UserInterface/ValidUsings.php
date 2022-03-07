<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\UserInterface;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core\CoreDependency;
use MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Data\DataDependency;

class ValidUsings
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
