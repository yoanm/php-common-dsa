# Naming conventions & mapping

## SplHeap 
SplMinHeap / SplMaxHeap

Construct ➙ 𝑂⟮𝑛⟯

#### Add an element
`add()`➙`insert()`

TC: 𝑂⟮㏒ 𝑛⟯<br>
SC: 𝑂⟮𝟷⟯

#### Pop an element
`pop()`➙`extract()`

TC: 𝑂⟮㏒ 𝑛⟯<br>
SC: 𝑂⟮𝟷⟯

#### Peek element
`peek()`➙`top()`

TC: 𝑂⟮𝟷⟯<br>
SC: 𝑂⟮𝟷⟯

#### DS size
`size()`➙`count()`

TC: 𝑂⟮𝟷⟯<br>
SC: 𝑂⟮𝟷⟯


## SplPriorityQueue
ℹ️ Implemented using a `SplMaxHeap`

#### Add an element
`add()`➙`insert()`

TC: 𝑂⟮㏒ 𝑛⟯<br>
SC: 𝑂⟮𝟷⟯

#### Pop an element
`pop()`➙`extract()`

TC: 𝑂⟮㏒ 𝑛⟯<br>
SC: 𝑂⟮𝟷⟯

#### Peek element
`peek()`➙`top()`

TC: 𝑂⟮𝟷⟯<br>
SC: 𝑂⟮𝟷⟯

#### DS size
`size()`➙`count()`

TC: 𝑂⟮𝟷⟯<br>
SC: 𝑂⟮𝟷⟯


## SplQueue
ℹ️ Implemented using a `SplDoublyLinkedList`

#### Enqueue an element
`enqueue()`

#### Dequeue an element
`dequeue()`

#### Peek element
`peek()`➙`bottom()`

#### DS size
`size()`➙`count()`

#### Front / Rear
⚠️ Not actually available on "real" queue !

`front()`➙`bottom()` — `peek()`<br>
`rear()`➙`top()`

## SplStack
ℹ️ Implemented using a `SplDoublyLinkedList`

#### push an element
`push()`

#### pop an element
`pop()`

#### Peek element
`peek()`➙`top()`

#### DS size
`size()`➙`count()`

#### Front / Rear
⚠️ Not actually available on "real" stack !

`front()`➙`top()` — `peek()`<br>
`rear()`➙`bottom()`
