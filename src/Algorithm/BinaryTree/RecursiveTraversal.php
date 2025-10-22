<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Algorithm\BinaryTree;

use Generator;
use Yoanm\CommonDSA\DataStructure\BinaryTree\NodeInterface as Node;

/**
 * Binary tree traversal relying on recursive functions.<br>
 * ⚠ Recursive function implies a growing stack trace, which has a limited size!<br>
 * See {@see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal} for iterative implementations.
 *
 *
 * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal for iterative implementations.
 */
class RecursiveTraversal
{
    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveTraversal::preOrderGenerator()
     *
     *
     * @return array<Node>
     * @phpstan-return list<Node>
     */
    public static function preOrder(Node $node): array
    {
        // ⚠ Do not preserve keys otherwise there is conflicting keys in case "yield from" is used !
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::preOrderGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveTraversal::preOrderGenerator()
     *
     *
     * @return array<Node>
     * @phpstan-return list<Node>
     */
    public static function inOrder(Node $node): array
    {
        // ⚠ Do not preserve keys otherwise there is conflicting keys in case "yield from" is used !
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::inOrderGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveTraversal::inOrderGenerator()
     *
     *
     * @return array<Node>
     * @phpstan-return list<Node>
     */
    public static function postOrder(Node $node): array
    {
        // ⚠ Do not preserve keys otherwise there is conflicting keys in case "yield from" is used !
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::postOrderGenerator($node), false);
    }

    /**
     * Level order (=BFS): Traverse tree level by level, from Left to Right
     *
     *
     * <br>
     * 💡 Reverse the list for reversed level-order traversal !
     * <br>
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝑛⟯ - Due to the list storing every node for every level (see levelOrderHelper() function).
     *
     *
     * @return array<int, array<Node>> key is the level, value is the list of nodes for that level
     * @phpstan-return list<list<Node>>
     */
    public static function levelOrder(Node $node): array
    {
        $res = [];

        self::levelOrderHelper($node, $res);

        /**
         * No easy way to tell PHPStan that $res is a list in case level is not provided :/
         * @var list<list<Node>> $res
         */
        return $res;
    }

    /**
     * Pre-order: N->L->R => Node, then Left children, then Right children
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝘩 the tree height, usually ㏒(𝑛) (=balanced tree).<br>
     *   ⚠ 𝘩 = 𝑛 if every node has only a left child (skewed tree)
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝘩⟯ - Due to the stack trace (recursive calls) + extra space for inner Generator class instances !
     *
     *
     * @return Generator<Node>
     */
    public static function preOrderGenerator(Node $node): Generator
    {
        yield $node;

        if (null !== $node->left) {
            yield from self::preOrderGenerator($node->left);
        }
        if (null !== $node->right) {
            yield from self::preOrderGenerator($node->right);
        }
    }

    /**
     * In-order (=DFS): L->N->R => Left children, then Node, then Right children
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝘩 the tree height, usually ㏒(𝑛) (=balanced tree).<br>
     *   ⚠ 𝘩 = 𝑛 if every node has only a left child (skewed tree)
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝘩⟯ - Due to the stack trace (recursive calls) + extra space for inner Generator class instances !
     *
     *
     * @return Generator<Node>
     */
    public static function inOrderGenerator(Node $node): Generator
    {
        if (null !== $node->left) {
            yield from self::inOrderGenerator($node->left);
        }

        yield $node;

        if (null !== $node->right) {
            yield from self::inOrderGenerator($node->right);
        }
    }

    /**
     * Post-order: L->R->N => Left children, then Right children, then Node
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝘩 the tree height, usually ㏒(𝑛) (=balanced tree).<br>
     *   ⚠ 𝘩 = 𝑛 if every node has only a left child (skewed tree)
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝘩⟯ - Due to the stack trace (recursive calls) + extra space for inner Generator class instances !
     *
     *
     * @return Generator<Node>
     */
    public static function postOrderGenerator(Node $node): Generator
    {
        if (null !== $node->left) {
            yield from self::postOrderGenerator($node->left);
        }
        if (null !== $node->right) {
            yield from self::postOrderGenerator($node->right);
        }
        yield $node;
    }

    /**
     * Level order (=BFS): Traverse tree level by level, from Left to Right
     *
     *
     * <br>
     * 💡 Reverse the list for reversed level-order traversal !
     * <br>
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝘩 the tree height, usually ㏒(𝑛) (=balanced tree).<br>
     *   ⚠ 𝘩 = 𝑛 if every node has only a left child (skewed tree)
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮h⟯ - Due to the stack trace (recursive calls)
     *
     *
     * @param array<int, array<Node>> $res key is the level, value is the list of nodes for that level
     * @phpstan-param array<int, list<Node>> $res
     */
    public static function levelOrderHelper(Node $node, array &$res, int $level = 0): void
    {
        $res[$level] ??= []; // In case current level hasn't been seen/managed yet

        $res[$level][] = $node;
        if (null !== $node->left) {
            self::levelOrderHelper($node->left, $res, $level + 1);
        }
        if (null !== $node->right) {
            self::levelOrderHelper($node->right, $res, $level + 1);
        }
    }
}
