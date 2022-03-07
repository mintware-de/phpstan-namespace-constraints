<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Shared\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Blog\Core\BlogService;
use MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\User\Core\UserService;

class InvalidService
{
    public function __construct(BlogService $blogService, UserService $userService)
    {
        $blogService->getEntry();
        $userService->getUser();
    }
}
