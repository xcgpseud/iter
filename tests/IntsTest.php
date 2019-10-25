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
            'average' => [
                'run' => function (array $in, float $ex): void {
                    $this->assertEquals($ex, Ints::with($in)->average());
                },
                'cases' => [
                    [
                        'in' => [],
                        'ex' => 0,
                    ], [
                        'in' => [1, 2, 3, 4, 5],
                        'ex' => 3,
                    ], [
                        'in' => [4, 5],
                        'ex' => 4.5,
                    ],
                ],
            ],
            'break_' => [
                'run' => function (array $in, array $exBefore, array $exAfter, ?callable $fn) {
                    [$before, $after] = Ints::with($in)->break_($fn);
                    $this->assertEquals($exBefore, $before->get());
                    $this->assertEquals($exAfter, $after->get());
                },
                'cases' => [
                    [
                        'in' => [1, 2, 3, 4, 5],
                        'exBefore' => [],
                        'exAfter' => [1, 2, 3, 4, 5],
                        'fn' => function (int $v) { return $v < 10; },
                    ], [
                        'in' => [1, 2, 3, 4, 5],
                        'exBefore' => [1, 2, 3, 4, 5],
                        'exAfter' => [],
                        'fn' => function (int $v) { return $v > 10; },
                    ], [
                        'in' => [1, 2, 3, 4, 5],
                        'exBefore' => [1, 2],
                        'exAfter' => [3, 4, 5],
                        'fn' => function (int $v) { return $v > 2; },
                    ],
                ],
            ],
            'map' => [
                'run' => function (array $in, array $ex, ?callable $fn) {
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

    public function testAverage(): void { $this->runCases($this->getCases()['average']); }

    public function testBreak_(): void { $this->runCases($this->getCases()['break_']); }

    public function testMap(): void { $this->runCases($this->getCases()['map']); }
}