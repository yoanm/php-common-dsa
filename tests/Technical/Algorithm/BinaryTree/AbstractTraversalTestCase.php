<?php

declare(strict_types=1);

namespace Tests\Technical\Algorithm\BinaryTree;

use PHPUnit\Framework\TestCase;
use Tests\Technical\Algorithm\TraversalTestTrait;
use Yoanm\CommonDSA\DataStructure\BinaryTree\Node;
use Yoanm\CommonDSA\Factory\BinaryTreeFactory as TreeFactory;

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

    public static function providePreOrderTestCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [1,2,7,3,4,null,8,null,null,5,6,9],
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Basic case 2' => [
                'treeData' => [1,2,7,3,6,8,10,4,5,null,null,null,9,11,12],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
            'Skewed tree - only left' => [
                'treeData' => [1,2,null,3,null,4,null,5,null,6,null,7,null,8,null,9,null,10,null,11,null,12],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
            'Skewed tree - only right' => [
                'treeData' => [1,null,2,null,3,null,4,null,5,null,6,null,7,null,8,null,9,null,10,null,11,null,12],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
            'Zigzag tree' => [
                'treeData' => [1,2,null,null,3,4,null,null,5,6,null,null,7,8,null,null,9,10,null,null,11,12],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
            'Double zigzag tree' => [
                'treeData' => [1,2,8,null,3,9,null,4,null,null,10,null,5,11,null,6,null,null,12,null,7,13],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12,13],
            ],
            'Asymmetric tree - deep left nesting' => [
                'treeData' => [1,2,6,3,null,null,7,4,null,null,null,5],
                'expected' => [1,2,3,4,5,6,7],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    public static function provideReversedPreOrderTestCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [1,5,2,9,6,null,3,null,null,8,7,4],
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Basic case 2' => [
                'treeData' => [1,8,2,10,9,6,3,12,11,null,null,null,7,5,4],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    public static function provideInOrderTestCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [6,2,7,1,4,null,9,null,null,3,5,8],
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Basic case 2' => [
                'treeData' => [6,4,9,2,5,7,11,1,3,null,null,null,8,10,12],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    public static function provideReversedInOrderTestCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [4,8,3,9,6,null,1,null,null,7,5,2],
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Basic case 2' => [
                'treeData' => [7,9,4,11,8,6,2,12,10,null,null,null,5,3,1],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    public static function providePostorderTestCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [9,5,8,1,4,null,7,null,null,2,3,6],
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Basic case 2' => [
                'treeData' => [12,5,11,3,4,7,10,1,2,null,null,null,6,8,9],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    public static function provideReversedPostorderTestCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [9,8,3,7,6,null,2,null,null,5,4,1],
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Basic case 2' => [
                'treeData' => [12,11,6,10,7,5,3,9,8,null,null,null,4,2,1],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    public static function provideTestReversedBFSCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [1,3,2,6,5,null,4,null,null,9,8,7],
                'expected' => [1,2,3,4,5,6,7,8,9],
            ],
            'Basic case 2' => [
                'treeData' => [1,3,2,7,6,5,4,12,11,null,null,null,10,9,8],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ],
            'Basic case 3' => [
                'treeData' => [1,3,2,7,6,5,4,12,11,null,null,null,10,9,8,null,null,15,null,null,null,14,null,null,13,17,null,null,null,16],
                'expected' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    public static function provideTestLevelOrderCases(): array
    {
        $caseDataList = [
            'Basic case 1' => [
                'treeData' => [1,2,3,4,5,null,6,null,null,7,8,9],
                'expected' => [[1],[2,3],[4,5,6],[7,8,9]],
            ],
            'Basic case 2' => [
                'treeData' => [1,2,3,4,5,6,7,8,9,null,null,null,10,11,12],
                'expected' => [[1],[2,3],[4,5,6,7],[8,9,10,11,12]],
            ],
            'Basic case 3' => [
                'treeData' => [1,2,3,4,5,6,7,8,9,null,null,null,10,11,12,null,null,13,null,null,null,14,null,null,15,16,null,null,null,17],
                'expected' => [[1],[2,3],[4,5,6,7],[8,9,10,11,12],[13,14,15],[16,17]],
            ],
        ];

        return self::mapTestCases($caseDataList);
    }

    /**
     * @param array<string, TCaseData> $caseDataList
     *
     * @return array
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
