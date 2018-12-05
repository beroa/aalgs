<?php
// aalgs.php - Landing Page for the aalgs Website - Session Handling
// Written by:  Charles Kaplan, November 2018

// Start Session, Set session variables, Functions
	$pfx = 'aalgs'; 
	include($pfx . "_variables.php");
	include($pfx . "_session.php");
	include($pfx . "_functions.php");
  
// Variables
	$online 	= TRUE;						// Set to FALSE to bring website down
	$landing 	= TRUE;						// Set variable for page authentication
  
// Get Input
	if (isset($_GET['p']))		$p = $_GET['p'];	else $p = 'home'; 
	$page = $pfx . '_' . $p . '.php';
	if (!file_exists($page))	$page = $pfx . "_home.php"; 
//	if (isset($_SESSION[$page])) $_SESSION[$page]++;  else $_SESSION[$page] = 1; 
	if (!$online)				$page = $pfx . "_offline.php";

// Output Page
	include("layout/header.php"); 			// Page Header 
	include("layout/navbar.php");			// Navigation Bar
	include($page);							// Page Content
	include("layout/footer.php");			// Page Footer
?>