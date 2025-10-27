# Complexity

<!--
𝑂⟮𝑛⟯
𝑛 / 𝑚 / 𝑥 / 𝑦 / 𝑧 / 𝘩 (look for "MATHEMATICAL ITALIC SMALL [THE LETTER]")
﹢ / − / × / ∕
= / ≤ / ≥ / ± / ≈
√ / ∛ / ∜ / ∞
㏒ / ² / ³ / ½
𝟶 / 𝟷 / 𝟸 / 𝟹 / 𝟺 / 𝟻 / 𝟼 / 𝟽 / 𝟾 / 𝟿
-->

## Array
ℹ️ For an array of `𝑛` values, `𝑥` is the index of a given value in the array (from `𝟶` to `𝑛 − 𝟷`)

| Operation         | TC          | SC     | Notes                                                                                      |
|:------------------|:------------|:-------|:-------------------------------------------------------------------------------------------|
| Add — at index 𝑥 | 𝑂⟮𝑛 − 𝑥⟯ | 𝑂⟮𝟷⟯ | Need to push values from index `𝑥` to `𝑛 − 𝟷`,<br> in order to make room for new value  |
| Add — as head     | 𝑂⟮𝑛⟯      | 𝑂⟮𝟷⟯ | Need to push each and every values,<br> in order to make room for new head value           |
| Add — as tail     | 𝑂⟮𝟷⟯      | 𝑂⟮𝟷⟯ |                                                                                            |
| Remove — index 𝑥 | 𝑂⟮𝑛 − 𝑥⟯ | 𝑂⟮𝟷⟯ | Need to move back values from `𝑥 ﹢ 𝟷` index to tail value,<br> in order to fill the hole |
| Remove — head     | 𝑂⟮𝑛⟯      | 𝑂⟮𝟷⟯ | Need to move back each and every remaining values,<br> in order to fill the hole           |
| Remove — tail     | 𝑂⟮𝟷⟯      | 𝑂⟮𝟷⟯ |                                                                                            |
| Peek index 𝑥     | 𝑂⟮𝟷⟯      | 𝑂⟮𝟷⟯ |                                                                                            |

## Vector
ℹ️ For a vector of `𝑛` values, `𝑥` is the index of a given value in the vector (from `𝟶` to `𝑛 − 𝟷`)

⚠️️ Amortized vs Reallocation:<br>
Some operation may require copying current elements into a larger vector (when capacity execeeded).<br>
Which implies to iterate over each and every values, implying 𝑂⟮𝑛⟯ time complexity (and likely 𝑂⟮𝑛⟯ space complexity then)

| Operation         | TC                                              | SC     | Notes                                                                                      |
|:------------------|:------------------------------------------------|:-------|:-------------------------------------------------------------------------------------------|
| Add — at index 𝑥 | 𝑂⟮𝑛 − 𝑥⟯ (Amortized)                         | 𝑂⟮𝟷⟯ | Need to push values from index `𝑥` to `𝑛 − 𝟷`,<br> in order to make room for new value  |
| Add — as head     | 𝑂⟮𝑛⟯                                          | 𝑂⟮𝟷⟯ | Need to push each and every values,<br> in order to make room for new head value           |
| Add — as tail     | 𝑂⟮𝟷⟯ (Amortized)                              | 𝑂⟮𝟷⟯ |                                                                                            |
| Remove — index 𝑥 | 𝑂⟮𝑛 − 𝑥⟯                                     | 𝑂⟮𝟷⟯ | Need to move back values from `𝑥 ﹢ 𝟷` index to tail value,<br> in order to fill the hole |
| Remove — head     | 𝑂⟮𝑛⟯                                          | 𝑂⟮𝟷⟯ | Need to move back each and every remaining values,<br> in order to fill the hole           |
| Remove — tail     | 𝑂⟮𝟷⟯                                          | 𝑂⟮𝟷⟯ |                                                                                            |
| Peek index 𝑥     | 𝑂⟮𝟷⟯                                          | 𝑂⟮𝟷⟯ |                                                                                            |

## Linked list
ℹ️ For a LL of `𝑛` nodes, `𝑥` is the position of a given node in the list (from `𝟶` to `𝑛 − 𝟷`)

