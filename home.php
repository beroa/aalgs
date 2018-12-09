<?php
include('functions.php');
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12 col-xl-8 offset-xl-2 text-center" id='home'>
<!-- 			<h1>This is the homepage.</h1><br> -->
			<h2>Choose an Algset</h2>
			<div class="d-flex flex-wrap justify-content-center">
				<?php 
					// get set names from db and put in table
					include('mysqli.php'); 
					$query = "SELECT * from algset";
					$result = mysqli_query($mysqli, $query);
					if (!$result) echo "Query Error [$query] " . mysqli_error();
					else {
						while($res = $result->fetch_array()) {
							$name = $res['name'];
							$pigcase = $res['pigcase'];
							$pigstage = $res['pigstage'];
							$pigview = $res['pigview'];
							if ($pigview == 'trans') $pigview = '';
							echo "<div class='p-2 flex-item-white'><a href='set?name=$name'>$name<br>
							<img src=\"visualcube/visualcube.php?fmt=svg&size=128&case=$pigcase&stage=$pigstage&view=$pigview\" alt='$name image'>
							</a></div>";
				  		}
					}
				?>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div id="rss-wca" class="col-lg-12 col-xl-8 offset-xl-2">
			<h3>WCA News</h3>
			<?php getFeed("https://www.worldcubeassociation.org/rss"); ?>
		</div>
	</div>
</div>

