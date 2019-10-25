<?php

namespace Tests;

use Iter\Types\Ints;
use Iter\Types\Strings;

class StringsTest extends MainTestCase
{

    private function getCases(): array
    {
        return [
            'all' => [
                'run' => function (array $in, bool $ex, callable $fn): void {
                    $this->assertEquals($ex, Strings::with($in)->all($fn));
                },
                'cases' => [
                    [
                        'in' => [],
                        'ex' => false,
                        'fn' => function (string $v): bool { return strlen($v) < 5; },
                    ], [
                        'in' => ["aaa", "bbbb", "ccccc"],
                        'ex' => false,
                        'fn' => function (string $v): bool { return strlen($v) < 4; },
                    ], [
                        'in' => ["aaa", "bbbb", "ccccc"],
                        'ex' => true,
                        'fn' => function (string $v): bool { return strlen($v) < 10; },
                    ],
                ],
            ],
            'any' => [
                'run' => function (array $in, bool $ex, callable $fn): void {
                    $this->assertEquals($ex, Strings::with($in)->any($fn));
                },
                'cases' => [
                    [
                        'in' => [],
                        'ex' => false,
                        'fn' => function (string $v): bool { return strlen($v) < 3; },
                    ], [
                        'in' => ["aaa", "bbbb", "ccccc"],
                        'ex' => false,
                        'fn' => function (string $v): bool { return strlen($v === 2); },
                    ], [
                        'in' => ["aaa", "bbbb", "ccccc"],
                        'ex' => true,
                        'fn' => function (string $v): bool { return strlen($v) === 4; },
                    ],
                ],
            ],
            'break_' => [
                'run' => function (array $in, array $exBefore, array $exAfter, ?callable $fn) {
                    [$before, $after] = Strings::with($in)->break_($fn);
                    $this->assertEquals($exBefore, $before->get());
                    $this->assertEquals($exAfter, $after->get());
                },
                'cases' => [
                    [
                        'in' => ["aaa", "bbbb", "ccccc"],
                        'exBefore' => [],
                        'exAfter' => ["aaa", "bbbb", "ccccc"],
                        'fn' => function (string $v) { return strlen($v) < 10; },
                    ], [
                        'in' => ["aaa", "bbbb", "ccccc"],
                        'exBefore' => ["aaa", "bbbb", "ccccc"],
                        'exAfter' => [],
                        'fn' => function (string $v) { return strlen($v) > 10; },
                    ], [
                        'in' => ["aaa", "bbbb", "ccccc"],
                        'exBefore' => ["aaa", "bbbb"],
                        'exAfter' => ["ccccc"],
                        'fn' => function (string $v) { return strlen($v) > 4; },
                    ],
                ],
            ],
            'delete' => [
                'run' => function (array $in, array $ex, string $del) {
                    $this->assertEquals($ex, Strings::with($in)->delete($del)->get());
                },
                'cases' => [
                    [
                        'in' => [],
                        'ex' => [],
                        'del' => "a",
                    ], [
                        'in' => ["a", "b", "c"],
                        'ex' => ["a", "b", "c"],
                        'del' => "e",
                    ], [
                        'in' => ["a", "b", "c"],
                        'ex' => ["a", "c"],
                        'del' => "b",
                    ], [
                        'in' => ["a", "b", "c", "b", "a"],
                        'ex' => ["a", "c", "b", "a"],
                        'del' => "b",
                    ],
                ],
            ],
            'map' => [
                'run' => function (array $in, array $ex, ?callable $fn) {
                    $this->assertEquals($ex, Strings::with($in)->map($fn)->get());
                },
                'cases' => [
                    [
                        'in' => [],
                        'ex' => [],
                        'fn' => function (string $v): string { return strrev($v); },
                    ], [
                        'in' => ["abc", "bcd", "cde"],
                        'ex' => ["cba", "dcb", "edc"],
                        'fn' => function (string $v): string { return strrev($v); },
                    ], [
                        'in' => ["abc", "bcd", "cde"],
                        'ex' => ["abc", "bcd", "cde"],
                        'fn' => null,
                    ],
                ],
            ],
        ];
    }

    private function runTestCase(string $type): void
    {
        $this->runCases($this->getCases()[$type]);
    }

    public function testAll(): void { $this->runTestCase('all'); }

    public function testAny(): void { $this->runTestCase('any'); }

    public function testBreak_(): void { $this->runTestCase('break_'); }

    public function testDelete(): void { $this->runTestCase('delete'); }

    public function testMap(): void { $this->runTestCase('map'); }
}