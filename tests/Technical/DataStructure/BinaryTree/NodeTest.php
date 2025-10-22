<?php

declare(strict_types=1);

namespace Tests\Technical\DataStructure\BinaryTree;

use PHPUnit\Framework\TestCase;
use Yoanm\CommonDSA\DataStructure\BinaryTree\Node;

/**
 * @covers \Yoanm\CommonDSA\DataStructure\BinaryTree\Node
 */
final class NodeTest extends TestCase
{
    public function testProperties(): void
    {
        $leftNode = new Node(2);
        $rightNode = new Node(3);
        $node = new Node(1, $leftNode, $rightNode);

        self::assertSame(1, $node->val);
        self::assertSame($leftNode, $node->left);
        self::assertSame($rightNode, $node->right);
    }
}
