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
     * @template CType of Node Node class
     * @template VType of mixed List value type
     *
     * @phpstan-type CallbackType callable(VType $v): CType
     *
     * @param array<int, VType> $list
     * @param CallbackType $nodeCreator
     *
     * @return null|Node|CType
     */
    public static function fromLevelOrderList(array $list, callable $nodeCreator): null|Node
    {
        $tailIdx = count($list) - 1;
        if ($tailIdx < 0 || (0 === $tailIdx && null === $list[0])) {
            return null;
        }

        $root = call_user_func($nodeCreator, $list[0]);
        $queue = new SplQueue();

        $queue->enqueue($root);
        $idx = 1;
        while ($idx <= $tailIdx) {
            /** @var Node|CType $parentNode */
            $parentNode = $queue->dequeue();
            $leftNodeValue = $list[$idx];
            $rightNodeValue = ($idx + 1) <= $tailIdx ? $list[$idx + 1] : null;
            if (null !== $leftNodeValue) {
                $parentNode->left = $node = call_user_func($nodeCreator, $leftNodeValue);
                $queue->enqueue($node);
            }
            if (null !== $rightNodeValue) {
                $parentNode->right = $node = call_user_func($nodeCreator, $rightNodeValue);
                $queue->enqueue($node);
            }

            $idx += 2; // Skip the two nodes already managed
        }

        return $root;
    }
}
