<?php
include('phpmailer.php');
// include('../../functions.php');
class Mail extends PhpMailer
{

    // Set default variables for all new objects
    public $From     = 'alansalgs@gmail.com';
    public $FromName = DIR;
    public $Mailer   = 'smtp';
    public $Host     = 'smtp.gmail.com';
    public $SMTPAuth = true;
    public $Username = 'alansalgs@gmail.com';
    public $Password = 'nopassword;';
    public $SMTPSecure = 'ssl';
    public $WordWrap = 75;
    public $SMTPDebug = 2;
    public $Port = 465;

    public function subject($subject)
    {
        $this->Subject = $subject;
    }

    public function body($body)
    {
        $this->Body = $body;
    }

    public function send()
    {
        $this->AltBody = strip_tags(stripslashes($this->Body))."\n\n";
        $this->AltBody = str_replace("&nbsp;", "\n\n", $this->AltBody);
        return parent::send();

    }
}
