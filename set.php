<?php
require('layout/header.php'); 
require('layout/navbar.php'); 

// require('functions.php');
// require('mysqli.php');
require_once('includes/config.php');

// determine setid from name
if(isset($_GET['name'])){
	$name = $_GET['name'];
	$query = "SELECT * from algset where name = '$name'";

	$sets = mysqli_query($mysqli, $query) or die (mysqli_error($mysqli));
	while($set = $sets->fetch_array()) {
		$setid = $set['id'];
		$pigstage = $set['pigstage'];
		$pigview = $set['pigview'];
		if ($pigview == 'trans') $pigview = '';
  	}
} else $setid = 0;

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
	$i = 0;
	while($case = $algcases->fetch_array()) {
		$i++;
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
				<button type='button' class='btn btn-info dropdown-toggle algbtn$caseid' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='width:90px;white-space:normal;text-align:left;'>$moves</button>
				<div class='dropdown-menu'>";
			}					
			echo "<a class='dropdown-item' href=\"saveAlg?caseid=$caseid&setid=$setid&setname=$setname&moves=$moves\">$moves</a>";
		} echo "</div></div>";
		echo "</div>";
	}
	echo "</div>";
}
?>

<div class="container">
	<div class="row">
		<div class="col-12 text-center no-padding">
			<?php
				if( !$user->isLoggedIn() ) { 
						echo 
						"<div class='alert alert-info py-0 my-0' role='alert'>
							If you log in, you can show only your preferred algorithms.
						</div> ";
						showAlgsFlex($name, $setid, $pigstage, $pigview, 0);
				} else {
					showAlgsDropdown($name, $setid, $pigstage, $pigview, 1, $mysqli);
				}
			?>
		</div>
	</div>
</div>

<?php
	require('layout/footer.php'); 
?>