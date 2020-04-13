<?php
use PHPUnit\Framework\TestCase;
use App\Mailer;

class MockTest extends TestCase
{

    public function test_Mock()
    {
        $mock = $this->createMock(Mailer::class);

        $mock->method('sendMessage')->willReturn(true);

        $result = $mock->sendMessage('dev@example.com', 'Test Message');
        $this->assertTrue($result);
    }
}