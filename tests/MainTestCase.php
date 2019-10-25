<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class MainTestCase extends TestCase
{
    public function runCases(array $caseData)
    {
        foreach ($caseData['cases'] as $key => $case) {
            echo "Running test: $key\n";
            call_user_func_array($caseData['run'], $case);
        }
    }
}