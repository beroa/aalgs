<?php
// aalgs_mysqli.php - Logon to MySQli and connect to the BCS350 database
// Written by: Charles Kaplan, November 2018

// Connect to MySQLi and the personal Database
$mysqli = mysqli_connect('localhost', 'root', NULL, 'a');
if (mysqli_connect_error()) die('Connect Error: ' . mysqli_connect_error());	

function insertUserAlg($userid, $caseid, $moves, $setid, $mysqli) {
	$sql = "delete from user_alg where caseid = $caseid";
	if ($mysqli->query($sql) === TRUE) {
    	echo "Old record deleted successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $mysqli->error;
	}

	$sql = "insert into user_alg (memberid, caseid, moves, setid) VALUES ('$userid', '$caseid', \"$moves\", '$setid');";
	if ($mysqli->query($sql) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $mysqli->error;
	}
}

function getUserAlgBySetid($userid, $setid) {
	require("mysqli.php");
	// echo "<div class='d-flex flex-wrap justify-content-center'>";
	$query = "SELECT * from user_alg where userid = $userid and setid = $setid";
	$result = mysqli_query($mysqli, $query);
	if (!$result) echo "Query Error [$query] " . mysqli_error();
	else {	return $result; }
}

function getAlgcaseBySetid($setid, $mysqli) {
	$query = "SELECT * from algcase where setid = $setid";
	$result = mysqli_query($mysqli, $query);
	if (!$result) echo "Query Error [$query] " . mysqli_error();
	else { return $result; }
}

function getAlgorithmByCaseid($caseid, $mysqli) {
	$query = "SELECT * from algorithm where caseid = $caseid order by caseid";
	$result = mysqli_query($mysqli, $query);
	if (!$result) echo "Query Error [$query] " . mysqli_error();
	else { return $result; }
}

function getAllFromAlgset($mysqli) {
	$query = "SELECT * from algset";
	$result = mysqli_query($mysqli, $query);
	if (!$result) echo "Query Error [$query] " . mysqli_error();
	else { return $result; }
}

?>