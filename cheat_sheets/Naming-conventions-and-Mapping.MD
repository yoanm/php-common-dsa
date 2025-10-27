# Naming conventions & mapping

| Operation  | SplHeap              | SplPriorityQueue    | SplQueue              | SplStack              |
|:-----------|:---------------------|:--------------------|:----------------------|:----------------------|
| Add        | `add()`➙`insert()`   | `add()`➙`insert()`  | `enqueue()`           | `push()`              |
| Remove     | `pop()`➙`extract()`  | `pop()`➙`extract()` | `dequeue()`           | `pop()`               |
| Peek       | `peek()`➙`top()`     | `peek()`➙`top()`    | `peek()`➙`bottom()`   | `peek()`➙`top()`      |
| Size       | `size()`➙`count()`   | `size()`➙`count()`  | `size()`➙`count()`    | `size()`➙`count()`    |
| Front      | —                    | —                   | `front()`➙`bottom()`  | `front()`➙`top()`     |
| Rear       | —                    | —                   | `rear()`➙`top()`      | `rear()`➙`bottom()`   |
| Note ℹ️    | —                    | `SplMaxHeap`        | `SplDoublyLinkedList` | `SplDoublyLinkedList` |
