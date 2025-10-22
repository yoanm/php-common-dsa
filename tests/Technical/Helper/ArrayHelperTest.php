<?php

declare(strict_types=1);

namespace Tests\Technical\Helper;

use PHPUnit\Framework\TestCase;
use Yoanm\CommonDSA\Helper\ArrayHelper as Helper;

/**
 * @covers \Yoanm\CommonDSA\Helper\ArrayHelper
 */
final class ArrayHelperTest extends TestCase
{
    /**
     * @dataProvider provideFromLevelOrderListTestCases
     */
    public function testInsertAt(array $list, int $index, mixed $value, array $expected): void
    {
        Helper::insertAt($list, $index, $value);

        self::assertSame($expected, $list);
    }

    public function provideFromLevelOrderListTestCases(): array
    {
        return [
            'Insert in the middle of the list' => [
                'list' => [1,2,3,4,5,7,8,9],
                'index' => 5,
                'value' => 6,
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Replace head value' => [
                'list' => [2,3,4,5,6,7,8,9],
                'index' => 0,
                'value' => 1,
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Replace tail value' => [
                'list' => [1,2,3,4,5,6,7,9],
                'index' => 7,
                'value' => 8,
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'As new tail value' => [
                'list' => [1,2,3,4,5,6,7,8],
                'index' => 8,
                'value' => 9,
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Empty list' => [
                'list' => [],
                'index' => 0,
                'value' => 1,
                'expected' => [1],
            ],
        ];
    }
}
