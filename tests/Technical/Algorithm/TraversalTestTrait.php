<?php

declare(strict_types=1);

namespace Tests\Technical\Algorithm;

use PHPUnit\Framework\Assert;
use Yoanm\CommonDSA\DataStructure\BinaryTree\Node as BTNode;
use Yoanm\CommonDSA\DataStructure\NAryTree\Node as NATNode;

trait TraversalTestTrait
{
    /**
     * @param array<int> $expected
     * @phpstan-param list<int> $expected
     * @param iterable<BTNode|NATNode> $actual
     */
    protected static function assertSameTreeNodeValues(array $expected, iterable $actual, Assert $assert): void
    {
        $newActual = [];
        foreach ($actual as $node) {
            $newActual[] = $node->val;
        }

        $assert::assertSame($expected, $newActual);
    }

    /**
     * @param array<int, array<int>> $expected
     * @phpstan-param array<int, list<int>> $expected
     * @param iterable<iterable<BTNode|NATNode>> $actual
     */
    protected static function assertLevelOrderSameTreeNodeValues(array $expected, iterable $actual, Assert $assert): void
    {
        $newActual = [];
        foreach ($actual as $nodeList) {
            $tmpList = [];
            foreach ($nodeList as $node) {
                $tmpList[] = $node->val;
            }
            $newActual[] = $tmpList;
        }

        $assert::assertSame($expected, $newActual);
    }
}
