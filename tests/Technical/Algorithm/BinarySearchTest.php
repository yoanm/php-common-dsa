<?php

declare(strict_types=1);

namespace Tests\Technical\Algorithm;

use PHPUnit\Framework\TestCase;
use Yoanm\CommonDSA\Algorithm\BinarySearch;

/**
 * @covers \Yoanm\CommonDSA\Algorithm\BinarySearch
 */
final class BinarySearchTest extends TestCase
{
    /**
     * @dataProvider provideTestFindIdxCases
     */
    public function testFindIdx(array $list, int $target, int $expectedIdx): void
    {
        self::assertSame($expectedIdx, BinarySearch::find($list, $target));
    }

    /**
     * @dataProvider provideTestLowerBoundCases
     */
    public function testLowerBound(array $list, int $target, int $expectedIdx): void
    {
        self::assertSame($expectedIdx, BinarySearch::lowerBound($list, $target));
    }

    /**
     * @dataProvider provideTestUpperBoundCases
     */
    public function testUpperBound(array $list, int $target, int $expectedIdx): void
    {
        self::assertSame($expectedIdx, BinarySearch::upperBound($list, $target));
    }

    public static function provideTestFindIdxCases(): array
    {
        $basicList = [ // Includes holes !
            0  => -10,
            1  => -3,
            2  => -2,
            3  => -1,
            4  => 0,
            5  => 4,
            6  => 5,
            7  => 9,
            8  => 10,
            9  => 12,
            10 => 15,
            11 => 16,
            12 => 20
        ];
        $listWithDuplicates = [ // Includes holes !
            0  => -10,
            1  => -3,
            2  => -3,
            3  => -1,
            4  => 0,
            5  => 4,
            6  => 4,
            7  => 6,
            8  => 10,
            9  => 10,
            10 => 15,
            11 => 16,
            12 => 20
        ];

        return [
            'Basic - target exists in the list' => [
                'list' => $basicList,
                'target' => 10,
                'expectedIdx' => 8,
            ],
            'Basic - target does not exist in the list' => [
                'list' => $basicList,
                'target' => 3,
                'expectedIdx' => -1,
            ],
            'Basic - Empty list' => [
                'list' => [],
                'target' => 10,
                'expectedIdx' => -1,
            ],
            'Basic with duplicates - target exists in the list' => [
                'list' => $listWithDuplicates,
                'target' => 10,
                // 8 is also an acceptable answer though ! But due to list content and the algo => 9 will be returned !
                'expectedIdx' => 9,
            ],
            'Basic with duplicates - target does not exist in the list' => [
                'list' => $listWithDuplicates,
                'target' => 3,
                'expectedIdx' => -1,
            ],
        ];
    }

