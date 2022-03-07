<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Blog\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\User\Core\UserService;

class InvalidBlogService
{
    public function __construct(UserService $userService)
    {
        $userService->getUser();
    }
}
