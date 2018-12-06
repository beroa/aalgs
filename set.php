<?php
	require('layout/header.php'); 
	require('layout/navbar.php'); 
	// require_once('includes/config.php');

	require('mysqli.php'); 
	
	// determine setid from name
	if(isset($_GET['name'])){
		$name = $_GET['name'];
		echo "<h1 id='setname'>$name</h1>";
		$query = "SELECT * from algset where name = '$name'";
		$result = mysqli_query($mysqli, $query) or die (mysqli_error($mysqli)); 
		while($res = $result->fetch_array()) {
			$setid = $res['id'];
  		}
	} else $setid = 0;

	echo "<table align='center'>";
	$query = "SELECT * from algcase where setid = $setid";
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
			$result = mysqli_query($mysqli, $query);
			if (!$result) $msg = "Query Error [$query] " . mysqli_error();
			else {
				echo "<td width='60%' align=left><ul style='display:inline-block;text-align:left;'>";
				while($alg = $result->fetch_array()) {
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