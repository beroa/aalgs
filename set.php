<?php
require('layout/header.php'); 
require('layout/navbar.php'); 

// require('functions.php');
// require('mysqli.php');
require_once('includes/config.php');

// determine setID from name
if(isset($_GET['name'])){
	$name = $_GET['name'];
	$query = "SELECT * from algset where name = '$name'";

	$sets = mysqli_query($mysqli, $query) or die (mysqli_error($mysqli));
	while($set = $sets->fetch_array()) {
		$setID = $set['setID'];
		$pigstage = $set['pigstage'];
		$pigview = $set['pigview'];
		if ($pigview == 'trans') $pigview = '';
  	}
} else $setID = 0;

// runs queries and shows algs in flexbox format
function showAlgsFlex($name, $setID, $pigstage, $pigview, $login) {
	echo "<h1 class=text-center>$name
	</h1>";
	echo "<div class='d-flex flex-wrap justify-content-center'>";
	$query = "SELECT * from algcase where setID = $setID";
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
			$caseID = $case['ID'];
			$query = "SELECT * from algorithm where caseID = $caseID order by caseID";
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

function showAlgsDropdown($setname, $setID, $pigstage, $pigview, $login, $mysqli) {
	echo "<h1 class=text-center>$setname</h1>";
	echo "<div class='d-flex flex-wrap justify-content-center'>";
	$algcases = getAlgcaseBySetID($setID, $mysqli);
	$i = 0;
	while($case = $algcases->fetch_array()) {
		$i++;
		$name = $case['name'];
		$pigcase = $case['pigcase'];
		$caseID = $case['caseID'];

		$imgsrc = "visualcube/visualcube.php?fmt=svg&size=128&case=$pigcase&stage=$pigstage";
		if ($pigview != "") $imgsrc = $imgsrc . "&view=$pigview";

		echo "<div class='p-2 text-center flex-item'>";
		echo "<h2 style='font-size:1.2em;line-height:.8;'>$name</h2>";
		echo "<img src=\"$imgsrc\" alt='$name image' class='m-0'>";

		$algorithm = getAlgorithmByCaseID($caseID, $mysqli);
		$first = true;
		while($alg = $algorithm->fetch_array()) {
			$moves = $alg['moves'];
			if ($first) { $first = false;
				echo "
				<div class='btn-group'>
				<button type='button' class='btn btn-info dropdown-toggle algbtn$caseID' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='wIDth:90px;white-space:normal;text-align:left;'>$moves</button>
				<div class='dropdown-menu'>";
			}					
			echo "<a class='dropdown-item' href=\"saveAlg?caseID=$caseID&setID=$setID&setname=$setname&moves=$moves\">$moves</a>";
		} echo "</div></div>";
		echo "</div>";
	}
	echo "</div>";
}

function getUserAlgs($userID, $setID, $mysqli) {
	$useralgs = getUserAlgBySetID($userID, $setID, $mysqli);
	while ($ua = $useralgs->fetch_array()) {
		$moves = $ua['moves'];
		echo $moves;
	}
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
						showAlgsFlex($name, $setID, $pigstage, $pigview, 0);
				} else {
					$userID = $user->getuserID();
					getUserAlgs($userID, $setID, $mysqli);
					$userID = "";
					showAlgsDropdown($name, $setID, $pigstage, $pigview, 1, $mysqli);
				}
			?>
		</div>
	</div>
</div>

<?php
	require('layout/footer.php'); 
?>