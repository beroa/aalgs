<?php
// aalgs_page2.php - Page 2
// Written by: Charles Kaplan, November 2018
	require('layout/header.php'); 
	require('layout/navbar.php'); 

	include('mysqli.php'); 
	echo "<table align='center'>";
	$query = "SELECT * from algcase where setid = 1";
	$algcases = mysqli_query($mysqli, $query);
	if (!$algcases) $msg = "Query Error [$query] " . mysqli_error();
	else {
		while($row = $algcases->fetch_array()) {
			echo "<tr>";
			$name = $row['name'];
			echo "<td width='15%' align='center' style='font-size=30px;'>$name</td>";
			$pigcase = $row['pigcase'];
			echo "<td width='25%' align='center' ><img src=\"visualcube/visualcube.php?fmt=svg&view=plan&size=200&case=$pigcase&stage=cmll\" alt=\"Kiwi standing on oval\"></td>";
			$caseId = $row['id'];
			$query = "SELECT * from algorithm where caseid = $caseId";
			$algorithms = mysqli_query($mysqli, $query);
			if (!$algorithms) $msg = "Query Error [$query] " . mysqli_error();
			else {
				echo "<td width='60%' align=left><ul style='display:inline-block;text-align:left;'>";
				while($alg = $algorithms->fetch_array()) {
					$moves = $alg['moves'];
					echo "<li>$moves</li>";
		  		}
		  		echo "</ul></td>";
			}
  		}
	}
	echo "</table>";
	$mysqli->close();

	require('layout/footer.php'); 
?>