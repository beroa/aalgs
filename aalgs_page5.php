<?php
// aalgs_page2.php - Page 5
// Written by: Charles Kaplan, November 2018

// Check Landing Variable is Set
	require('aalgs_landing.php');
	
// Check for Logon Access
	if ((!$logon) OR ($role != $role_name)) include($pfx . '_homepage.php');
	
// Output
	echo "<table width='$width' align='center' style='$page_style'>\n
		  <tr><td align='center'>
		  <br>This is Page 5<br><br>
		  <font color='red'>This is a Restricted Page<br>$role_name Access Only</font><br><br>
		  </td></tr>\n
		  </table>";
?>