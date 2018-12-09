<?php
	require('layout/header.php'); 
	require('layout/navbar.php'); 
	
	require('functions.php');

	require('mysqli.php'); 

	// determine setid from name
	if(isset($_GET['name'])){
		$name = $_GET['name'];
		$query = "SELECT * from algset where name = '$name'";
		$sets = mysqli_query($mysqli, $query) or die (mysqli_error($mysqli)); 
		while($set = $sets->fetch_array()) {
			$setid = $set['id'];
  		}
	} else $setid = 0;
?>

<div class="container">
	<div class="row">
		<div class="col-12 text-center no-padding">
			<h1 class=text-center>
				<?php echo "$name"?>
			</h1>
			<?php 
				showAlgsFlex($setid);
			?>
		</div>
	</div>
</div>

<?php
	require('layout/footer.php'); 
?>