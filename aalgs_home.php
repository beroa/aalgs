<?php
// aalgs_home.php - Home Page
// Written by: Charles Kaplan, November 2018

// Check Landing Variable is Set
	include('aalgs_landing.php');
	
// Capture Message	
	if (isset($_SESSION['msg'])) {
		$msg = $_SESSION['msg'] . '<br><br>'; 	
		unset($_SESSION['msg']); 
		}
		else $msg = NULL;
	
// Output	
	echo "<table width='$width' align='center' style='$page_style;'>\n
		  <tr><td align='center'>
		  <br>This is the Home Page<br><br>
		  <table style='font-size:2em'>
		  <tr>
		  <td style='border:1px solid black;'>CMLL</td>
		  <td style='border:1px solid black;'>PLL</td>
		  </table>
		  </td></tr>\n
		  </table>";

?>