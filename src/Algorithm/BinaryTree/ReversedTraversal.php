<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Algorithm\BinaryTree;

use Generator;
use SplQueue;
use SplStack;
use Yoanm\CommonDSA\DataStructure\BinaryTree\NodeInterface as Node;

/**
 * Reversed binary tree traversal leveraging iterative functions.
 *
 *
 * <br>
 * ℹ Reversed level-order is not implemented as it implies to keep track of and look at each and every node in
 * order to detect the last level => Time and space complexity will be 𝑂⟮𝑛⟯ in any cases !<br>
 * Workaround:<br>
 * 1. Fetch the result of {@see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::levelOrder}
 *    or {@see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::levelOrderGenerator}
 * 2. Either start from the end or reverse the whole list (the latter implies
 *    an additional 𝑂⟮𝑛⟯ time complexity though !)
 *
 *
 * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveReversedTraversal for recursive implementations.
 *
 *
 * @template TNode of Node The actual Node class
 */
class ReversedTraversal
{
    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RevervedTraversal::preOrderGenerator()
     *
     * @param TNode $node
     *
     * @return list<TNode>
     */
    public static function preOrder(Node $node): array
    {
        return iterator_to_array(self::preOrderGenerator($node));
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RevervedTraversal::inOrderGenerator()
     *
     * @param TNode $node
     *
     * @return list<TNode>
     */
    public static function inOrder(Node $node): array
    {
        return iterator_to_array(self::inOrderGenerator($node));
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RevervedTraversal::postOrderGenerator()
     *
     * @param TNode $node
     *
     * @return list<TNode>
     */
    public static function postOrder(Node $node): array
    {
        return iterator_to_array(self::postOrderGenerator($node));
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RevervedTraversal::BFSGenerator()
     *
     * @param TNode $node
     *
     * @return list<TNode>
     */
    public static function BFS(Node $node): array
    {
        return iterator_to_array(self::BFSGenerator($node));
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
     * SC: 𝑂⟮𝘩⟯ - Due to the stack storing parent nodes path up to the root node.
     *
     *
     * @param TNode $node
     *
     * @return Generator<TNode>
     */
    public static function preOrderGenerator(Node $node): Generator
    {
        $stack = new SplStack();

        $stack->push($node);
        while (!$stack->isEmpty()) {
            /** @var Node $currentNode */
            $currentNode = $stack->pop();

            yield $currentNode;

            if (null !== $currentNode->left) {
                $stack->push($currentNode->left);
            }
            if (null !== $currentNode->right) {
                $stack->push($currentNode->right);
            }
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
     * SC: 𝑂⟮𝘩⟯ - Due to the stack storing parent nodes path up to the root node.
     *
     *
     * @param TNode $node
     *
     * @return Generator<Node>
     */
    public static function inOrderGenerator(Node $node): Generator
    {
        $stack = new SplStack();

        $currentNode = $node;
        while (null !== $currentNode || !$stack->isEmpty()) {
            while (null !== $currentNode) {
                $stack->push($currentNode);
                $currentNode = $currentNode->right;
            }

            // Current node becomes the rightmost leaf found
            // (or the same current node in case it doesn't have right node!)
            /** @var Node $currentNode */
            $currentNode = $stack->pop();

            yield $currentNode;

            // Right is now managed, let's take a look on left side
            $currentNode = $currentNode->left;
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
     * SC: 𝑂⟮𝘩⟯ - Due to the stack storing parent nodes.
     *
     *
     * @param TNode $node
     *
     * @return Generator<Node>
     */
    public static function postOrderGenerator(Node $node): Generator
    {
        $stack = new SplStack();

        $currentNode = $node;
        while (null !== $currentNode || !$stack->isEmpty()) {
            while (null !== $currentNode) {
                if (null !== $currentNode->left) {
                    $stack->push($currentNode->left);
                }
                $stack->push($currentNode);
                $currentNode = $currentNode->right;
            }

            /** @var Node $currentNode */
            $currentNode = $stack->pop();

            if (!$stack->isEmpty() && $currentNode->left === $stack->top()) {
                // Remove current node left child from the stack, it will become $currentNode for next iteration
                $stack->pop();

                $stack->push($currentNode);
                $currentNode = $currentNode->left;
            } else {
                yield $currentNode;

                $currentNode = null;
            }
        }
    }

    /**
     * Reversed BFS: Traverse tree level by level, from Right to Left.<br>
     *
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝑚 the number of nodes for the bigger level
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝑚⟯ - Due to the queue storing current level parent nodes
     *
     *
     * @param TNode $node
     *
     * @return Generator<TNode>
     */
    public static function BFSGenerator(Node $node): Generator
    {
        $queue = new SplQueue();

        $queue->enqueue($node);
        while (!$queue->isEmpty()) {
            $currentLevelNodeCounter = $queue->count();
            while ($currentLevelNodeCounter > 0) {
                $node = $queue->dequeue();

                yield $node;

                if (null !== $node->right) {
                    $queue->enqueue($node->right);
                }
                if (null !== $node->left) {
                    $queue->enqueue($node->left);
                }

                --$currentLevelNodeCounter;
            }
        }
    }
}
