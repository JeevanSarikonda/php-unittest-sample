<?php
use PHPUnit\Framework\TestCase;
use App\User\User;
use App\Mailer;

class UserTest extends TestCase
{
    public function test_ReturnsFullName()
    {
        $user = new User();

        $user->firstName = 'John';
        $user->lastName = 'Doe';

        $this->assertEquals('John Doe', $user->getFullName());
    }

    public function test_FullNameIsEmptyByDefault()
    {
        $user = new User();

        $this->assertEquals('', $user->getFullName());
    }

    public function test_NotificationIsSent()
    {
        $user = new User();

        $mock_mailer = $this->createMock(Mailer::class);
        $mock_mailer->expects($this->once())
                    ->method('sendMessage')
                    ->with($this->equalTo('dev@example.com'), $this->equalTo('Hello Dev'))
                    ->willReturn(true);

        $user->setMailer($mock_mailer);

        $user->email = 'dev@example.com';

        $this->assertTrue($user->notify('Hello Dev'));
    }

    public function test_CannotNotifyUserWithNoEmail()
    {
        $user = new User;
        $mock_mailer = $this->getMockBuilder(Mailer::class)
                            ->setMethods(null)
                            ->getMock();

        $user->setMailer($mock_mailer);
        $this->expectException(Exception::class);

        $user->notify('Test');
    }
}