<?php

declare(strict_types=1);

namespace Tests\Technical\Algorithm\BinaryTree;

use Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal as Helper;
use Yoanm\CommonDSA\DataStructure\BinaryTree\Node;

/**
 * @covers \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal
 */
final class TraversalTest extends AbstractTraversalTestCase
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
     * @dataProvider provideTestLevelOrderCases
     */
    public function testBFS(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues(array_merge(...$expected), Helper::BFS($root), $this);
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
    public function testLevelOrderGenerator(Node $root, array $expected): void
    {
        self::assertLevelOrderSameTreeNodeValues($expected, Helper::levelOrderGenerator($root), $this);
    }

    /**
     * @dataProvider provideTestLevelOrderCases
     */
    public function testBFSGenerator(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues(array_merge(...$expected), Helper::BFSGenerator($root), $this);
    }
}
