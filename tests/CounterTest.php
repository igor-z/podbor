<?php

namespace App\Tests;

use App\Counter;
use App\JsonDataProvider;
use PHPUnit\Framework\TestCase;

class CounterTest extends TestCase
{
    public function testCount(): void
    {
        $counter = new Counter(
            new JsonDataProvider(__DIR__ . '/data/sample.json'),
            ['PHP', 'JavaScript', 'Java', 'Python']
        );

        $this->assertEquals([
            'PHP' => 2,
            'JavaScript' => 1,
            'Java' => 0,
            'Python' => 1,
        ], $counter->count());
    }
}