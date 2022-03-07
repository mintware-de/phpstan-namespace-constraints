<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints;

use MintwareDe\PhpStanNamespaceConstraints\Rules\NamespaceRestrictionRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<NamespaceRestrictionRule>
 */
class AdvancedNamespaceRestrictionRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NamespaceRestrictionRule([
            [
                'from' => 'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\Advanced\\\\User\\\\Core(\\\\.*)?',
                'to' => [
                    'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\Advanced\\\\User\\\\Core(\\\\.*)?',
                ],
            ],
            [
                'from' => 'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\Advanced\\\\Blog\\\\Core(\\\\.*)?',
                'to' => [
                    'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\Advanced\\\\Blog\\\\Core(\\\\.*)?',
                ],
            ],
            [
                'from' => 'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\Advanced\\\\(\w+)\\\\Core(\\\\.*)?',
                'to' => [
                    'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\Advanced\\\\Shared\\\\Core(\\\\.*)?',
                ],
            ],
        ]);
    }

    public function testRule(): bool
    {
        $this->analyse([__DIR__.'/Advanced/User/Core/UserService.php'], []);
        $this->analyse([__DIR__.'/Advanced/Blog/Core/BlogService.php'], []);
        $this->analyse([__DIR__.'/Advanced/Blog/Core/InvalidBlogService.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\User\Core\UserService are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Blog\Core',
                7,
            ],
        ]);
        $this->analyse([__DIR__.'/Advanced/User/Core/InvalidUserService.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Blog\Core\BlogService are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\User\Core',
                7,
            ],
        ]);
        $this->analyse([__DIR__.'/Advanced/Shared/Core/InvalidService.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Blog\Core\BlogService are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Shared\Core',
                7,
            ],
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\User\Core\UserService are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Advanced\Shared\Core',
                8,
            ],
        ]);

        return true;
    }
}
