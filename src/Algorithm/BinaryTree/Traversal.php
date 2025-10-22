<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Algorithm\BinaryTree;

use Generator;
use SplQueue;
use SplStack;
use Yoanm\CommonDSA\DataStructure\BinaryTree\NodeInterface as Node;

/**
 * Binary tree traversal leveraging iterative functions.
 *
 *
 * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\RecursiveTraversal for recursive implementations.
 */
class Traversal
{
    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::preOrderGenerator()
     *

     *
     * @return Node[]
     * @phpstan-return list<Node>
     */
    public static function preOrder(Node $node): array
    {
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::preOrderGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::inOrderGenerator()
     *
     *
     * @return Node[]
     * @phpstan-return list<Node>
     */
    public static function inOrder(Node $node): array
    {
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::inOrderGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::postOrderGenerator()
     *
     *
     * @return Node[]
     * @phpstan-return list<Node>
     */
    public static function postOrder(Node $node): array
    {
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::postOrderGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::BFSGenerator()
     *
     *
     * @return Node[]
     * @phpstan-return list<Node>
     */
    public static function BFS(Node $node): array
    {
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::BFSGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::levelOrderGenerator()
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::BFS() if node level isn't useful.
     *
     *
     * @return array<int, array<Node>> key is the level, value is the list of nodes for that level
     * @phpstan-return list<list<Node>>
     */
    public static function levelOrder(Node $node): array
    {
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::levelOrderGenerator($node), false);
    }

    /**
     * Pre-order: N->L->R => Node, then Left children, then Right children.
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
     * SC: 𝑂⟮𝘩⟯ - Due to the stack storing parent nodes path up to the root node.
     *
     *
     * @return Generator<Node>
     */
    public static function preOrderGenerator(Node $node): Generator
    {
        /** @var SplStack<Node> $stack */
        $stack = new SplStack();

        $stack->push($node);

        while (!$stack->isEmpty()) {
            $currentNode = $stack->pop();

            yield $currentNode;

            if (null !== $currentNode->right) {
                $stack->push($currentNode->right);
            }
            if (null !== $currentNode->left) {
                $stack->push($currentNode->left);
            }
        }
    }

    /**
     * In-order (=DFS): L->N->R => Left children, then Node, then Right children.
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
     * SC: 𝑂⟮𝘩⟯ - Due to the stack storing parent nodes path up to the root node.
     *
     * @return Generator<Node>
     */
    public static function inOrderGenerator(Node $node): Generator
    {
        /** @var SplStack<Node> $stack */
        $stack = new SplStack();

        $currentNode = $node;
        while (null !== $currentNode || !$stack->isEmpty()) {
            while (null !== $currentNode) {
                $stack->push($currentNode);
                $currentNode = $currentNode->left;
            }

            // Current node becomes the leftmost leaf found
            // (or the same current node in case it doesn't have left node!)
            $currentNode = $stack->pop();

            yield $currentNode;

            // Left is now managed, let's take a look on right side
            $currentNode = $currentNode->right;
        }
    }

    /**
     * Post-order: L->R->N => Left children, then Right children, then Node.
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
     * SC: 𝑂⟮𝘩⟯ - Due to the stack storing parent nodes path up to the root node.
     *
     *
     * @return Generator<Node>
     */
    public static function postOrderGenerator(Node $node): Generator
    {
        /** @var SplStack<Node> $stack */
        $stack = new SplStack();

        $currentNode = $node;
        while (null !== $currentNode || !$stack->isEmpty()) {
            while (null !== $currentNode) {
                if (null !== $currentNode->right) {
                    $stack->push($currentNode->right);
                }
                $stack->push($currentNode);
                $currentNode = $currentNode->left;
            }

            $currentNode = $stack->pop();

            if (!$stack->isEmpty() && $currentNode->right === $stack->top()) {
                // Remove current node right child from the stack, it will become $currentNode for next iteration
                $stack->pop();

                $stack->push($currentNode);
                $currentNode = $currentNode->right;
            } else {
                yield $currentNode;

                $currentNode = null;
            }
        }
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
     * - 𝑚 the number of nodes for the bigger level
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝑚⟯ - Due to the queue storing current level parent nodes, plus temporary list storing every node
     * for the current level
     *
     *
     *
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::BFSGenerator() if node level isn't useful.
     *
     *
     * @return Generator<int, array<Node>> key is the level, value is the list of nodes for that level
     * @phpstan-return Generator<int, list<Node>>
     */
    public static function levelOrderGenerator(Node $node): Generator
    {
        /** @var SplQueue<Node> $queue */
        $queue = new SplQueue();

        $queue->enqueue($node);

        while (!$queue->isEmpty()) {
            $nodeList = [];
            $currentLevelNodeCounter = $queue->count();
            while ($currentLevelNodeCounter > 0) {
                $node = $queue->dequeue();

                $nodeList[] = $node;

                if (null !== $node->left) {
                    $queue->enqueue($node->left);
                }
                if (null !== $node->right) {
                    $queue->enqueue($node->right);
                }

                --$currentLevelNodeCounter;
            }

            yield $nodeList;
        }
    }

    /**
     * BFS: Traverse tree level by level, from Left to Right.<br>
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
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::levelOrderGenerator() if node level must be known !
     *
     *
     * @return Generator<Node>
     */
    public static function BFSGenerator(Node $node): Generator
    {
        /** @var SplQueue<Node> $queue */
        $queue = new SplQueue();

        $queue->enqueue($node);
        while (!$queue->isEmpty()) {
            $currentLevelNodeCounter = $queue->count();
            while ($currentLevelNodeCounter > 0) {
                $node = $queue->dequeue();

                yield $node;

                if (null !== $node->left) {
                    $queue->enqueue($node->left);
                }
                if (null !== $node->right) {
                    $queue->enqueue($node->right);
                }

                --$currentLevelNodeCounter;
            }
        }
    }
}
