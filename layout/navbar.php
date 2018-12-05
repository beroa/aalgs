<?php
// aalgs_navbar.php - Navigation Bar
// Written by: Charles Kaplan, November 2018

include("./aalgs_variables.php");

// Variables
	$td_width	= floor($width/count($pages)); 

// Output	
	echo "<style type='text/css'>
		  A:link 	{COLOR:black; TEXT-DECORATION:none; font-weight:bold;}
		  A:visited {COLOR:black; TEXT-DECORATION:none; font-weight:bold;}
		  A:active  {COLOR:black; TEXT-DECORATION:none;}
		  A:hover   {COLOR:blue;  TEXT-DECORATION:none; font-weight:bold}
		  </style>
		  <table width='$width' align='center' style='$nav_style' rules='all'>\n
		  <tr>";
		  
	foreach($pages as $pagex) {
		if (($pagex == 'logon') AND ($logon))	$pagex = 'logoff';		// If Logon Page and Logged On, Make it the Logoff Page
		
// Check conditions to show page as an active link or not		
		$active = TRUE;
		if (!$online)		$active = FALSE;
		if ($p == $pagex)	$active = FALSE;
		if (in_array($pagex, $restricted) AND (!$logon)) $active = FALSE;
		if (in_array($pagex, $role_reqrd) AND ($role != $role_name)) $active = FALSE;
		
// Output		
		if ($active) echo "<td width='$td_width' align='center'><a href='$pgm?p=$pagex'>$pagex</a></td>\n";
		else{
			if ($p == $pagex) $color = 'blue'; else $color = 'red';
			echo "<td width='$td_width' align='center' style='color:$color;'>$pagex</td>";
			}
		}
		
	echo '</tr></table>';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<div id="navbar-main">

				<ul class="nav navbar-nav">
					<li class="nav-item"><a href="aalgs.php">Home</a></li>
					<li class="nav-item"><a href="aalgs.php?p=page">CMLL</a></li>
					 <li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          Dropdown link
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				          <a class="dropdown-item" href="#">Action</a><br>
				          <a class="dropdown-item" href="#">Another action</a><br>
				          <a class="dropdown-item" href="#">Something else here</a>
				        </div>
				    </li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li *ngIf="!auth.isLoggedIn()"><a routerLink="/register">Register</a></li>
					<li *ngIf="!auth.isLoggedIn()"><a href="login.php">Log In</a></li>
					<li *ngIf="auth.isLoggedIn()"><a routerLink="/profile">My Profile</a></li>
					<li *ngIf="auth.isLoggedIn()"><a routerLink="/" (click)="auth.logout()">Logout</a></li>
				</ul>
				
			</div>
		</div>
	</div>
</nav>