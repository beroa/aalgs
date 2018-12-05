<?PHP
// aalgs_logoff.php - Logoff
// Written by:  Charles Kaplan, NOvember 2018

// Logoff by unsetting session variables  
	if ($logon) {
		$tempname = $name; 
		session_unset();
		$logon = FALSE;
		}
 
// LOGOFF SCREEN
	$_SESSION['msg'] = "<font color='green'><b>$tempname Logoff Successful</b></font>";
	include($pfx . '_homepage.php');
?>