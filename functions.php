<?php
require_once('mysqli.php');

// gets an rss feed and displays it as a table
function getFeed($feed_url) {
    $content = file_get_contents($feed_url);
    $x = new SimpleXmlElement($content);
     
    echo "<table id='rss_wca_table' align='center'>";
   
    foreach($x->channel->item as $entry) {
    	$date = new DateTime($entry->pubDate);
    	$date_form = $date->format("Y-m-d");
        echo "<tr><td nowrap valign='top' class='cellpadding'>$date_form</td> <td><a href='entry->link' title='$entry->title'>" . $entry->description . "</a></td>";
    }
    echo "</table>";
}

// runs queries and shows algs in table format
function showAlgs($setid) {
	require("mysqli.php"); 
	echo "<table align='center'>";
	$query = "SELECT * from algcase where setid = $setid";
	$algcases = mysqli_query($mysqli, $query);
	if (!$algcases) echo "Query Error [$query] " . mysqli_error();
	else {
		while($case = $algcases->fetch_array()) {
			echo "<tr>";
			$name = $case['name'];
			echo "<td width='15%' align='center' style='font-size=30px;'>$name</td>";
			$pigcase = $case['pigcase'];
			echo "<td width='25%' align='center' ><img src=\"visualcube/visualcube.php?fmt=svg&view=plan&size=200&case=$pigcase&stage=cmll\" alt=\"Kiwi standing on oval\"></td>";
			$caseid = $case['id'];
			$query = "SELECT * from algorithm where caseid = $caseid";
			$algorithms = mysqli_query($mysqli, $query);
			if (!$algorithms) echo "Query Error [$query] " . mysqli_error();
			else {
				echo "<td width='60%' align=left><ul style='display:inline-block;text-align:left;'>";
				while($alg = $algorithms->fetch_array()) {
					$moves = $alg['moves'];
					echo "<li>$moves</li>";
		  		}
		  		echo "</ul></td>";
			}
		}
	}
	echo "</table>";
}

// runs queries and shows algs in flexbox format
function showAlgsFlex($name, $setid, $pigstage, $pigview, $login) {
	echo "<h1 class=text-center>$name
	</h1>";
	echo "<div class='d-flex flex-wrap justify-content-center'>";
	$query = "SELECT * from algcase where setid = $setid";
	$algcases = mysqli_query($mysqli, $query);
	if (!$algcases) echo "Query Error [$query] " . mysqli_error();
	else {
		while($case = $algcases->fetch_array()) {
			echo "<div class='p-2 text-center flex-item'>";
			$name = $case['name'];
			echo "<h2>$name</h2>";
			$pigcase = $case['pigcase'];

			$imgsrc = "visualcube/visualcube.php?fmt=svg&size=128&case=$pigcase&stage=$pigstage";
			if ($pigview != "") $imgsrc = $imgsrc . " .&view=$pigview";
			echo "<img src=\"$imgsrc\" alt='$name image'>";
			$caseid = $case['id'];
			$query = "SELECT * from algorithm where caseid = $caseid order by caseid";
			$algorithms = mysqli_query($mysqli, $query);
			if (!$algorithms) echo "Query Error [$query] " . mysqli_error();
			else {
				echo "<br><ul class='simple-list'>";
				while($alg = $algorithms->fetch_array()) {
					$moves = $alg['moves'];
					echo "<li>$moves</li>";
		  		}
		  		echo "</ul>";
			}
			echo "</div>";
		}
	}
	echo "</div>";
}

function showAlgsDropdown($setname, $setid, $pigstage, $pigview, $login, $mysqli) {
	echo "<h1 class=text-center>$setname</h1>";
	echo "<div class='d-flex flex-wrap justify-content-center'>";
	$algcases = getAlgcaseBySetid($setid, $mysqli);
	while($case = $algcases->fetch_array()) {
		$name = $case['name'];
		$pigcase = $case['pigcase'];
		$caseid = $case['id'];

		$imgsrc = "visualcube/visualcube.php?fmt=svg&size=128&case=$pigcase&stage=$pigstage";
		if ($pigview != "") $imgsrc = $imgsrc . "&view=$pigview";

		echo "<div class='p-2 text-center flex-item'>";
		echo "<h2 style='font-size:1.2em;line-height:.8;'>$name</h2>";
		echo "<img src=\"$imgsrc\" alt='$name image' class='m-0'>";

		$algorithm = getAlgorithmByCaseid($caseid, $mysqli);
		$first = true;
		while($alg = $algorithm->fetch_array()) {
			$moves = $alg['moves'];
			if ($first) { $first = false;
				echo "
				<div class='btn-group'>
				<button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='width:120px;white-space:normal;text-align:left;'>$moves</button>
				<div class='dropdown-menu'>";
			}					
			echo "<a class='dropdown-item' href=\"saveAlg?caseid=$caseid&setid=$setid&setname=$setname&moves=$moves\">$moves</a>";
		} echo "</div></div>";
		echo "</div>";
	}
	echo "</div>";
}

// cleanse_input - sanitize input and reformat 
	function cleanse_input($phrase, $format) {
		$phrase = filter_var($phrase, FILTER_SANITIZE_STRING);
		$format = trim($format);
		$format_length = strlen($format);
	
		for ($i=0; $i<$format_length; $i++) {
			$letter = substr($format, $i, 1);
		
			switch($letter) {
				case 'a':	$phrase = preg_replace("/[^a-zA-Z ]+/", '', $phrase); break;// Remove any non-alphabetic characters
				case 'e':	$phrase = ltrim($phrase);		break;						// Left Trim
				case 'f':	$phrase = ucfirst($phrase);		break;						// Capitolize First Word
				case 'i':	$phrase = preg_replace("/\s+/", ' ', $phrase);	break;		// Internal Trim
				case 'l':	$phrase = strtolower($phrase);	break;						// Lower Case
				case 'n':	$phrase = preg_replace("/[^0-9.]+/", '', $phrase); break;	// Remove any non-numeric characters
				case 'r':	$phrase = rtrim($phrase);		break;						// Right Trim
				case 's':	$phrase = strip_tags($phrase);	break;						// Remove HTML
				case 't':	$phrase = trim($phrase);		break;						// Trim
				case 'u':	$phrase = strtoupper($phrase);	break;						// Upper Case
				case 'w':	$phrase = ucwords($phrase);		break;						// Capitolize Words
				default:
				}
			}
			
		return($phrase);
		}
?>