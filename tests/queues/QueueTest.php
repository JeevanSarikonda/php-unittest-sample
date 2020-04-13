<?php
use PHPUnit\Framework\TestCase;
use App\Queue\Queue;

class QueryTest extends TestCase
{
    protected static $queue;

    /**
     * Setup Method
     * Runs before every test method
     */
    protected function setUp(): void
    {
        static::$queue->clear();
    }

    /**
     * Setup Method before class
     * Runs before the first test of the class
     */
    public static function setUpBeforeClass(): void
    {
        static::$queue = new Queue();
    }

    /**
     * tearDown Method after class
     * Runs after last test of the class
     */
    public static function tearDownAfterClass(): void
    {
        static::$queue = null;
    }

    public function test_NewQueueIsEmpty()
    {
        $this->assertEquals(0, static::$queue->getCount());
    }

    public function test_ItemIsAddedToTheQueue()
    {
        static::$queue->push('Green');

        $this->assertEquals(1, static::$queue->getCount());
    }

    public function test_ItemIsRemovedFromTheQueue()
    {

        static::$queue->push('Green');
        $item = static::$queue->pop();

        $this->assertEquals(0, static::$queue->getCount());
        $this->assertEquals('Green',$item);
    }

    public function test_ItemIsRemovedFromTheQueueFromFrontOfTheQueue()
    {
        static::$queue->push('first');
        static::$queue->push('second');

        $this->assertEquals('first',static::$queue->pop());
    }

    public function test_MaximumNumberOfItemsCanBeAdded()
    {
        for ($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            static::$queue->push($i);
        }

        $this->assertEquals(Queue::MAX_ITEMS, static::$queue->getCount());
    }

    public function test_ExceptionThrownWhenAddingItemToFullQueue()
    {
        for ($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            static::$queue->push($i);
        }

        $this->expectException(App\QueueException\QueueException::class);
        $this->expectExceptionMessage('Queue is full');
        static::$queue->push('test');
    }
}