<?php
// aalgs_page2.php - Page 2
// Written by: Charles Kaplan, November 2018

// Check Landing Variable is Set
	include('aalgs_landing.php');
	
	include('aalgs_mysqli.php'); 
	$query = "SELECT * from algcase where setid = 1";
	$result = mysqli_query($mysqli, $query);
	if (!$result) $msg = "Query Error [$query] " . mysqli_error();
	else {
		while($row = $result->fetch_array()) {
			echo $row['name'] . " " . $row['pigcase'];
			echo 
			echo "<br />";
  		}
	}

// Output	
	echo "<table width='$width' align='center'>\n
		  <tr><td align='center' style='$page_style'>
		  <br>This is Page 2<br><br>
		  <table>
		  </table>
		  <font color='green'>This is a Public Page</font><br><br>
		  </td></tr>\n
		  </table>";

?>