    public static function provideTestLowerBoundCases(): array
    {
        $basicList = [ // Includes holes !
            0  => -10,
            1  => -3,
            2  => -2,
            3  => -1,
            4  => 0,
            5  => 4,
            6  => 5,
            7  => 9,
            8  => 10,
            9  => 12,
            10 => 15,
            11 => 16,
            12 => 20
        ];
        $listWithDuplicates = [ // Includes holes !
            0  => -10,
            1  => -3,
            2  => -3,
            3  => -1,
            4  => 0,
            5  => 4,
            6  => 4,
            7  => 6,
            8  => 10,
            9  => 10,
            10 => 15,
            11 => 16,
            12 => 20
        ];
        $listWithDuplicates2 = [ // Includes holes !
            0 => -10,
            1 => -10,
            2 => -3,
            3 => 0,
            4 => 6,
            5 => 6,
            6 => 20,
            7 => 20
        ];

        return [
            'Basic - target exists in the list' => [
                'list' => $basicList,
                'target' => 10,
                'expectedIdx' => 8, // 8 must be inserted at index 8 (currently = 10) in the sorted list
            ],
            'Basic - target does not exist in the list' => [
                'list' => $basicList,
                'target' => 3,
                'expectedIdx' => 5, // 3 must be inserted at index 5 (currently = 4) in the sorted list
            ],
            'Basic - Empty list' => [
                'list' => [],
                'target' => 10,
                'expectedIdx' => 0, // 10 must be inserted at index 0 (current list being empty) in the sorted list
            ],

            'Head value' => [
                'list' => $basicList,
                'target' => -10,
                'expectedIdx' => 0, // -10 must be inserted as new head value (current head value being -10) in the sorted list
            ],
            'Tail value' => [
                'list' => $basicList,
                'target' => 20,
                'expectedIdx' => 12, // 20 must be inserted at 1index 12 (currently = 20) in the sorted list
            ],

            'Outside the list - lower than head value' => [
                'list' => $basicList,
                'target' => -42,
                'expectedIdx' => 0, // -42 must be inserted as new head value (current head value being -10) in the sorted list
            ],
            'Outside the list - greater than tail value' => [
                'list' => $basicList,
                'target' => 42,
                'expectedIdx' => 13, // 42 must be inserted as new tail value (current tail value being 20) in the sorted list
            ],

            'Basic with duplicates - target exists in the list and has no duplicate' => [
                'list' => $listWithDuplicates,
                'target' => 6,
                'expectedIdx' => 7, // 6 must be inserted at index 7 (currently = 6) in the sorted list
            ],
            'Basic with duplicates - target exists in the list and has duplicates' => [
                'list' => $listWithDuplicates,
                'target' => 10,
                'expectedIdx' => 8, // 10 must be inserted at index 8 (currently = 10) in the sorted list
            ],
            'Basic with duplicates - target does not exist in the list' => [
                'list' => $listWithDuplicates,
                'target' => 1,
                'expectedIdx' => 5, // 1 must be inserted at index 5 (currently = 4) in the sorted list
            ],

            'Head value with duplicates - target has no duplicate' => [
                'list' => $listWithDuplicates,
                'target' => -10,
                'expectedIdx' => 0, // -10 must be inserted as new head value (current head value being already -10) in the sorted list
            ],
            'Head value with duplicates - target has duplicates' => [
                'list' => $listWithDuplicates2,
                'target' => -10,
                'expectedIdx' => 0, // -10 must be inserted as new head value (current head value being already -10) in the sorted list
            ],
            'Tail value with duplicates - target has no duplicate' => [
                'list' => $listWithDuplicates,
                'target' => 20,
                'expectedIdx' => 12, // 20 must be inserted at index 12 (currently = 20) in the sorted list
            ],
            'Tail value with duplicates - target has duplicates' => [
                'list' => $listWithDuplicates2,
                'target' => 20,
                'expectedIdx' => 6, // 20 must be inserted at index 6 (currently = 20) in the sorted list
            ],

            'Outside the list - lower than head value with duplicates' => [
                'list' => $listWithDuplicates,
                'target' => -42,
                'expectedIdx' => 0, // -42 must be inserted as new head value (current head value being -10) in the sorted list
            ],
            'Outside the list - greater than tail value with duplicates' => [
                'list' => $listWithDuplicates,
                'target' => 42,
                'expectedIdx' => 13, // 42 must be inserted as new tail value (current tail value being 20) in the sorted list
            ],

        ];
    }

