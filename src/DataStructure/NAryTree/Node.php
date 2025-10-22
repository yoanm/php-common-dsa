<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\DataStructure\NAryTree;

/**
 * Basic n-ary tree node object
 */
class Node implements NodeInterface
{
    public function __construct(
        public int $val,
        /**
         * @var NodeInterface[]
         */
        public array $children = [],
    ) {
    }
}
