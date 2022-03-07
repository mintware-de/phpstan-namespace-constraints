<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\User\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Shared\Core\Entity\User;

class UserService
{
    public function getUser(): User
    {
        return new User();
    }
}
