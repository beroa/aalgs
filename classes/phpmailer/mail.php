<?php
include('phpmailer.php');
// include('../../functions.php');
class Mail extends PhpMailer
{

    // Set default variables for all new objects
    // public $From     = 'alansalgs@gmail.com';
    // public $FromName = DIR;
    // public $Mailer   = 'smtp';
    // public $Host     = 'smtp.gmail.com';
    // public $SMTPAuth = true;
    // public $Username = 'alansalgs@gmail.com';
    // public $Password = 'nopassword1!';
    // public $SMTPSecure = 'ssl';
    // public $WordWrap = 75;
    // public $SMTPDebug = 2;
    // public $Port = 465;

    public $FromName = DIR;
    public $Mailer   = 'smtp';
    public $SMTPAuth = true;
    public $SMTPSecure = 'tls';
    public $Port = 587;
    public $WordWrap = 75;
    public $SMTPDebug = 2;

    public $From;
    public $Username;
    public $Password;
    public $Host;

    function __construct() {
        $this->From = getenv('EMAIL_USER');
        $this->Username = getenv('EMAIL_USER');
        $this->Password = getenv('EMAIL_PASS');
        $this->Host = getenv('EMAIL_HOST');
    }

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
