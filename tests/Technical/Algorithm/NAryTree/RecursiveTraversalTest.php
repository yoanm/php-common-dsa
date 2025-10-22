<?php

declare(strict_types=1);

namespace Tests\Technical\Algorithm\NAryTree;

use Yoanm\CommonDSA\Algorithm\NAryTree\RecursiveTraversal as Helper;
use Yoanm\CommonDSA\DataStructure\NAryTree\Node;

/**
 * @covers \Yoanm\CommonDSA\Algorithm\NAryTree\RecursiveTraversal
 */
final class RecursiveTraversalTest extends AbstractTraversalTestCase
{
    /**
     * @dataProvider provideTestPreorderCases
     */
    public function testPreOrder(Node $node, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::preOrder($node), $this);
    }

    /**
     * @dataProvider provideTestPostorderCases
     */
    public function testPostOrder(Node $node, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::postOrder($node), $this);
    }

    /**
     * @dataProvider provideTestLevelOrderCases
     */
    public function testLevelOrder(Node $node, array $expected): void
    {
        self::assertLevelOrderSameTreeNodeValues($expected, Helper::levelOrder($node), $this);
    }

    /**
     * @dataProvider provideTestPreorderCases
     */
    public function testPreOrderGenerator(Node $node, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::preOrderGenerator($node), $this);
    }

    /**
     * @dataProvider provideTestPostorderCases
     */
    public function testPostOrderGenerator(Node $node, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::postOrderGenerator($node), $this);
    }

    /**
     * @dataProvider provideTestLevelOrderCases
     */
    public function testLevelOrderHelper(Node $node, array $expected): void
    {
        $res = [];

        Helper::levelOrderHelper($node, $res);

        self::assertLevelOrderSameTreeNodeValues($expected, $res, $this);
    }
}
