<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\User\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Blog\Core\BlogService;

class InvalidUserService
{
    public function __construct(BlogService $blogService)
    {
        $blogService->getEntry();
    }
}
