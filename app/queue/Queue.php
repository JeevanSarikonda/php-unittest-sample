<?php
namespace App\Queue;

use App\QueueException\QueueException;

class Queue {

    /**
     * Maximum number of items in queue
     * @var integer
     */
    public const MAX_ITEMS = 5;
    /**
     * Queue items
     * @var array
     */
    protected $items = [];

    /**
     * Add an item to the queue
     * 
     * @param mixed $item The Item to add
     */
    public function push($item)
    {
        if ($this->getCount() == static::MAX_ITEMS) 
        {
            throw new QueueException("Queue is full");
        }

        $this->items[] = $item;
    }

    /**
     * Take an item from the head of the queue
     * 
     * @return mixed The item
     */
    public function pop()
    {
        return array_shift($this->items);
    }

    /**
     * Get Total number of items in queue
     * 
     * @return integer The number of items
     */
    public function getCount(): int
    {
        return count($this->items);
    }

    /**
     * Clear the items in the queue
     * 
     * @return void
     */
    public function clear(): void
    {
        $this->items = [];
    }
}