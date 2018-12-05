<?php
// aalgs_session.php - Check for Logon and Load Session Variables
// Written by:  Charles Kaplan, November 2018

	session_start();
  
	if (isset($_SESSION['userid'])) {
		$logon 		= TRUE;
		$name	 	= $_SESSION['name'];
		$userid 	= $_SESSION['userid'];
		$role		= $_SESSION['role'];
		}
	
	else {
		$logon 		= FALSE;
		$name		= 'Guest'; 
		$userid 	= NULL; 
		$role 		= 'Public';  		
		}
?>