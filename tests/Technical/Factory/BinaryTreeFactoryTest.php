<?php

declare(strict_types=1);

namespace Tests\Technical\Factory;

use PHPUnit\Framework\TestCase;
use Tests\Technical\Algorithm\TraversalTestTrait;
use Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal as Helper;
use Yoanm\CommonDSA\DataStructure\BinaryTree\Node;
use Yoanm\CommonDSA\Factory\BinaryTreeFactory as Factory;

/**
 * @covers \Yoanm\CommonDSA\Factory\BinaryTreeFactory
 */
final class BinaryTreeFactoryTest extends TestCase
{
    use TraversalTestTrait;

    /**
     * @dataProvider provideFromLevelOrderListTestCases
     */
    public function testFromLevelOrderList(array $data, array $expected): void
    {
        $root = Factory::fromLevelOrderList($data, static fn(int $val) => new Node($val));

        self::assertNotNull($root);
        self::assertInstanceOf(Node::class, $root);
        self::assertLevelOrderSameTreeNodeValues($expected, Helper::levelOrder($root), $this);
    }

    /**
     * @dataProvider provideFromLevelOrderListWithEmptyListTestCases
     */
    public function testFromLevelOrderListWithEmptyList(array $data): void
    {
        $root = Factory::fromLevelOrderList($data, static fn(int $val) => new Node($val));

        self::assertNull($root);
    }

    public function provideFromLevelOrderListWithEmptyListTestCases(): array
    {
        return [
            'Basic case 1' => [
                'data' => [],
            ],
            'Basic case 2' => [
                'data' => [null],
            ],
        ];
    }

    public function provideFromLevelOrderListTestCases(): array
    {
        return [
            'Basic case 1' => [
                'data' => [1,2,3,4,5,null,6,null,null,7,8,9],
                'expected' => [[1],[2,3],[4,5,6],[7,8,9]],
            ],
            'Basic case 2' => [
                'data' => [1,2,3,4,5,6,7,8,9,null,null,null,10,11,12],
                'expected' => [[1],[2,3],[4,5,6,7],[8,9,10,11,12]],
            ],
            'Basic case 3' => [
                'data' => [1,2,3,4,5,6,7,8,9,null,null,null,10,11,12,null,null,13,null,null,null,14,null,null,15,16,null,null,null,17],
                'expected' => [[1],[2,3],[4,5,6,7],[8,9,10,11,12],[13,14,15],[16,17]],
            ],
        ];
    }
}
