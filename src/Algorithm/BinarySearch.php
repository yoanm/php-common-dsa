<?php

declare(strict_types=1);

namespace Yoanm\CommonDSA\Algorithm;

class BinarySearch
{
    /**
     * Find an index where value is equal to $target
     *
     *
     * ### Time/Space complexity
     * With:
     * - 𝑛 equals the provided list length.
     *
     * TC: 𝑂⟮㏒ 𝑛⟯ - classic for binary search
     *
     * SC: 𝑂⟮𝟷⟯ - Constant extra space
     *
     *
     * @template TValue of (int|float)
     *
     *
     * @param array<int|float> $list ⚠ Must be a 0 indexed list, 0 to n consecutive indexes, sorted in non-decreasing
     *                               order (min→max)!<br>
     *                               May contain duplicates.
     * @phpstan-param list<TValue> $list
     * @phpstan-param TValue $target
     * @param int $headIdx Lookup start index.<br>
     *                     Default to 0 (head index).
     * @param int|null $tailIdx Lookup end index.<br>
     *                          Default to tail index
     *
     * @return int Index where $target has been found, -1 if not found
     */
    public static function find(
        array $list,
        int|float $target,
        int $headIdx = 0,
        int|null $tailIdx = null,
    ): int {
        $tailIdx ??= count($list) - 1;

        while ($headIdx <= $tailIdx) {
            // Prevent ($lowIdx + $highIdx) overflow !
            $midIdx = $headIdx + (($tailIdx - $headIdx) >> 1);

            if ($list[$midIdx] < $target) {
                // Current value is too small ? => Ignore left side and current
                $headIdx = $midIdx + 1;
            } elseif ($list[$midIdx] > $target) {
                // Current value is greater ? => Ignore right side and current
                $tailIdx = $midIdx - 1;
            } else {
                return $midIdx;
            }
        }

        return -1;
    }

    /**
     * Finds the index of left-most element which is greater than or equal to $target (=not strictly lower than $target)
     *
     *
     * ### Time/Space complexity
     * With:
     * - 𝑛 equals the provided list length.
     *
     * TC: 𝑂⟮㏒ 𝑛⟯ - classic for binary search
     *
     * SC: 𝑂⟮𝟷⟯ - Constant extra space
     *
     *
     * @template TValue of (int|float)
     *
     *
     * @param array<int|float> $list ⚠ Must be a 0 indexed list, 0 to n consecutive indexes, sorted in non-decreasing
     *                               order (min→max)!<br>
     *                               May contain duplicates.
     * @phpstan-param list<TValue> $list
     * @phpstan-param TValue $target
     * @param int $lowIdx Lookup start index.<br>
     *                    Default to 0 (head index).
     * @param int|null $highIdx Lookup end index.<br>
     *                          Default to $list length (=tail index + 1)
     *
     * @return int Index where $target can be inserted in $list while keeping it sorted.<br>
     *             ⚠ Might be beyond $list current indexes if $target is greater than tail value !
     */
    public static function lowerBound(
        array $list,
        int|float $target,
        int $lowIdx = 0,
        int|null $highIdx = null,
    ): int {
        $highIdx ??= count($list);

        while ($lowIdx < $highIdx) {
            // Prevent ($lowIdx + $highIdx) overflow !
            $midIdx = $lowIdx + (($highIdx - $lowIdx) >> 1);

            if ($list[$midIdx] < $target) {
                // Current value is too small ? => Ignore left side and current
                $lowIdx = $midIdx + 1;
            } else {
                // Current value is either equal or greater ?
                // => Ignore right side BUT keep current (might be the right index)
                $highIdx = $midIdx;
            }
        }

        return $lowIdx;
    }

    /**
     * Finds the index of left-most element which is strictly greater than $target
     *
     *
     * ### Time/Space complexity
     * With:
     * - 𝑛 equals the provided list length.
     *
     * TC: 𝑂⟮㏒ 𝑛⟯ - classic for binary search
     *
     * SC: 𝑂⟮𝟷⟯ - Constant extra space
     *
     *
     * @template TValue of (int|float)
     *
     *
     * @param array<int|float> $list ⚠ Must be a 0 indexed list, 0 to n consecutive indexes, sorted in non-decreasing
     *                               order (min→max)!<br>
     *                               May contain duplicates.
     * @phpstan-param list<TValue> $list
     * @phpstan-param TValue $target
     * @param int $lowIdx Lookup start index.<br>
     *                    Default to 0 (head index).
     * @param int|null $highIdx Lookup end index.<br>
     *                          Default to $list length (=tail index + 1)
     *
     * @return int Index where $target can be inserted in $list while keeping it sorted.<br>
     *             ⚠ Might be beyond $list current indexes if $target is greater than or equal to tail value !
     */
    public static function upperBound(
        array $list,
        int|float $target,
        int $lowIdx = 0,
        int|null $highIdx = null,
    ): int {
        $highIdx ??= count($list);

        while ($lowIdx < $highIdx) {
            // Prevent ($lowIdx + $highIdx) overflow !
            $middleIdx = $lowIdx + (($highIdx - $lowIdx) >> 1);

            if ($list[$middleIdx] <= $target) {
                // Current value is either equal or too small ? => Ignore left side and current
                $lowIdx = $middleIdx + 1;
            } else {
                // Current value is greater ? => Ignore right side BUT keep current (might be the right index)
                $highIdx = $middleIdx;
            }
        }

        return $lowIdx;
    }
}
