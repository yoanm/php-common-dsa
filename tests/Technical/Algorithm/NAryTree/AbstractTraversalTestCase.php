<?php

declare(strict_types=1);

namespace Tests\Technical\Algorithm\NAryTree;

use PHPUnit\Framework\TestCase;
use Tests\Technical\Algorithm\TraversalTestTrait;
use Yoanm\CommonDSA\DataStructure\NAryTree\Node;
use Yoanm\CommonDSA\Factory\NAryTreeFactory as TreeFactory;

/**
 * @TODO Add left skewed tree case
 * @TODO Add right skewed tree case
 * @TODO Add zigzag skewed tree case
 * @TODO Add worse case scenarios (depending of traversal type / TC / SC)
 *
 * @phpstan-type TCaseData array{"treeData": array, "expected": mixed}
 */
abstract class AbstractTraversalTestCase extends TestCase
{
    use TraversalTestTrait;

    public static function provideTestPreorderCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [1,null,2,5,6,null,3,4],
                'expected' => [1,2,3,4,5,6],
            ],
            'Basic case 2' => [
                'treeData' => [1,null,2,3,8,11,null,null,4,5,null,9,null,12,14,null,null,6,null,10,null,13,null,null,7],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    public static function provideTestPostorderCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [6,null,3,4,5,null,1,2],
                'expected' => [1,2,3,4,5,6],
            ],
            'Basic case 2' => [
                'treeData' => [14,null,1,6,9,13,null,null,2,5,null,8,null,11,12,null,null,4,null,7,null,10,null,null,3],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    public static function provideTestLevelOrderCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [1,null,3,2,4,null,5,6],
                'expected' => [[1],[3,2,4],[5,6]],
            ],
            'Basic case 2' => [
                'treeData' => [1,null,2,3,4,5,null,null,6,7,null,8,null,9,10,null,null,11,null,12,null,13,null,null,14],
                'expected' => [[1],[2,3,4,5],[6,7,8,9,10],[11,12,13],[14]],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    /**
     * @phpstan-param array<string, TCaseData> $caseDataList
     */
    protected static function mapTestCases(array $caseDataList): array
    {
        return array_map(
            static fn ($caseData) => [
                TreeFactory::fromLevelOrderList($caseData['treeData'], static fn(int $val) => new Node($val)),
                $caseData['expected'],
            ],
            $caseDataList,
        );
    }
}
