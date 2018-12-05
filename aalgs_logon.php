<?PHP
// aalgs_logon.php - Logon to aalgs Website
// Written by:  Charles Kaplan, November 2018
  
// Variables  
	$msg 		= NULL;								// Error Message
	$td 		= "width='20%' align='right'";		// Attributes for 1st column
	$tf 		= "width='80%' align='left'";		// Attributes for 2nd column
  
// Get Form Input  
	if(isset($_POST['logon'])) {
		$userid 	= trim($_POST['userid']);
		$pword 		= trim($_POST['password']);
		
// Cleanse and Verify Input
		$userid = cleanse_input($userid, 'st');
		$pword = cleanse_input($pword, 'st');
		if ($userid == NULL) 	$msg = "USERID is missing";
		if ($pword == NULL) 	$msg = "PASSWORD is missing";
		if (($userid == NULL) AND ($pword == NULL)) $msg = "USERID & PASSWORD are missing";
		
// LOGON		
		if ($msg == NULL) {
			include('aalgs_mysqli.php');
			$query = "SELECT firstname, lastname, password, status, role FROM roster WHERE userid='$userid'";
			$result = mysqli_query($mysqli, $query);
			if (!$result) $msg = "Query Error [$query] " . mysqli_error();
			if (mysqli_num_rows($result) > 0) {
				list($firstname, $lastname, $password, $status, $role) = mysqli_fetch_row($result);
				if ($pword == $password)
					if ($status) {
						$_SESSION['userid'] 	= $userid;
						$_SESSION['name'] 		= $name = "$firstname $lastname";
						$_SESSION['role'] 		= $role;
						$logon = TRUE;
						$_SESSION['msg'] = "<font color='green'><b>$name Logon Successful</b></font>";
						include($pfx . '_homepage.php');						
						}
					else $msg = "Your LOGON ID is inactive";
				else $msg = "Invalid Password";
				}
			else $msg = "USERID is invalid";
			}
		}
  
// Logon Screen
	if ($msg == NULL)  	$msg = "Enter User ID and Password";
	else if ($logon == FALSE) $msg = "<font color='red'>$msg, please try again</font>";  
	echo "<table width='$width' align='center' style='$page_style'>\n
		  <form action='$pgm?p=logon' enctype='multipart/form-data' method='post'>\n
		  <tr><td $td>&nbsp;</td><td $td>&nbsp;</td></tr>
		  <tr><td $td>&nbsp;</td><td $tf><b>aalgs Logon</b></td></tr>\n
		  <tr><td $td>&nbsp;</td><td $td>&nbsp;</td></tr>
		  <tr><td $td>User ID</td>	<td $tf><input type='text' name='userid' size='60' maxlength='80' value=''></td></tr>\n
		  <tr><td $td>Password</td>	<td $tf><input type='password' name='password' size='12' maxlength='12' value=''></td></tr>\n
		  <tr><td $td>&nbsp;</td>		<td $tf>&nbsp;</td></tr>\n
		  <tr><td $td>&nbsp;</td>		<td $tf><input type='submit' name='logon' value='LOGON' style='background-color:lightgreen;font-weight:bold'></td></tr>\n
		  <tr><td $td>&nbsp;</td>		<td $tf>&nbsp;</td></tr>\n
		  <tr><td $td>Message</td>	<td $tf><b>$msg<b></td></tr>\n
		  <tr><td>&nbsp;</td></tr>\n
		  </form>\n
		  </table>\n";
?>