    public static function provideTestUpperBoundCases(): array
    {
        $basicList = [ // Includes holes !
            0  => -10,
            1  => -3,
            2  => -2,
            3  => -1,
            4  => 0,
            5  => 4,
            6  => 5,
            7  => 9,
            8  => 10,
            9  => 12,
            10 => 15,
            11 => 16,
            12 => 20
        ];
        $listWithDuplicates = [ // Includes holes !
            0  => -10,
            1  => -3,
            2  => -3,
            3  => -1,
            4  => 0,
            5  => 4,
            6  => 4,
            7  => 6,
            8  => 10,
            9  => 10,
            10 => 15,
            11 => 16,
            12 => 20
        ];
        $listWithDuplicates2 = [ // Includes holes !
            0 => -10,
            1 => -10,
            2 => -3,
            3 => 0,
            4 => 6,
            5 => 6,
            6 => 20,
            7 => 20
        ];

        return [
            'Basic - target exists in the list' => [
                'list' => $basicList,
                'target' => 10,
                'expectedIdx' => 9, // 10 must be inserted at index 9 (currently = 12) in the sorted list
            ],
            'Basic - target does not exist in the list' => [
                'list' => $basicList,
                'target' => 3,
                'expectedIdx' => 5, // 3 must be inserted at index 5 (currently = 4) in the sorted list
            ],
            'Basic - Empty list' => [
                'list' => [],
                'target' => 10,
                'expectedIdx' => 0, // 10 must be inserted at index 0 (current list being empty) in the sorted list
            ],

            'Head value' => [
                'list' => $basicList,
                'target' => -10,
                'expectedIdx' => 1, // -10 must be inserted at index 1 (current head value being already -10) in the sorted list
            ],
            'Tail value' => [
                'list' => $basicList,
                'target' => 20,
                'expectedIdx' => 13, // 20 must be inserted as new tail value (current tail value being already 20) in the sorted list
            ],

            'Outside the list - lower than head value' => [
                'list' => $basicList,
                'target' => -42,
                'expectedIdx' => 0, // -42 must be inserted as new head value (current head value being -10) in the sorted list
            ],
            'Outside the list - greater than tail value' => [
                'list' => $basicList,
                'target' => 42,
                'expectedIdx' => 13, // 42 must be inserted as new tail value (current tail value being 20) in the sorted list
            ],

            'Basic with duplicates - target exists in the list and has no duplicate' => [
                'list' => $listWithDuplicates,
                'target' => 6,
                'expectedIdx' => 8, // 6 must be inserted at index 8 (currently = 10) in the sorted list
            ],
            'Basic with duplicates - target exists in the list and has duplicates' => [
                'list' => $listWithDuplicates,
                'target' => 10,
                'expectedIdx' => 10, // 10 must be inserted at index 10 (currently = 15) in the sorted list
            ],
            'Basic with duplicates - target does not exist in the list' => [
                'list' => $listWithDuplicates,
                'target' => 1,
                'expectedIdx' => 5, // 1 must be inserted at index 5 (currently = 4) in the sorted list
            ],

            'Head value with duplicates - target has no duplicate' => [
                'list' => $listWithDuplicates,
                'target' => -10,
                'expectedIdx' => 1, // -10 must be inserted at index 1 (current head value being already -10) in the sorted list
            ],
            'Head value with duplicates - target has duplicates' => [
                'list' => $listWithDuplicates2,
                'target' => -10,
                'expectedIdx' => 2, // -10 must be inserted as new head value (first and second value being already -10) in the sorted list
            ],
            'Tail value with duplicates - target has no duplicate' => [
                'list' => $listWithDuplicates,
                'target' => 20,
                'expectedIdx' => 13, // 20 must be inserted as new tail value (current tail value being already 20) in the sorted list
            ],
            'Tail value with duplicates - target has duplicates' => [
                'list' => $listWithDuplicates2,
                'target' => 20,
                'expectedIdx' => 8, // 20 must be inserted as new tail value (current tail value being already 20) in the sorted list
            ],

            'Outside the list - greater than tail value with duplicates' => [
                'list' => $listWithDuplicates,
                'target' => 42,
                'expectedIdx' => 13, // 42 must be inserted as new tail value (current tail value being 20) in the sorted list
            ],
            'Outside the list - lower than head value with duplicates' => [
                'list' => $listWithDuplicates,
                'target' => -42,
                'expectedIdx' => 0, // -42 must be inserted as new head value (current head value being -10) in the sorted list
            ],
        ];
    }
}
