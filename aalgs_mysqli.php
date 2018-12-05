<?php
// aalgs_mysqli.php - Logon to MySQli and connect to the BCS350 database
// Written by: Charles Kaplan, November 2018

// Connect to MySQLi and the personal Database
	$mysqli = mysqli_connect('localhost', 'root', NULL, 'a');
	if (mysqli_connect_error()) die('Connect Error: ' . mysqli_connect_error());	
?>   