| Operation                        | TC     | SC     | Notes                                                                                                                   |
|:---------------------------------|:-------|:-------|:------------------------------------------------------------------------------------------------------------------------|
| Add — at position `𝑥`           | 𝑂⟮𝑥⟯ | 𝑂⟮𝟷⟯ | Need to iterate from head to node `𝑥 − 𝟷`,<br> in order to retrieve node `𝑥 − 𝟷` and be able to link it to new node |
| Add — **after** given node `𝑥`  | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |                                                                                                                         |
| Add — **before** given node `𝑥` | 𝑂⟮𝑥⟯ | 𝑂⟮𝟷⟯ | Need to iterate from head to node `𝑥 − 𝟷`,<br> in order to retrieve node `𝑥 − 𝟷` and be able to link it to new node |
| Add — as head                    | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |                                                                                                                         |
| Add — as tail                    | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ | ⚠️ Assuming tail node is known !<br>Otherwise 𝑂⟮𝑛⟯, in order to retrieve current tail node                            |
| Remove — at position `𝑥`        | 𝑂⟮𝑥⟯ | 𝑂⟮𝟷⟯ | Need to iterate from head to node `𝑥 − 𝟷`,<br> in order to be able to link node `𝑥 − 𝟷` to node `𝑥 ﹢ 𝟷`           |
| Remove — given node `𝑥`         | 𝑂⟮𝑥⟯ | 𝑂⟮𝟷⟯ | Need to iterate from head to node `𝑥 − 𝟷`,<br> in order to be able to link node `𝑥 − 𝟷` to node `𝑥 ﹢ 𝟷`           |
| Remove — head                    | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |                                                                                                                         |
| Remove — tail                    | 𝑂⟮𝑛⟯ | 𝑂⟮𝟷⟯ | Need to iterate from head to node before tail node,<br> in order to unlink it from original tail node                   |
| Find node `𝑥`                   | 𝑂⟮𝑥⟯ | 𝑂⟮𝟷⟯ | Need to iterate from head to node `𝑥`                                                                                  |

## Doubly linked list
ℹ️ For a DLL of `𝑛` nodes, `𝑥` is the position of a given node in the list (from `𝟶` to `𝑛 − 𝟷`)

| Operation                        | TC     | SC     | Notes                                                                                                                                   |
|:---------------------------------|:-------|:-------|:----------------------------------------------------------------------------------------------------------------------------------------|
| Add — at position `𝑥`           | 𝑂⟮𝑥⟯ | 𝑂⟮𝟷⟯ | Need to iterate from head to node `𝑥 − 𝟷`,<br> in order to retrieve node `𝑥 − 𝟷` and be able to link it to new node                 |
| Add — **after** given node `𝑥`  | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |                                                                                                                                         |
| Add — **before** given node `𝑥` | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |                                                                                                                                         |
| Add — as head                    | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |                                                                                                                                         |
| Add — as tail                    | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ | ⚠️ Assuming tail node is known !<br>Otherwise 𝑂⟮𝑛⟯ in order to retrieve original tail node                                            |
| Remove — at position `𝑥`        | 𝑂⟮𝑥⟯ | 𝑂⟮𝟷⟯ | Need to iterate from head to node `𝑥`,<br> in order to retrieve node `𝑥`                                                              |
| Remove — given node `𝑥`         | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |                                                                                                                                         |
| Remove — head                    | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |                                                                                                                                         |
| Remove — tail                    | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ | ⚠️ Assuming tail node is known !<br>Otherwise 𝑂⟮𝑛⟯, in order to retrieve node before tail node and unlink it from original tail node  |
| Find node `𝑥`                   | 𝑂⟮𝑥⟯ | 𝑂⟮𝟷⟯ | Need to iterate from head to node `𝑥`                                                                                                  |

## Heap
| Operation | TC       | SC     | Notes                                                              |
|:----------|:---------|:-------|--------------------------------------------------------------------|
| Add       | 𝑂⟮㏒ 𝑛⟯ | 𝑂⟮𝟷⟯ | In order to re-balance the tree after the new value has been added |
| Pop       | 𝑂⟮㏒ 𝑛⟯ | 𝑂⟮𝟷⟯ | In order to re-balance the tree after the value has been popped    |
| Peek      | 𝑂⟮𝟷⟯   | 𝑂⟮𝟷⟯ |                                                                    |

## Queue / Stack
ℹ️ Assuming implementation leveraging a circular array (finite-size) or Linked list.<br>
_Using a simple array for instance would imply pushing/moving back values depending on the operation (see Array above)_

| Operation      | TC     | SC     |
|:---------------|:-------|:-------|
| Enqueue / Push | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |
| Dequeue / Pop  | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |
| Peek           | 𝑂⟮𝟷⟯ | 𝑂⟮𝟷⟯ |

## Time Complexity

### Examples

- 𝑥 the length of a 2D list
- 𝑦 the height of a 2D list
- 𝑛 the number of item in a list (e.g: 𝑛 = 𝑥 × 𝑦 2D list)

