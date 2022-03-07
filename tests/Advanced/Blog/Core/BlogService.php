<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Blog\Core;

use MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Shared\Core\Entity\BlogEntry;

class BlogService
{
    public function getEntry(): BlogEntry
    {
        return new BlogEntry();
    }
}
