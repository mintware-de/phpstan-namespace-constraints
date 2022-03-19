<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\User\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Shared\Core\Entity\User;
use Throwable;

class UserService
{
    /** @throws Throwable */
    public function getUser(): User
    {
        if (date('d') === '01') {
            throw new \Exception('Foo');
        }
        return new User();
    }
}
