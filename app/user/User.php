<?php
namespace App\User;

use App\Mailer;

class User
{
    /**
     * User's First Name
     * @var string
     */
    public $firstName;

    /**
     * User's Last Name
     * @var string
     */
    public $lastName;

    /**
     * User's Email Address
     * @var string
     */
    public $email;

    /**
     * Mailer object for User
     * @var Mailer
     */
    protected $mailer;


    /**
     * set Mailer dependency
     * 
     * @param Mailer $mailer The Mailer object
     */
    public function setMailer(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Get User's full name from First Name and Last Name
     * 
     * @return string
     */
    public function getFullName(): string
    {
        return trim($this->firstName .' '. $this->lastName);
    }

    /**
     * Send notification to the user that
     * 
     * @param string $message Message text to notify
     * 
     * @return boolean True if sent, false if not
     */
    public function notify($message)
    {
        return $this->mailer->sendMessage($this->email, $message);
    }
}