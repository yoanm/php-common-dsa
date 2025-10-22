<?php

declare(strict_types=1);

namespace Tests\Technical\Factory;

use PHPUnit\Framework\TestCase;
use Tests\Technical\Algorithm\TraversalTestTrait;
use Yoanm\CommonDSA\Algorithm\NAryTree\Traversal as Helper;
use Yoanm\CommonDSA\DataStructure\NAryTree\Node;
use Yoanm\CommonDSA\Factory\NAryTreeFactory as Factory;

/**
 * @covers \Yoanm\CommonDSA\Factory\NAryTreeFactory
 */
final class NAryTreeFactoryTest extends TestCase
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

    public function provideFromLevelOrderListTestCases(): array
    {
        return [
            'Basic case 1' => [
                'data' => [1,null,3,2,4,null,5,6],
                'expected' => [[1],[3,2,4],[5,6]],
            ],
            'Basic case 2' => [
                'data' => [1,null,2,3,4,5,null,null,6,7,null,8,null,9,10,null,null,11,null,12,null,13,null,null,14],
                'expected' => [[1],[2,3,4,5],[6,7,8,9,10],[11,12,13],[14]],
            ],
        ];
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
}
