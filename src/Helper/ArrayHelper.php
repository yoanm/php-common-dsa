<?php

namespace Yoanm\CommonDSA\Helper;

use ArrayAccess;
use Countable;

class ArrayHelper
{
    /**
     * Insert the value at the given index and push back values from $index to tail index
     *
     *
     * ### Time/Space complexity
     * With:
     * - 𝑛 equals the provided list length.
     * - 𝑥 equals to the number of values to push back (𝑥 = ⟮𝑛 − 𝟷 − $index⟯).
     *
     * TC: 𝑂⟮𝑥⟯ - Algo will iterate over each and every value to push back
     *
     * SC: 𝑂⟮𝟷⟯ - Constant extra space
     *
     * @param array<mixed> $list ⚠ Must be a 0 indexed list, 0 to n consecutive indexes !
     * @phpstan-param list<mixed> $list
     * @param int $index ⚠ Expected to be between 0 and 𝑛 !
     * @param mixed $value
     */
    public static function insertAt(array &$list, int $index, mixed $value): void
    {
        $tailIdx = count($list) - 1;

        // 1. Move values until the end of original list
        $prevValue = $value;
        while ($index <= $tailIdx) {
            // Backup original value at $index + replace original value by the previous value
            [$prevValue, $list[$index]] = [$list[$index], $prevValue]; // @phpstan-ignore parameterByRef.type
            ++$index;
        }

        // 2. Append the original tail value at the end of the list (=new index !)
        $list[$index] = $prevValue; // @phpstan-ignore parameterByRef.type
    }
}
