<?php

declare(strict_types=1);

namespace Tests\Technical\DataStructure\NAryTree;

use PHPUnit\Framework\TestCase;
use Yoanm\CommonDSA\DataStructure\NAryTree\Node;

/**
 * @covers \Yoanm\CommonDSA\DataStructure\NAryTree\Node
 */
final class NodeTest extends TestCase
{
    public function testProperties(): void
    {
        $children = [new Node(2), new Node(3)];
        $node = new Node(1, $children);

        self::assertSame(1, $node->val);
        self::assertSame($children, $node->children);
    }
}
