<?php

namespace Yoanm\CommonDSA\DataStructure\NAryTree;

/**
 * N-ary tree node interface.
 *
 *
 * @property NodeInterface[] $children
 */
interface NodeInterface
{
    /**
     * @var NodeInterface[]
     */
    // public array $children {get; set;} // @TODO uncomment once php 8.4 minimum is required !
}
