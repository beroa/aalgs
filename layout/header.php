<!-- <?php
// aalgs_header.php - Page Header
// Written by: Charles Kaplan, November 2018
// include("./aalgs_variables.php");

// Page Header
	// echo "<table width='$width' align='center' cellpadding='0' cellspacing='0' style='border:1px solid black;'>\n
	// 	  <tr><td align='center' style='$hdr_style'>$title</td></tr>\n
	// 	  <tr><td align='center' style='$hdr_style2'><br>Hello, $name [$role]<br><br></td></tr>\n
	// 	  </table>";
		  
//		  <tr><td align='left'   style='$hdr_style3'>$page has been visited " . $_SESSION[$page] . " times</td></td> 		  
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php if(isset($title)){ echo $title; }?></title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
header