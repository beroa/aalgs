<?php
include('phpmailer.php');
// include('../../functions.php');
class Mail extends PhpMailer
{

    // Set default variables for all new objects
    public $FromName = DIR;
    public $Mailer   = 'smtp';
    public $Host     = 'server120.web-hosting.com';
    public $SMTPAuth = true;
    public $SMTPSecure = 'tls';
    public $WordWrap = 75;
    public $SMTPDebug = 2;
    public $Port = 587;

    public $From;
    public $Username;
    public $Password;

    function __construct() {
        $this->From = getenv('SITEEMAIL');
        $this->Username = getenv('SITEEMAIL');
        $this->Password = getenv('SITEPASS');
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