#### 𝑂⟮𝟷⟯
```
DoSomething();
```

#### 𝑂⟮𝑛⟯
```php
for (i=0; i<n; i++) { // 1D list
  DoSomething();
}
for (i=0; i<x; i++) { // 2D list (𝑛 = 𝑥 × 𝑦)
  for (j=0; j<y; j++) {
    DoSomething(i,j);
  }
}
```

#### 𝑂⟮㏒ 𝑛⟯

```php
for ($i=0; $i<$n; $i=$i*2) { // Notice `$i=$i*2` ! 
  DoSomething();
}
```

#### 𝑂⟮𝑛 ㏒ 𝑛⟯

```php
for ($i=0; $i<n; $i++) {
  for ($j=0; $j<$n; $j=$j*2) {
    DoSomething();
  }
}
```

#### 𝑂⟮㏒² 𝑛⟯
```php
for ($i=0; $i<$n; $i=$i*2) {
  for ($j=0; $j<$n; $j=$j*2) {
    DoSomething();
  }
}
```

#### 𝑂⟮𝑛²⟯

```php
for ($i=0; $i<$n; $i=$i++) {
  for ($j=0; $j<$n; $j=$j++) {
    DoSomething();
  }
}
```

#### 𝑂⟮𝟸^𝑛⟯

```php
DoSomething(int $n): int
{
  if ($n<1) {
    return $n;
  }
  
  return DoSomething($n-1);
}
```

#### 𝑂⟮½ × 𝑥 × ⟮𝑥﹢𝟷⟯⟯ versus 𝑂⟮𝑛⟯
Each cell is visited **only one time**, rather than two time if `$j=0` !

```php
for ($i=0; $i<$x; $i++) {
  //—> Notice: $j=$i, not $j=0 !
  for ($j=$i; $j<$y; $j++) {
    DoSomething($i,$j);
  }
}
```
```
｜‾‾‾‾‾‾‾‾‾｜‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾｜‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾｜‾‾‾‾‾‾‾‾‾‾｜‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾｜‾‾‾‾‾‾‾‾‾‾‾｜
｜    𝑥    ｜    𝑂⟮𝑥 × 𝑥⟯ = 𝑂⟮𝑛⟯    ｜   𝑂⟮½ × 𝑥 × ⟮𝑥﹢𝟷⟯⟯  ｜    %     ｜     Saved     ｜  % Saved  ｜
｜—————————｜—————————————————————｜———————————————————｜——————————｜———————————————｜———————————｜
｜       1 ｜                   1 ｜                 1 ｜ 100.00 % ｜             0 ｜    0.00 % ｜
｜       2 ｜                   4 ｜                 3 ｜  75.00 % ｜             1 ｜   25.00 % ｜
｜       3 ｜                   9 ｜                 6 ｜  66.67 % ｜             3 ｜   33.33 % ｜
｜       5 ｜                  25 ｜                15 ｜  60.00 % ｜            10 ｜   40.00 % ｜
｜       8 ｜                  64 ｜                36 ｜  56.25 % ｜            28 ｜   43.75 % ｜
｜       9 ｜                  81 ｜                45 ｜  55.56 % ｜            36 ｜   44.44 % ｜
｜      10 ｜                 100 ｜                55 ｜  55.00 % ｜            45 ｜   45.00 % ｜
｜      13 ｜                 169 ｜                91 ｜  53.85 % ｜            78 ｜   46.15 % ｜
｜      25 ｜                 625 ｜               325 ｜  52.00 % ｜           300 ｜   48.00 % ｜
｜      50 ｜               2,500 ｜             1,275 ｜  51.00 % ｜         1,225 ｜   49.00 % ｜
｜     100 ｜              10,000 ｜             5,050 ｜  50.50 % ｜         4,950 ｜   49.50 % ｜
｜     125 ｜              15,625 ｜             7,875 ｜  50.40 % ｜         7,750 ｜   49.60 % ｜
｜     167 ｜              27,889 ｜            14,028 ｜  50.30 % ｜        13,861 ｜   49.70 % ｜
｜     249 ｜              62,001 ｜            31,125 ｜  50.20 % ｜        30,876 ｜   49.80 % ｜
｜     495 ｜             245,025 ｜           122,760 ｜  50.10 % ｜       122,265 ｜   49.90 % ｜
｜  45,455 ｜       2,066,157,025 ｜     1,033,101,240 ｜  50.00 % ｜ 1,033,055,785 ｜   50.00 % ｜
｜_________｜_____________________｜___________________｜__________｜_______________｜___________｜
```
