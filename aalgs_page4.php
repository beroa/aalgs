<?php
// aalgs_page2.php - Page 4
// Written by: Charles Kaplan, November 2018

// Check Landing Variable is Set
	include('aalgs_landing.php');
	
// Check for Logon Access
	if (!$logon) include($pfx . '_homepage.php');	
	
// Output
	echo "<table width='$width' align='center' style='$page_style'>\n
		  <tr><td align='center'>
		  <br>This is Page 4<br><br>
		  <font color='red'>This is a Restricted Page</font><br><br>
		  </td></tr>\n
		  </table>";

?>