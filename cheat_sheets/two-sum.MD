# Two-sum

## Find indexes `i`/`j` where `list[i] + list[j] === target`

###  brute-force
```php
/**
 * With:
 *  - 𝑛 equals the provided list length
 * Time complexity: 𝑂⟮𝑛⟯ × 𝑂⟮𝑛⟯ => 𝑂⟮𝑛²⟯
 * Space complexity: 𝑂⟮𝟷⟯ Constant extra space
 * 
 * @param int[] $list
 *
 * @return array{0: int, 1: int}
 */
function twoSum(array $list, int $target): array {
    $tailIdx = count($list) - 1;

    for ($idx1 = 0; $idx1 <= $tailIdx; ++$idx1) { // 𝑂⟮𝑛⟯ × 𝑂⟮𝑛⟯
        $complement = $target - $list[$idx1];
        for ($idx2 = ($idx1 + 1); $idx2 <= $tailIdx; ++$idx2) { // 𝑂⟮𝑛⟯
            if ($list[$idx2] === $complement) {
                return [$idx1, $idx2];  
            }
        }
    }

    // Something went wrong if we reach that point !!!! One solution must exist
    throw new \Exception('Ouups !');
}
```

###  Two-pass Hash Table
```php
/**
 * With:
 *  - 𝑛 equals the provided list length
 * Time complexity: 𝑂⟮𝑛⟯ ﹢ 𝑂⟮𝑛⟯ => 𝑂⟮𝟸𝑛⟯ => 𝑂⟮𝑛⟯
 * Space complexity: 𝑂⟮𝑛⟯ In order to store all value<=>index in the map
 * 
 * @param int[] $list
 *
 * @return array{0: int, 1: int}
 */
function twoSum(array $list, int $target): array {
    $tailIdx = count($list) - 1;
    $hashMap = [];

    // 1. Fill hash map
    $idx = -1;
    while (++$idx <= $tailIdx) {
        $hashMap[$list[$idx]] = $idx; // /!\ With same value at multiple index => Use $hashMap[$list[$idx]][] = $idx;
    }
    
    // 1. Iterate and find, while filling hashMap => 𝑂⟮𝑛⟯ (Assuming hashMap lookup is 𝑂⟮𝟷⟯)
    $idx = -1;
    while (++$idx <= $tailIdx) { // `while` is faster than `for`/`foreach BUT less readable
        $complement = $target - $list[$idx];
        if (null !== ($hashMap[$complement] ?? null) && $hashMap[$complement] !== $idx) {
            return [$hashMap[$complement], $idx];
        }
    }

    // Something went wrong if we reach that point !!!! One solution must exist
    throw new \Exception('Ouups !');
}
```

###  One-pass Hash Table
```php
/**
 * With:
 *  - 𝑛 equals the provided list length
 * Time complexity: 𝑂⟮𝑛⟯
 * Space complexity: 𝑂⟮𝑛⟯ In order to store all value<=>index in the map
 *                      BUT optimized to store only values until solution is found (= 𝑂⟮𝑛⟯ in worse case only)
 * 
 * @param int[] $list
 *
 * @return array{0: int, 1: int}
 */
function twoSum(array $list, int $target): array {
    $tailIdx = count($list) - 1;
    $hashMap = [];
    
    // 1. Iterate and find, while filling hashMap => 𝑂⟮𝑛⟯ (Assuming hashMap lookup is 𝑂⟮𝟷⟯)
    $idx = -1;
    while (++$idx <= $tailIdx) { // `while` is faster than `for`/`foreach` BUT less readable
        $val = $list[$idx];
        $complement = $target - $val;
        if (null !== ($hashMap[$complement] ?? null) && $hashMap[$complement] !== $idx) {
            return [$hashMap[$complement], $idx];
        }
        $hashMap[$val] = $idx; // /!\ With same value at multiple index => Use $hashMap[$list[$idx]][] = $idx;
    }

    // Something went wrong if we reach that point !!!! One solution must exist
    throw new \Exception('Ouups !');
}
```

## Find out if sum of values equals a target number

### Sort + Two pointers
```php
class TwoSum {
    private array $list;
    private bool $isSorted = false;

    function __construct() {
        $this->list = [];
    }

    function add(int $number): void {
        $this->list[] = $number;
        $this->isSorted = false;
    }

    function find(int $target): bool {
        // /!\ If there is more call to find than to add => More efficient to sort on `add` function
        // => Even more optimized to iterate over the list + add the new value at right place + move remaining values !
        // => Even more optimized to use binary search to find the right place + add the new value at right place + move remaining values !
        if (false === $this->isSorted) {
            sort($this->list);
            $this->isSorted = true;
        }
        
        [$lowIdx, $highIdx] = [0, (count($this->list - 1))];
        while ($lowIdx < $highIdx) {
            $sum = $this->list[$lowIdx] + $this->list[$highIdx];
            if ($sum > $target) { --$highIdx } // Too big => Move $highIdx back to smaller number
            else if($sum < $target) { ++$lowIdx } // Too small => Move $lowIdx to bigger number
            else { return true } // Found \o/
        }

        return false;
    }
}
```

### Hash Table
```php
class TwoSum {
    private array $numberCount;

    function __construct() {
        $this->numberCount = [];
    }

    function add(int $number): void {
        $this->numberCount[$number] = ($this->numberCount[$number] ?? 0) + 1;
        // N.B.: In case `i`/`j` indexes are expected to be returned
        // => Use a list for the numbers and a map to store their indexes instead
    }

    function find(int $target): bool {
        $idx = -1;
        while (++$idx <= $tailIdx) { // `while` is faster than `for`/`foreach BUT less readable
            $val = $list[$idx];
            $complement = $target - $val;
            if ($complement !== $val) {
                if (null !== ($this->numberCount[$complement] ?? null)) {
                    return true; // Complement exists in the list
                }
            } else if (($this->numberCount[$complement] ?? 0) > 1) {
                return true; // Number exists at least two times on the list
            }
        }

        return false;
    }
}
```
