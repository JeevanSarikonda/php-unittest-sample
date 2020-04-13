<?php
use PHPUnit\Framework\TestCase;
use App\Queue\Queue;

class QueryTest2 extends TestCase
{
    protected $queue;

    protected function setUp(): void
    {
        $this->queue = new Queue();
    }

    protected function tearDown(): void
    {
        unset($this->queue);
    }

    public function test_NewQueueIsEmpty()
    {
        $this->assertEquals(0, $this->queue->getCount());
    }

    public function test_ItemIsAddedToTheQueue()
    {
        $this->queue->push('Green');

        $this->assertEquals(1, $this->queue->getCount());
    }

    public function test_ItemIsRemovedFromTheQueue()
    {

        $this->queue->push('Green');
        $item = $this->queue->pop();

        $this->assertEquals(0, $this->queue->getCount());
        $this->assertEquals('Green',$item);
    }

    public function test_ItemIsRemovedFromTheQueueFromFrontOfTheQueue()
    {
        $this->queue->push('first');
        $this->queue->push('second');

        $this->assertEquals('first',$this->queue->pop());
    }
}