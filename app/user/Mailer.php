<?php
namespace App;
use Exception;

class Mailer
{

    /**
     * Send a message
     * 
     * @param string $email The email address
     * @param string $message The message
     * 
     * @return boolean True if the message was sent, false otherwise
     */
    public function sendMessage($email, $message)
    {
        if(empty($email)) 
        {
            throw new Exception;
        }
        sleep(2);

        echo "send $message to $email";
        return true;
    }
}