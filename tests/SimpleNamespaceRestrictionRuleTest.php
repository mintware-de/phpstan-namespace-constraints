<?php

declare(strict_types=1);

namespace MintwareDe\Tests\PhpStanNamespaceConstraints;

use MintwareDe\PhpStanNamespaceConstraints\Rules\NamespaceRestrictionRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<NamespaceRestrictionRule>
 */
class SimpleNamespaceRestrictionRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NamespaceRestrictionRule([
            [
                'from' => 'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\\Simple\\\\Core(\\\\.*)?',
                'to' => [
                    'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\\Simple\\\\Core(\\\\.*)?',
                ],
            ],
            [
                'from' => 'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\\Simple\\\\Data',
                'to' => [
                    'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\\Simple\\\\Core(\\\\.*)?',
                    'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\\Simple\\\\Data(\\\\.*)?',
                ],
            ],
            [
                'from' => 'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\\Simple\\\\UserInterface',
                'to' => [
                    'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\\Simple\\\\Core(\\\\.*)?',
                    'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\\Simple\\\\Data(\\\\.*)?',
                    'MintwareDe\\\\Tests\\\\PhpStanNamespaceConstraints\\\\\Simple\\\\UserInterface(\\\\.*)?',
                ],
            ],
        ]);
    }

    public function testRule(): bool
    {
        $this->analyse([__DIR__.'/Simple/Core/ValidUsings.php'], []);
        $this->analyse([__DIR__.'/Simple/Core/InvalidUsings.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Data\DataDependency are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core',
                7,
            ],
        ]);
        $this->analyse([__DIR__.'/Simple/Core/Nested/ValidUsings.php'], []);
        $this->analyse([__DIR__.'/Simple/Core/Nested/InvalidUsings.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Data\DataDependency are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core\Nested',
                7,
            ],
        ]);
        $this->analyse([__DIR__.'/Simple/Core/InvalidUsings2.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Data\DataDependency are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core',
                7,
            ],
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\UserInterface\UserInterfaceDependency are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Core',
                8,
            ],
        ]);

        $this->analyse([__DIR__.'/Simple/Data/ValidUsings.php'], []);
        $this->analyse([__DIR__.'/Simple/Data/InvalidUsings.php'], [
            [
                'Usings to MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\UserInterface\UserInterfaceDependency are forbidden from MintwareDe\Tests\PhpStanNamespaceConstraints\Simple\Data',
                8,
            ],
        ]);

        $this->analyse([__DIR__.'/Simple/UserInterface/ValidUsings.php'], []);
        return true;
    }
}
