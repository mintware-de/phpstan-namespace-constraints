<?php

declare(strict_types=1);

namespace MintwareDe\PhpStanNamespaceConstraints\Rules;

use PhpParser\Node;
use PhpParser\Node\Stmt\Use_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use ReflectionClass;
use ReflectionFunction;

/**
 * @implements Rule<Use_>
 */
class NamespaceRestrictionRule implements Rule
{
    public const CONSTRAINT_FROM = 'from';
    public const CONSTRAINT_TO = 'to';

    /** @var array<array{'from': string|null, "to": string[]}> $constraints */
    private $constraints;

    /** @var array<string, bool> */
    private $builtInChecks = [];

    /**
     * @param array<array{'from': string|null, "to": string[]}> $constraints
     */
    public function __construct(array $constraints = [])
    {
        $this->constraints = $constraints;
    }

    public function getNodeType(): string
    {
        return Use_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (empty($this->constraints)) {
            return [];
        }

        /** @var array<string, string[]> $constraints */
        $constraints = [];
        foreach ($this->constraints as $constraint) {
            if ($constraint[self::CONSTRAINT_FROM] === null && $scope->getNamespace() !== null) {
                continue;
            }

            if (preg_match('~^'.$constraint[self::CONSTRAINT_FROM].'$~', $scope->getNamespace() ?? '')) {
                if (!isset($constraints[$constraint[self::CONSTRAINT_FROM]])) {
                    $constraints[$constraint[self::CONSTRAINT_FROM]] = [];
                }
                array_push($constraints[$constraint[self::CONSTRAINT_FROM]], ...$constraint[self::CONSTRAINT_TO]);
            }
        }


        if (empty($constraints)) {
            return [];
        }

        /** @var Use_ $useNode */
        $useNode = $node;
        $badUsings = [];
        foreach ($useNode->uses as $use) {
            $name = (string)$use->name;

            $allTargets = [];
            foreach ($constraints as $targets) {
                array_push($allTargets, ...$targets);
            }

            /** @var string[] $values */
            $values = array_values($allTargets);

            $fullPattern = '~^('.implode('|', $values).')$~';

            if (!preg_match($fullPattern, $name)) {
                if (!isset($this->builtInChecks[$name])) {
                    $reflection = null;
                    if (class_exists($name) || interface_exists($name)) {
                        $reflection = new ReflectionClass($name);
                    } elseif (function_exists($name)) {
                        $reflection = new ReflectionFunction($name);
                    }
                    $this->builtInChecks[$name] = $reflection != null && $reflection->getFileName() === false;
                }
                $isBuiltIn = $this->builtInChecks[$name];

                if (!$isBuiltIn) {
                    $badUsings[] = $name;
                }
            }
        }

        if (!empty($badUsings)) {
            return [
                RuleErrorBuilder::message(
                    'Usings to '.implode(
                        ', ',
                        $badUsings
                    ).' are forbidden from '.($scope->getNamespace() ?? $scope->getFile())
                )->build(),
            ];
        }

        return [];
    }
}
