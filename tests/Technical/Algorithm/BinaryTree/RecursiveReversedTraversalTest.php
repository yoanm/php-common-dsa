<?php

declare(strict_types=1);

namespace Tests\Technical\Algorithm\BinaryTree;

use Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveReversedTraversal as Helper;
use Yoanm\CommonDSA\DataStructure\BinaryTree\Node;

/**
 * @covers \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveReversedTraversal
 */
final class RecursiveReversedTraversalTest extends AbstractTraversalTestCase
{
    /**
     * @dataProvider provideReversedPreOrderTestCases
     */
    public function testPreOrder(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::preOrder($root), $this);
    }

    /**
     * @dataProvider provideReversedInOrderTestCases
     */
    public function testInOrder(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::inOrder($root), $this);
    }

    /**
     * @dataProvider provideReversedPostorderTestCases
     */
    public function testPostOrder(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::postOrder($root), $this);
    }

    /**
     * @dataProvider provideReversedPreOrderTestCases
     */
    public function testPreOrderGenerator(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::preOrderGenerator($root), $this);
    }

    /**
     * @dataProvider provideReversedInOrderTestCases
     */
    public function testInOrderGenerator(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::inOrderGenerator($root), $this);
    }

    /**
     * @dataProvider provideReversedPostorderTestCases
     */
    public function testPostOrderGenerator(Node $root, array $expected): void
    {
        self::assertSameTreeNodeValues($expected, Helper::postOrderGenerator($root), $this);
    }
}
