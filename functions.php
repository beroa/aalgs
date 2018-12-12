<?php
require_once('mysqli.php');

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function debug_to_console_from_php( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "?><script>console.log( 'Debug Objects: " . $output . "' );</script><?php";
}

function showVisualCube($pigcase, $pigstage, $pigview) {
	$imgsrc = "visualcube/visualcube.php?fmt=svg&size=128&case=$pigcase&stage=$pigstage";
	if ($pigview != "") $imgsrc = $imgsrc . "&view=$pigview";
	echo "<img src=\"$imgsrc\" alt='$pigstage image' class='m-0'>";
}

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