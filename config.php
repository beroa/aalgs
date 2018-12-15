<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('America/New_York');

// set composer and autoload
require __DIR__ . '\vendor\autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

//database credentials
define('DBHOST',getenv('DBHOST'));
define('DBUSER',getenv('DBUSER'));
define('DBPASS',getenv('DBPASS'));
define('DBNAME',getenv('DBNAME'));

//application address
define('DIR',getenv('DIR'));
define('SITEEMAIL',getenv('SITEEMAIL'));
define('SITEPASS',getenv('SITEPASS'));

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);
?>
