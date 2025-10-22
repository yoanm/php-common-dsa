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
 *
 *
 * @template TNode of Node The actual Node class
 */
class Traversal
{
    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::preOrderGenerator()
     *
     * @param TNode $node
     *
     * @return array<TNode>
     * @phpstan-return list<TNode>
     */
    public static function preOrder(Node $node): array
    {
        return iterator_to_array(self::preOrderGenerator($node));
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::inOrderGenerator()
     *
     * @param TNode $node
     *
     * @return array<TNode>
     * @phpstan-return list<TNode>
     */
    public static function inOrder(Node $node): array
    {
        return iterator_to_array(self::inOrderGenerator($node));
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::postOrderGenerator()
     *
     * @param TNode $node
     *
     * @return array<TNode>
     * @phpstan-return list<TNode>
     */
    public static function postOrder(Node $node): array
    {
        return iterator_to_array(self::postOrderGenerator($node));
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::BFSGenerator()
     *
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::levelOrder() if node level must be known !
     *
     * @param TNode $node
     *
     * @return array<TNode>
     * @phpstan-return list<TNode>
     */
    public static function BFS(Node $node): array
    {
        return iterator_to_array(self::BFSGenerator($node));
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::levelOrderGenerator()
     *
     *
     * @see \Yoanm\CommonDSA\Algorithm\BinaryTree\Traversal::BFS() if node level isn't useful.
     *
     * @param TNode $node
     *
     * @return array<array<TNode>> key is the level, value is the list of nodes for that level
     * @phpstan-return list<list<TNode>>
     */
    public static function levelOrder(Node $node): array
    {
        return iterator_to_array(self::levelOrderGenerator($node));
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
                $currentNode = $currentNode->left;
            }

            // Current node becomes the leftmost leaf found
            // (or the same current node in case it doesn't have left node!)
            /** @var Node $currentNode */
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
                if (null !== $currentNode->right) {
                    $stack->push($currentNode->right);
                }
                $stack->push($currentNode);
                $currentNode = $currentNode->left;
            }

            /** @var Node $currentNode */
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
     * @param TNode $node
     *
     * @return Generator<int, array<TNode>> key is the level, value is the list of nodes for that level
     * @phpstan-return Generator<int, list<TNode>>
     */
    public static function levelOrderGenerator(Node $node): Generator
    {
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
