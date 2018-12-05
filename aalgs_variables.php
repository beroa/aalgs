<?php
// aalgs Common Variables and PHP Options
// Written by: Charles Kaplan, November 2018

// Set Default PHP Options
	date_default_timezone_set('America/New_York');

// Variables	
	$pgm		= $pfx . '.php'; 
	$width		= 1024;
	$title		= ''; 
	$hdr_style	= "color:blue;   background-color:yellow;    font-size:300%; font-style:italic; font-weight:bold; font-family:Arial,Helvetica;";
	$hdr_style2	= "color:green;  background-color:yellow;    font-size:100%; font-weight:bold; font-family:Arial,Helvetica;";
	$hdr_style3	= "color:black;  background-color:yellow;    font-size:75%;  font-weight:bold; font-family:Arial,Helvetica;";	
	$nav_style	= "color:blue;   background-color:#eecc22;    font-size:100%; font-weight:bold; font-family:Arial,Helvetica; border:1px solid black;";
	$ftr_style	= "color:yellow; background-color:blue;      font-size:75%;  font-weight:bold; font-family:Arial,Helvetica; border:1px solid black;";
	$page_style	= "color:black;  background-color:lightgray; font-size:150%; font-family:Verdana, Geneva, sans-serif; border:1px solid black;";
	$pages		= array('home', 'page', 'logon');
	$restricted = array('page4', 'page5');
	$role_reqrd	= array('page5');
	$role_name	= 'Faculty'; 
?>