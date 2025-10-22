<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Algorithm\NAryTree;

use Generator;
use SplQueue;
use SplStack;
use Yoanm\CommonDSA\DataStructure\NAryTree\NodeInterface as Node;

/**
 * N-ary tree traversal leveraging iterative functions.
 *
 *
 * @see \Yoanm\CommonDSA\Algorithm\NAryTree\RecursiveTraversal for recursive implementations.
 */
class Traversal
{
    /**
     * @see \Yoanm\CommonDSA\Algorithm\NAryTree\Traversal::preOrderGenerator()
     *
     *
     * @return array<Node>
     * @phpstan-return list<Node>
     */
    public static function preOrder(Node $node): array
    {
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::preOrderGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\NAryTree\Traversal::postOrderGenerator()
     *
     *
     * @return array<Node>
     * @phpstan-return list<Node>
     */
    public static function postOrder(Node $node): array
    {
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::postOrderGenerator($node), false);
    }

    /**
     * @see \Yoanm\CommonDSA\Algorithm\NAryTree\Traversal::levelOrderGenerator()
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
     * @see \Yoanm\CommonDSA\Algorithm\NAryTree\Traversal::BFSGenerator()
     * @see \Yoanm\CommonDSA\Algorithm\NAryTree\Traversal::levelOrder() if node level must be known !
     *
     *
     * @return array<Node>
     * @phpstan-return list<Node>
     */
    public static function BFS(Node $node): array
    {
        // ⚠ Do not preserve keys in order to always return a list !
        return iterator_to_array(self::BFSGenerator($node), false);
    }

    /**
     * Pre-order: N->Children => Node, then its children (from left to right)
     *
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝑛⟯ - Due to the stack storing parent nodes
     *            + worse scenario like when every level first node has a lot of children.<br>
     *            𝑂⟮𝟷⟯ for best scenario where each node has only one child (skewed tree)!
     *
     *            => Worse case example: Tree with 3 levels
     *            - level 1 has 1 node (root node) with 4 children
     *            - level 2 first node has 10 children
     *
     *            ==> 𝑛 = 15 (1 + 4 + 10)
     *
     *            1. before 1st iteration => stack size = 1 (the root node)
     *            2. 1st iteration, first node of level 1 (root node) is removed,
     *               its 4 children added => stack size = (1 - 1) + 4 = 4
     *            3. 2nd iteration, first node of level 2 is removed, its 10 children added
     *               => stack size = (4 - 1) + 10 = 13
     *
     *            ==> stack size = 13 at the beginning of 3rd iteration.
     *            13 is not exactly 𝑛 but Complexity calculation doesn't take into account nodes already removed
     *            which leads to almost 𝑛
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

            // Start from the end of the list as we use a Stack (Last In First Out) !!
            $childNode = end($currentNode->children);
            while (false !== $childNode) {
                $stack->push($childNode);
                $childNode = prev($currentNode->children);
            }
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
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝑛⟯ - Due to the stack storing parent nodes
     *            + worse scenario like when every level first node has a lot of children.<br>
     *            𝑂⟮㏒ 𝑛⟯ for best scenario where each node has only one child (skewed tree) !
     *
     *            => Worse case example: Tree with 3 levels
     *            - level 1 has 1 node (root node) with 4 children
     *            - level 2 first node has 10 children
     *
     *            ==> 𝑛 = 15 (1 + 4 + 10)
     *
     *            1. before 1st iteration => stack size = 1 (the root node)
     *            2. 1st iteration, children from first node of level 1 (root node) are added
     *               -> 4 children added => stack size = 1 + 4 = 5
     *            3. 2nd iteration, children from first node of level 2 are added
     *               -> 10 children added => stack size = 5 + 10 = 15
     *
     *            ==> stack size = 15 at the beginning of 3rd iteration.
     *
     *
     * @return Generator<Node>
     */
    public static function postOrderGenerator(Node $node): Generator
    {
        /** @var SplStack<Node> $stack */
        $stack = new SplStack();
        $stack->push($node);

        /** @var Node|null $lastManagedNode */
        $lastManagedNode = null;
        while (!$stack->isEmpty()) {
            $node = $stack->top();

            $currentNodeChildCount = count($node->children);
            // Process current node only in specific cases:
            if (
                // No children to process (=nothing to process before current node)
                0 === $currentNodeChildCount
                // last managed node is the last child of the current node
                // (=nothing **more** to process before current node)
                || $lastManagedNode === $node->children[$currentNodeChildCount - 1]
            ) {
                yield $node;
                $stack->pop(); // Remove current node from the stack
                $lastManagedNode = $node; // Set current node as the last one managed
            } else { // Otherwise, push current node children and keep current node in the stack
                // Start from the end of the list as we use a Stack (Last In First Out) !!
                $childNode = end($node->children);
                while (false !== $childNode) {
                    $stack->push($childNode);
                    $childNode = prev($node->children);
                }
            }
        }
    }

    /**
     * Level order (=BFS): Traverse tree level by level, from Left to Right
     *
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝑚 the number of nodes for the bigger level.<br>
     *   ⚠ 𝑚 = (𝑛 − 1) if there is only two levels, root + children
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝑚⟯ - Due to the temporary list storing every node for the current level.
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

                foreach ($node->children as $childNode) {
                    $queue->enqueue($childNode);
                }

                --$currentLevelNodeCounter;
            }

            yield $nodeList;
        }
    }

    /**
     * BFS: Traverse tree level by level, from Left to Right
     *
     *
     * <br>
     * ### Time/Space complexity
     * With:
     * - 𝑛 the number of node in the tree
     * - 𝑚 the number of nodes for the bigger level.<br>
     *   ⚠ 𝑚 = (𝑛 − 1) if there is only two levels, root + children
     *
     * TC: 𝑂⟮𝑛⟯ - Each node will be visited only one time
     *
     * SC: 𝑂⟮𝑚⟯ - Due to the queue storing current level parent nodes
     *
     *
     * @see \Yoanm\CommonDSA\Algorithm\NAryTree\Traversal::levelOrderGenerator() if node level must be known !
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

                foreach ($node->children as $childNode) {
                    $queue->enqueue($childNode);
                }

                --$currentLevelNodeCounter;
            }
        }
    }
}
