<?php require('includes/config.php');
require('mysqli.php');

if (isset($_GET['caseID'])) { $caseID = $_GET['caseID']; }
if (isset($_GET['moves'])) { $moves = $_GET['moves']; }
if (isset($_GET['setID'])) { $setID = $_GET['setID']; }
if (isset($_GET['setname'])) { $rtrnaddr = 'set?name=' . $_GET['setname']; }


if ($user->isLoggedIn()) {
	$userID = $user->getUserID();
	insertUserAlg($userID, $caseID, $moves, $setID, $mysqli);
}

//logged in return to index page
header("Location: $rtrnaddr");
exit;
?>