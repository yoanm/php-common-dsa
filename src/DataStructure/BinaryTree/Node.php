<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\DataStructure\BinaryTree;

/**
 * Basic binary tree node object
 */
class Node implements NodeInterface
{
    public function __construct(
        public int $val,
        public ?NodeInterface $left = null,
        public ?NodeInterface $right = null,
    ) {
    }
}
