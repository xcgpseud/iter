<?php

namespace Tests;

use Iter\Types\Ints;

class IntsTest extends MainTestCase
{
    private function getCases(): array
    {
        return [
            'abs' => [
                'run' => function (array $in, array $ex): void {
                    $this->assertEquals($ex, Ints::with($in)->abs()->get());
                },
                'cases' => [
                    [
                        'in' => [1, 2, -3, -4, 5],
                        'ex' => [1, 2, 3, 4, 5],
                    ],
                ],
            ],
            'all' => [
                'run' => function (array $in, bool $ex, callable $fn): void {
                    $this->assertEquals($ex, Ints::with($in)->all($fn));
                },
                'cases' => [
                    [
                        'in' => [],
                        'ex' => false,
                        'fn' => function (int $v): bool { return $v % 2 == 0; },
                    ], [
                        'in' => [1, 2, 3, 4, 5],
                        'ex' => false,
                        'fn' => function (int $v): bool { return $v % 2 == 0; },
                    ], [
                        'in' => [2, 4, 6, 8, 10],
                        'ex' => true,
                        'fn' => function (int $v): bool { return $v % 2 == 0; },
                    ],
                ],
            ],
            'any' => [
                'run' => function (array $in, bool $ex, callable $fn): void {
                    $this->assertEquals($ex, Ints::with($in)->any($fn));
                },
                'cases' => [
                    [
                        'in' => [],
                        'ex' => false,
                        'fn' => function (int $v): bool { return $v % 2 == 0; },
                    ], [
                        'in' => [1, 3, 5, 7, 9],
                        'ex' => false,
                        'fn' => function (int $v): bool { return $v % 2 == 0; },
                    ], [
                        'in' => [1, 3, 5, 6, 7],
                        'ex' => true,
                        'fn' => function (int $v): bool { return $v % 2 == 0; },
                    ],
                ],
            ],
            'map' => [
                'run' => function (array $in, array $ex, callable $fn) {
                    $this->assertEquals($ex, Ints::with($in)->map($fn)->get());
                },
                'cases' => [
                    [
                        'in' => [1, 2, 3, 4, 5],
                        'ex' => [2, 4, 6, 8, 10],
                        'fn' => function (int $v): int { return $v * 2; },
                    ], [
                        'in' => [1, 2, 3, 4, 5],
                        'ex' => [1, 2, 3, 4, 5],
                        'fn' => null,
                    ],
                ],
            ],
        ];
    }

    public function testAbs(): void { $this->runCases($this->getCases()['abs']); }

    public function testAll(): void { $this->runCases($this->getCases()['all']); }

    public function testAny(): void { $this->runCases($this->getCases()['any']); }

    public function testMap(): void { $this->runCases($this->getCases()['map']); }
}