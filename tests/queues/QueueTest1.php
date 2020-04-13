<?php
use PHPUnit\Framework\TestCase;
use App\Queue\Queue;

class QueryTest1 extends TestCase
{
    public function test_NewQueueIsEmpty()
    {
        $queue = new Queue();

        $this->assertEquals(0, $queue->getCount());

        return $queue;
    }

    /**
     * @depends test_NewQueueIsEmpty
     */
    public function test_AnItemIsAddedToTheQueue(Queue $queue)
    {
        $queue->push('Green');

        $this->assertEquals(1, $queue->getCount());

        return $queue;
    }

    /**
     * @depends test_AnItemIsAddedToTheQueue
     */
    public function test_AnItemIsRemovedFromTheQueue(Queue $queue)
    {
        $item = $queue->pop();

        $this->assertEquals(0, $queue->getCount());
        $this->assertEquals('Green', $item);
    }
}