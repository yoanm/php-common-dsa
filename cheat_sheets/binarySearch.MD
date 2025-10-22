# Binary search

Also look at `Helpers\BinarySearch` class for:
 - lower / upper bound algo
 
## ⚠️ To keep in mind

1. `$midIdx` may eventually be equals to `$lowIdx` ! (when search space is smaller than 3)
   
   => In case of `while ($lowIdx <= $highIdx)` or `while ($lowIdx < $highIdx)`, always add 1 to `$midIdx` when assigned to `$lowIdx` (e.g. `$lowIdx = $midIdx + 1`)
      Otherwise algo will run indefinitely !

## Template 1
Guaranteed search space = 1 (current index)

Usage: Use current element to determine if the condition is met and decide whether to go left or right

Usage example:
- Find if a value exists in a sorted list 
- Find if a value is a solution inside a non-decreasing space search

```php
function binarySearch(array $list, int $target): int {
    $length = count($list);
    if ($length === 0) { return -1; }
    
    [$lowIdx, $highIdx] = [0, ($length - 1)];
    while ($lowIdx <= $highIdx) {
        // Prevent (left + right) overflow
        $midIdx = $lowIdx + (($highIdx - $lowIdx) >> 1);
        
        if ($list[$midIdx] < $target) { $lowIdx = $midIdx + 1; } // Too small => ignore left half on next iteration
        else if ($list[$midIdx] > $target) { $highIdx = $midIdx - 1; } // Too big => ignore right half on next iteration
        else { return $midIdx; } // Found \o/
    }
    
    // End Condition: $lowIdx > $highIdx
    return -1;
}
```

## Template 2
Guaranteed search space = 2 (current index and right neighbor)

Usage: Use the element's right neighbor to determine if the condition is met and decide whether to go left or right

```php

function binarySearch(array $list, int $target): int {
    $length = count($list);
    if ($length === 0) { return -1; }

    [$lowIdx, $highIdx] = [0, ($length - 1)];
    while ($lowIdx < $highIdx) {
        // Prevent ($lowIdx + $highIdx) overflow
        $midIdx = $lowIdx + (($highIdx - $lowIdx) >> 1);
        
        if ($list[$midIdx] < $target) { $lowIdx = $midIdx + 1; } // Too small => ignore left half on next iteration
        else if ($list[$midIdx] > $target) { $highIdx = $midIdx; } // Too big => ignore right half on next iteration 
        else { return $midIdx; } // Found \o/
    }
    
    // Post-processing:
    // End Condition: $lowIdx == $highIdx
    if ($list[$lowIdx] === $target) { return $lowIdx; }
    
    return  -1;
}
```

## Template 3
Guaranteed search space = 3 (current index + left and right neighbors)

Usage: Use the element's neighbors to determine if the condition is met and decide whether to go left or right

```php

function binarySearch(array $list, int $target): int {
    $length = count($list);
    if ($length === 0) { return -1; }
    
    [$lowIdx, $highIdx] = [0, ($length - 1)];
    while (($lowIdx + 1) < $highIdx) {
        // Prevent ($lowIdx + $highIdx) overflow
        $midIdx = $lowIdx + (($highIdx - $lowIdx) >> 1);
        
        if ($list[$midIdx] < $target) { $lowIdx = $midIdx; } // Too small => ignore left half on next iteration
        else if ($list[$midIdx] > $target) { $highIdx = $midIdx; } // Too big => ignore right half on next iteration
        else { return $midIdx; } // Found \o/
    }
    
    // Post-processing:
    // End Condition: $lowIdx + 1 == $highIdx
    if ($list[$lowIdx] === $target) { return $lowIdx; }
    if ($list[$highIdx] === $target) { return $highIdx; }
    
    return -1;
}
```
