<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints;

use MintwareDe\PhpStanNamespaceConstraints\Rules\NamespaceRestrictionRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<NamespaceRestrictionRule>
 */
class NamespaceRestrictionRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NamespaceRestrictionRule([
            [
                'from' => 'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Core',
                'to' => [
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Core',
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Core\\.*',
                ],
            ],
            [
                'from' => 'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Data',
                'to' => [
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Core',
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Core\\.*',
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Data',
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Data\\.*',
                ],
            ],
            [
                'from' => 'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\UserInterface',
                'to' => [
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Core',
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Core\\.*',
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Data',
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\Data\\.*',
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\UserInterface',
                    'MintwareDe\\Tests\\PhpStanNamespaceConstraints\\Cases\\UserInterface\\.*',
                ],
            ],
        ]);
    }

    public function testRule(): bool
    {
        $this->analyse([__DIR__.'/Cases/Core/ValidUsings.php'], []);
        $this->analyse([__DIR__.'/Cases/Core/InvalidUsings.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Data\DataDependency are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Core',
                6,
            ],
        ]);
        $this->analyse([__DIR__.'/Cases/Core/InvalidUsings2.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Data\DataDependency are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Core',
                6,
            ],
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\UserInterface\UserInterfaceDependency are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Core',
                7,
            ],
        ]);

        $this->analyse([__DIR__.'/Cases/Data/ValidUsings.php'], []);
        $this->analyse([__DIR__.'/Cases/Data/InvalidUsings.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\UserInterface\UserInterfaceDependency are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Cases\Data',
                8,
            ],
        ]);

        $this->analyse([__DIR__.'/Cases/UserInterface/ValidUsings.php'], []);
        return true;
    }
}
