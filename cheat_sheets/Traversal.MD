# BFS

```php
function BFS(?TreeNode $root): iterable {
    $queue = new \SplQueue();
    
    $queue->enqueue($root);
    while (!$queue->isEmpty()) {
        $resCurrentLevel = [];
        
        $queueSize = $queue->count();
        while ($queueSize > 0) {
            $node = $queue->dequeue();
            
            yield $node;
            
            if (null !== $node->left) {
                $queue->enqueue($node->left);
            }
            if (null !== $node->right) {
                $queue->enqueue($node->right);
            }
            --$queueSize;
        }
        $res[] = $resCurrentLevel;
    }
}
function BFSRecursive(?TreeNode $root, int $level = 0, array &$res = []): iterable {
    if (count($res) === $level) { // Current level hasn't been seen/managed yet
        // => create an entry in $res in order to store values for that level
        $res[$level] = [];
    }
    yield [$evel, $root]; // Push Node (N) under current level (=its own level)
    if (null !== $root->left) { // Push Left child (L) under its **own** level (hence $level+1)
        yield from BFSRecursive($root->left, $level + 1, $res);
    }
    if (null !== $root->right) { // Push Right child (R) under its **own** level (hence $level+1)
        yield from BFSRecursive($root->right, $level + 1, $res);
    }
}
```

# DFS

```php
function DFS(?Node $root): iterable {
    $stack = new \SplStack();
    
    $currentNode = $root;
    while (null !== $currentNode || !$stack->isEmpty()) {
        while (null !== $currentNode) {
            $stack->push($currentNode);
            $currentNode = $currentNode->left;
        }

        // Current node becomes the left-most leaf found (or the same current node in case it doesn't have left node!)
        $currentNode = $stack->pop();

        yield $currentNode;

        // Left is now managed, let's take a look on right side now
        $currentNode = $currentNode->right;
    }
}
public function DFSRecursive(?Node $root, array &$res = []): iterable {
    if (null !== $root) {
        yield from DFSRecursive($root->left, $res); // Left nodes
        yield $root->val; // Root node
        yield from DFSRecursive($root->right, $res); // Right nodes
    }

    return $res;
}
```
