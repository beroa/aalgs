<?php
	
// // Capture Message	
// 	if (isset($_SESSION['msg'])) {
// 		$msg = $_SESSION['msg'] . '<br><br>'; 	
// 		unset($_SESSION['msg']); 
// 		}
// 		else $msg = NULL;

?>

<table align='center'>
	<tr><td align='center'>
	<h1>This is the homepage.</h1>
	<br>
	<h2>Choose an Algset</h2>

	<table style='font-size:2em;'>
	<tr>
	<?php 
		// get set names from db and put in table
		include('mysqli.php'); 
		$query = "SELECT * from algset";
		$result = mysqli_query($mysqli, $query);
		if (!$result) echo "Query Error [$query] " . mysqli_error();
		else {
			while($res = $result->fetch_array()) {
				$name = $res['name'];
				echo "<td style='border: 1px solid black;padding:.5em'><a href='set?name=$name'>$name</a></td>";
	  		}
		}
	?>
	</table>

	</td></tr>
</table>