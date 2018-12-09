<?php
	require('layout/header.php'); 
	require('layout/navbar.php'); 
	// require_once('includes/config.php');

	require('mysqli.php'); 
	
	// determine setid from name
	if(isset($_GET['name'])){
		$name = $_GET['name'];
		echo "<h1 id='setname'>$name</h1>";
		$query = "SELECT * from algset where name = '$name'";
		$sets = mysqli_query($mysqli, $query) or die (mysqli_error($mysqli)); 
		while($set = $sets->fetch_array()) {
			$setid = $set['id'];
  		}
	} else $setid = 0;

	echo "<table align='center'>";
	$query = "SELECT * from algcase where setid = $setid";
	$algcases = mysqli_query($mysqli, $query);
	if (!$algcases) $msg = "Query Error [$query] " . mysqli_error();
	else {
		while($case = $algcases->fetch_array()) {
			echo "<tr>";
			$name = $case['name'];
			echo "<td width='15%' align='center' style='font-size=30px;'>$name</td>";
			$pigcase = $case['pigcase'];
			echo "<td width='25%' align='center' ><img src=\"visualcube/visualcube.php?fmt=svg&view=plan&size=200&case=$pigcase&stage=cmll\" alt=\"Kiwi standing on oval\"></td>";
			$caseId = $case['id'];
			$query = "SELECT * from algorithm where caseid = $caseId";
			$algorithms = mysqli_query($mysqli, $query);
			if (!$algorithms) $msg = "Query Error [$query] " . mysqli_error();
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
	$mysqli->close();

	require('layout/footer.php'); 
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12 col-xl-8 offset-xl-2 text-center">
			<h1>This is the homepage.</h1><br>
			<h2>Choose an Algset</h2>
			<div class="d-flex flex-wrap justify-content-center">
				<?php 
					// get set names from db and put in table
					include('mysqli.php'); 
					$query = "SELECT * from algset";
					$algorithms = mysqli_query($mysqli, $query);
					if (!$algorithms) echo "Query Error [$query] " . mysqli_error();
					else {
						while($res = $algorithms->fetch_array()) {
							$name = $res['name'];
							echo "<div class='p-2' style='border: 1px solid black;'><a href='set?name=$name'>$name</a></div>";
				  		}
					}
				?>
			</div>
		</div>
	</div>
</div>

