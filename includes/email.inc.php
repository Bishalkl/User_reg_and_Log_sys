<?php

// create class for email
class Email {
    // Properties
    private $username;
    private $email;
    private $message;

    // constructor
    public function __construct($username, $email, $message)
    {  
        $this->username = $username;
        $this->email = $email;
        $this->message = $message; 
    }

    // method for send email
    public function emailSend() {
        // Sender and recipient
        $to = $this->email;
        $subject = "Test Email";
        $message = "This is a test email send from PHP.";
        $headers = "From: bishalkoirala869@gmail.com\r\n";
        $headers .= "Reply-To: bishalkoirala869@gmail.com\r\n";
        $headers .= "Content-Type:  text/plain; charset=UTF-8\r\n";

        //send email;
        if(mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email.";
        }
    }
}