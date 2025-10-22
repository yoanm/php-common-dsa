<?php

declare(strict_types=1);

namespace Tests\Technical\Algorithm\BinaryTree;

use Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveTraversal as Helper;
use Yoanm\CommonDSA\DataStructure\BinaryTree\Node;

/**
 * @covers \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveTraversal
 */
final class RecursiveTraversalTest extends AbstractTraversalTestCase
{
    /**
     * @dataProvider providePreOrderTestCases
     */
    public function testPreOrder(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::preOrder($root), $this);
    }

    /**
     * @dataProvider provideInOrderTestCases
     */
    public function testInOrder(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::inOrder($root), $this);
    }

    /**
     * @dataProvider providePostorderTestCases
     */
    public function testPostOrder(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::postOrder($root), $this);
    }

    /**
     * @dataProvider provideTestLevelOrderCases
     */
    public function testLevelOrder(Node $root, array $expected): void
    {
        self::assertLevelOrderSameTreeNodeValues($expected, Helper::levelOrder($root), $this);
    }

    /**
     * @dataProvider providePreOrderTestCases
     */
    public function testPreOrderGenerator(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::preOrderGenerator($root), $this);
    }

    /**
     * @dataProvider provideInOrderTestCases
     */
    public function testInOrderGenerator(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::inOrderGenerator($root), $this);
    }

    /**
     * @dataProvider providePostorderTestCases
     */
    public function testPostOrderGenerator(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::postOrderGenerator($root), $this);
    }

    /**
     * @dataProvider provideTestLevelOrderCases
     */
    public function testLevelOrderHelper(Node $root, array $expected): void
    {
        $res = [];

        Helper::levelOrderHelper($root, $res);

        self::assertLevelOrderSameTreeNodeValues($expected, $res, $this);
    }
}
