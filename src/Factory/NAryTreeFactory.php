<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Factory;

use Yoanm\CommonDSA\DataStructure\NAryTree\Node;

class NAryTreeFactory
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
    public static function fromLevelOrderList(array $list, callable $nodeCreator): ?Node
    {
        $tailIdx = count($list) - 1;
        if ($tailIdx < 0 || (0 === $tailIdx && null === $list[0])) {
            return null;
        }

        $root = call_user_func($nodeCreator, $list[0]);
        $queue = new \SplQueue();

        $queue->enqueue($root);
        $idx = 2; // Should be index 1, but it contains the null value indicating end of children for "root" level !
        while ($idx <= $tailIdx) {
            /** @var Node $parentNode */
            $parentNode = $queue->bottom(); // =keep() => next value to dequeue from a SplQueue!
            // Append children to the current parent node until a null value is found
            if (null !== $list[$idx]) {
                $parentNode->children[] = $node = call_user_func($nodeCreator, $list[$idx]);
                $queue->enqueue($node);
            } else {
                // Drop current parent node as there is no more children to attach
                $queue->dequeue();
            }

            ++$idx;
        }

        return $root;
    }
}
