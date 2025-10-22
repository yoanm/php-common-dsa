<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Factory;

use SplQueue;
use Yoanm\CommonDSA\DataStructure\BinaryTree\NodeInterface as Node;

class BinaryTreeFactory
{
    /**
     * @TODO write example regarding expecting list format !
     *
     * @template TNode of Node The actual Node class
     * @template TValue of mixed The actual Node value type
     *
     *
     * @param mixed[] $list ⚠ Must be a 0 indexed list, 0 to n consecutive indexes
     * @phpstan-param  list<TValue|null> $list
     * @phpstan-param callable(TValue $v): TNode $nodeCreator
     *
     * @phpstan-return ?TNode
     */
    public static function fromLevelOrderList(array $list, callable $nodeCreator): ?Node
    {
        $tailIdx = count($list) - 1;
        if ($tailIdx < 0 || (0 === $tailIdx && null === $list[0])) {
            return null;
        }

        /** @var SplQueue<Node> $queue */
        $queue = new SplQueue();

        $root = call_user_func($nodeCreator, $list[0]); // @phpstan-ignore argument.type
        $queue->enqueue($root);

        $idx = 1; // Root value already managed, hence 1 rather 0 !
        while ($idx <= $tailIdx) {
            $parentNode = $queue->dequeue();

            // 1. Manage left node value
            if (null !== $list[$idx]) {
                $parentNode->left = $node = call_user_func($nodeCreator, $list[$idx]);
                $queue->enqueue($node);
            }
            ++$idx;

            // 1. Manage right node value (if it exists !)
            if ($idx <= $tailIdx && null !== $list[$idx]) {
                $parentNode->right = $node = call_user_func($nodeCreator, $list[$idx]);
                $queue->enqueue($node);
            }
            ++$idx;
        }

        return $root;
    }
}
