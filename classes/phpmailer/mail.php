<?php
include('phpmailer.php');
// include('../../functions.php');
class Mail extends PhpMailer
{

    // Set default variables for all new objects
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
        $this->From = EMAIL_USER;
        $this->Username = EMAIL_USER;
        $this->Password = EMAIL_PASS;
        $this->Host = EMAIL_HOST;
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
