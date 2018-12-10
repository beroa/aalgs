<?php require('includes/config.php');
require('mysqli.php');

if (isset($_GET['caseid'])) { $caseid = $_GET['caseid']; }
if (isset($_GET['moves'])) { $moves = $_GET['moves']; }
if (isset($_GET['setid'])) { $setid = $_GET['setid']; }
if (isset($_GET['setname'])) { $rtrnaddr = 'set?name=' . $_GET['setname']; }


//logout
if ($user->isLoggedIn()) {
	$userid = $user->getuserId();
	insertUserAlg($userid, $caseid, $moves, $setid, $mysqli);
}

//logged in return to index page
header("Location: $rtrnaddr");
exit;
?>