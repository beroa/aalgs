<?php
// aalgs_landing.php - Verify that program was called by aalgs.php, if not transfer to aalgs.php
// Written by: Charles Kaplan, November 2018

// $landing is SET in aalgs.php. if not set, then program was called directly
  if (!isset($landing) OR (in_array($p, $restricted) AND !$logon)) 
	include($pfx . '_homepage.php');
?>