<?php
// aalgs_mysqli.php - Logon to MySQli and connect to the BCS350 database
// Written by: Charles Kaplan, November 2018

// Connect to MySQLi and the personal Database
$mysqli = mysqli_connect(getenv('DBHOST'), getenv('DBUSER'), getenv('DBPASS'), getenv('DBNAME'));
if (mysqli_connect_error()) die('Connect Error: ' . mysqli_connect_error());	

function insertUserAlg($userID, $caseID, $moves, $setID, $mysqli) {
	$sql = "DELETE from user_alg where caseID = $caseID and userID = $userID";
	if ($mysqli->query($sql) === TRUE) {
    	echo "Old record deleted successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $mysqli->error;
	}

	$sql = "INSERT into user_alg (userID, caseID, moves, setID) VALUES ('$userID', '$caseID', \"$moves\", '$setID');";
	if ($mysqli->query($sql) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $mysqli->error;
	}
}

function getUserAlgBySetID($userID, $setID, $mysqli) {
	// require("mysqli.php");
	// echo "<div class='d-flex flex-wrap justify-content-center'>";
	$sql = "SELECT * from user_alg where userID = $userID and setID = $setID order by caseID";
	$result = mysqli_query($mysqli, $sql);
	if (!$result) echo "Query Error [$sql] " . $mysqli->error;
	else {	return $result; }
}

function getAlgcaseBySetID($setID, $mysqli) {
	$sql = "SELECT * from algcase where setID = $setID order by caseID";
	$result = mysqli_query($mysqli, $sql);
	if (!$result) echo "Query Error [$sql] " . $mysqli->error;
	else { return $result; }
}

function getAlgorithmByCaseID($caseID, $mysqli) {
	$sql = "SELECT * from algorithm where caseID = $caseID order by caseID";
	$result = mysqli_query($mysqli, $sql);
	if (!$result) echo "Query Error [$sql] " . $mysqli->error;
	else { return $result; }
}

function getAllFromAlgset($mysqli) {
	$sql = "SELECT * from algset";
	$result = mysqli_query($mysqli, $sql);
	if (!$result) echo "Query Error [$sql] " . $mysqli->error;
	else { return $result; }
}

?>