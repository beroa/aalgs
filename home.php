<?php
include('functions.php');
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12 col-xl-8 offset-xl-2 text-center" id='home'>
			<h1>This is the homepage.</h1><br>
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
							echo "<div class='p-2' style='border: 1px solid black;'><a href='set?name=$name'>$name</a></div>";
				  		}
					}
				?>
			</div>
		</div>
	</div>
</div>

<div id="rss-wca" class="container">
	<div class="row">
		<div class="col-lg-12 col-xl-8 offset-xl-2">
			<h3>WCA News</h3>
			<?php getFeed("https://www.worldcubeassociation.org/rss"); ?>
		</div>
	</div>
</div>

