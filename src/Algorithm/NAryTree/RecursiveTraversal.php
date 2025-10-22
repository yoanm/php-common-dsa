<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Algorithm\NAryTree;

use Generator;
use Yoanm\CommonDSA\DataStructure\NAryTree\NodeInterface as Node;

/**
 * N-ary tree traversal relying on recursive functions.<br>
 * ⚠ Recursive function implies a growing stack trace, which has a limited size!<br>
 * See {@see \Yoanm\CommonDSA\Algorithm\NAryTree\Traversal} for iterative implementations.
 *
 *
 * @see \Yoanm\CommonDSA\Algorithm\NAryTree\Traversal for iterative implementations.
 */
class RecursiveTraversal
{
    /**
     * @see \Yoanm\CommonDSA\Algorithm\NAryTree\RecursiveTraversal::preOrderGenerator()
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
     * @see \Yoanm\CommonDSA\Algorithm\NAryTree\RecursiveTraversal::postOrderGenerator()
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
         * @phpstan-var list<list<Node>> $res
         */
        return $res;
    }

    /**
     * Pre-order: N->Children => Node, then its children (from left to right)
     *
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝘩 the tree height, usually ㏒(𝑛) (=balanced tree).<br>
     *   ⚠ 𝘩 = 𝑛 if every node has only one child (skewed tree)
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

        foreach ($node->children as $childNode) {
            yield from self::preOrderGenerator($childNode);
        }
    }

    /**
     * Post-order: Children->N => Node **children** (from left to right), then Node
     *
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝘩 the tree height, usually ㏒(𝑛) (=balanced tree).<br>
     *   ⚠ 𝘩 = 𝑛 if every node has only one child (skewed tree)
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
        foreach ($node->children as $childNode) {
            yield from self::postOrderGenerator($childNode);
        }

        yield $node;
    }

    /**
     * Recursive BFS requires to perform a full traversal while keeping the level in memory !
     *
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
     * SC: 𝑂⟮𝘩⟯ - Due to the stack trace (recursive calls)
     *
     *
     * @param array<int, array<Node>> $res key is the level, value is the list of nodes for that level
     * @phpstan-param array<int, list<Node>> $res
     */
    public static function levelOrderHelper(Node $node, array &$res, int $level = 0): void
    {
        $res[$level] ??= []; // In case current level hasn't been seen/managed yet

        $res[$level][] = $node;
        foreach ($node->children as $childNode) {
            self::levelOrderHelper($childNode, $res, $level + 1);
        }
    }
}
