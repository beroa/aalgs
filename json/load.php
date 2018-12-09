<?php

// customize these
$setname = 'F2L';
$setid = 4;
//

$filename = $setname . ".txt";

$conn = new mysqli("localhost", "root", "", "a");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$json_data = file_get_contents($filename);
$json = json_decode($json_data, false);

$first = true;
for ($i = 0; $i < count($json); $i++) {
	$name = $json[$i]->name;
	$pigcase = $json[$i]->pigCase;
	$pigcase = str_replace("'", "''", $pigcase);
	
	if ($first) {
		$pigstage = $json[$i]->pigStage;
		$pigview = $json[$i]->pigView;;
		$sql = "INSERT INTO algset (id, name, pigcase, pigstage, pigview) VALUES ('$setid', '$setname', '$pigcase', '$pigstage', '$pigview');";
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
	    	echo "New record created successfully";
		} else {
	    	echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$first = false;
	}

	$sql = "INSERT INTO algcase (setid, name, pigcase) VALUES ('$setid', '$name', '$pigcase');";
	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	echo '<br>';

	$algs = count($json[$i]->caseAlgs);
	for ($j = 0; $j < $algs; $j++) {
		$moves = $json[$i]->caseAlgs[$j]->moves;
		$moves = str_replace("'", "''", $moves);
		
		$sql = "INSERT INTO algorithm (caseid, moves) VALUES ('$last_id', '$moves');";
		if ($conn->query($sql) === TRUE) {
    		echo "New record created successfully";
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}

$conn->close();
?>