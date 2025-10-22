<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Algorithm\BinaryTree;

use Generator;
use Yoanm\CommonDSA\DataStructure\BinaryTree\NodeInterface as Node;

/**
 * Reversed binary tree traversal relying on recursive functions.<br>
 * ⚠ Recursive function implies a growing stack trace, which has a limited size!<br>
 * See {@see \Yoanm\CommonDSA\Algorithm\BinaryTree\ReversedTraversal} for iterative implementations.
 *
 *
 * <br>
 * ℹ Reversed level-order is not implemented as it implies to keep track of and look at each and every node in
 * order to detect the last level => Time and space complexity will be 𝑂⟮𝑛⟯ in any cases !<br>
 * Workaround:<br>
 * 1. Fetch the result of {@see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveTraversal::levelOrder}
 *    or {@see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveTraversal::levelOrderGenerator}
 * 2. Either start from the end or reverse the whole list (the latter implies
 *    an additional 𝑂⟮𝑛⟯ time complexity though !)
 *
 *
 * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\ReversedTraversal for iterative implementations.
 *
 *
 * @template TNode of Node The actual Node class
 */
class RecursiveReversedTraversal
{
    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveReversedTraversal::preOrderGenerator()
     *
     * @param TNode $node
     *
     * @return array<TNode>
     * @phpstan-return list<TNode>
     */
    public static function preOrder(Node $node): array
    {
        // ⚠ Do not preserve keys otherwise there is conflicting keys in case "yield from" is used !
        return iterator_to_array(self::preOrderGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveReversedTraversal::preOrderGenerator()
     *
     * @param TNode $node
     *
     * @return array<TNode>
     * @phpstan-return list<TNode>
     */
    public static function inOrder(Node $node): array
    {
        // ⚠ Do not preserve keys otherwise there is conflicting keys in case "yield from" is used !
        return iterator_to_array(self::inOrderGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveReversedTraversal::inOrderGenerator()
     *
     * @param TNode $node
     *
     * @return array<TNode>
     * @phpstan-return list<TNode>
     */
    public static function postOrder(Node $node): array
    {
        // ⚠ Do not preserve keys otherwise there is conflicting keys in case "yield from" is used !
        return iterator_to_array(self::postOrderGenerator($node), false);
    }

    /**
     * Reversed Pre-order: N->R->L => Node, then Right children, then Left children
     *
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝘩 the tree height, usually ㏒(𝑛) (=balanced tree).<br>
     *   ⚠ 𝘩 = 𝑛 if every node has only a right child (skewed tree)
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝘩⟯ - Due to the stack trace (recursive calls) + extra space for inner Generator class instances !
     *
     *
     * @param TNode $node
     *
     * @return Generator<TNode>
     */
    public static function preOrderGenerator(Node $node): Generator
    {
        yield $node;

        if (null !== $node->right) {
            yield from self::preOrderGenerator($node->right);
        }
        if (null !== $node->left) {
            yield from self::preOrderGenerator($node->left);
        }
    }

    /**
     * Reversed In-order (=Reversed DFS): R->N->L => Right children, then Node, then Left children
     *
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝘩 the tree height, usually ㏒(𝑛) (=balanced tree).<br>
     *   ⚠ 𝘩 = 𝑛 if every node has only a right child (skewed tree)
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝘩⟯ - Due to the stack trace (recursive calls) + extra space for inner Generator class instances !
     *
     *
     * @param TNode $node
     *
     * @return Generator<TNode>
     */
    public static function inOrderGenerator(Node $node): Generator
    {
        if (null !== $node->right) {
            yield from self::inOrderGenerator($node->right);
        }

        yield $node;

        if (null !== $node->left) {
            yield from self::inOrderGenerator($node->left);
        }
    }

    /**
     * Reversed Post-order: R->L->N => Right children, then Left children, then Node
     *
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝘩 the tree height, usually ㏒(𝑛) (=balanced tree).<br>
     *   ⚠ 𝘩 = 𝑛 if every node has only a right child (skewed tree)
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝘩⟯ - Due to the stack trace (recursive calls) + extra space for inner Generator class instances !
     *
     *
     * @param TNode $node
     *
     * @return Generator<TNode>
     */
    public static function postOrderGenerator(Node $node): Generator
    {
        if (null !== $node->right) {
            yield from self::postOrderGenerator($node->right);
        }
        if (null !== $node->left) {
            yield from self::postOrderGenerator($node->left);
        }
        yield $node;
    }
}
