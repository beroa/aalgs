<?php
require('layout/header.php'); 
require('layout/navbar.php');

require_once('includes/config.php');

// determine setID from name
if(isset($_GET['setname'])){
	$setname = $_GET['setname'];
	$query = "SELECT * from algset where name = '$setname'";

	$sets = mysqli_query($mysqli, $query) or die (mysqli_error($mysqli));
	while($set = $sets->fetch_array()) {
		$setID = $set['setID'];
		$pigstage = $set['pigstage'];
		$pigview = $set['pigview'];
		if ($pigview == 'trans') $pigview = '';
  	}
} else $setID = 0;

if(isset($_GET['y'])) $y = $_GET['y']; else $y = 0;

// runs queries and shows algs in flexbox format
function showAlgsFlex($setname, $setID, $pigstage, $pigview, $mysqli) {
	echo "<h1 class=text-center>$setname</h1>";
	echo "<div class='d-flex flex-wrap justify-content-center'>";

	$algcases = getAlgcaseBySetID($setID, $mysqli);
	while($case = $algcases->fetch_array()) {
		$name = $case['name'];
		$pigcase = $case['pigcase'];
		$caseID = $case['caseID'];

		$imgsrc = "visualcube/visualcube.php?fmt=svg&size=128&case=$pigcase&stage=$pigstage";
		if ($pigview != "") $imgsrc = $imgsrc . " .&view=$pigview"; 

		echo "<div class='p-2 text-center flex-item'>";
		echo "<h2>$name</h2>";
		echo "<img src=\"$imgsrc\" alt='$name image'>";

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

function showAlgsDropdown($setname, $setID, $userID, $pigstage, $pigview, $mysqli) {
	echo "<h1 class=text-center>$setname</h1>";
	echo "<div class='d-flex flex-wrap justify-content-center'>";
	// algcases and useralgs both come sorted, loop over every algcase and compare it to the next useralg
	$algcases = getAlgcaseBySetID($setID, $mysqli);
	$useralgs = getUserAlgBySetID($userID, $setID, $mysqli);

	$userMoves = "";
	$useralg = $useralgs->fetch_array();
	while($case = $algcases->fetch_array()) {
		$name = $case['name'];
		$pigcase = $case['pigcase'];
		$caseID = $case['caseID'];

		$imgsrc = "visualcube/visualcube.php?fmt=svg&size=128&case=$pigcase&stage=$pigstage";
		if ($pigview != "") $imgsrc = $imgsrc . "&view=$pigview";

		echo "<div class='p-2 text-center flex-item'>";
		echo "<h2 style='font-size:1.2em;line-height:.8;'>$name</h2>";
		echo "<img src=\"$imgsrc\" alt='$name image' class='m-0'>";

		echo "<div class='btn-group'>";


		if ($caseID == $useralg['caseID']) {
			$userMoves = $useralg['moves'];
			$useralg = $useralgs->fetch_array();
		}

		if ($userMoves != "") {
			echo "
				<button type='button' class='btn btn-info dropdown-toggle algbtn$caseID' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='width:90px;white-space:normal;text-align:left;'>$userMoves</button>
				<div class='dropdown-menu'>";
		}

		$first = true;
		$algorithm = getAlgorithmByCaseID($caseID, $mysqli);
		while($alg = $algorithm->fetch_array()) {
			$moves = $alg['moves'];
			if ($first && $userMoves == "") { $first = false;
				echo "
				<button type='button' class='btn btn-info dropdown-toggle algbtn$caseID' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='width:90px;white-space:normal;text-align:left;'>$moves</button>
				<div class='dropdown-menu'>";
			}					
			echo "<a class='dropdown-item' href=\"saveAlg?caseID=$caseID&setID=$setID&setname=$setname&moves=$moves\">$moves</a>";
		} echo "</div></div>";
		echo "</div>";
		$userMoves = "";
	}
	echo "</div>";
}
?>

<script>
		$(window).on("scroll", function() {
		  $.cookie("tempScrollTop", $(window).scrollTop());
		});
		$(function() {
		  if ($.cookie("tempScrollTop")) {
		    $(window).scrollTop($.cookie("tempScrollTop"));
		  }
		});
</script>

<div class="container">
	<div class="row">
		<div class="col-12 text-center no-padding">
			<?php
				if( !$user->isLoggedIn() ) { 
						echo 
						"<div class='alert alert-info py-0 my-0' role='alert'>
							If you log in, you can show only your preferred algorithms.
						</div> ";
						showAlgsFlex($setname, $setID, $pigstage, $pigview, $mysqli);
				} else {
					showAlgsDropdown($setname, $setID, $user->getUserID(), $pigstage, $pigview, $mysqli);
				}
			?>
		</div>
	</div>
</div>

<?php
	require('layout/footer.php'); 
?>