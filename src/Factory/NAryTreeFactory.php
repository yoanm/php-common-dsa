<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Factory;

use Yoanm\CommonDSA\DataStructure\NAryTree\Node;

class NAryTreeFactory
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

        /** @var \SplQueue<Node> $queue */
        $queue = new \SplQueue();

        $root = call_user_func($nodeCreator, $list[0]); // @phpstan-ignore argument.type
        $queue->enqueue($root);

        $idx = 2; // Should be index 1, but it contains the null value indicating end of children for "root" level !
        while ($idx <= $tailIdx) {
            $parentNode = $queue->bottom(); // =peek() => next value to dequeue from a SplQueue!

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
