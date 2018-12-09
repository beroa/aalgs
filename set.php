<?php
	require('layout/header.php'); 
	require('layout/navbar.php'); 
	
	require('functions.php');
	require('mysqli.php');
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
?>

<script>
	function myFunction() {
	  document.getElementById("demo").innerHTML = "Paragraph changed.";
	}
</script>

<div class="container">
	<div class="row">
		<div class="col-12 text-center no-padding">
			<?php
				if( !$user->is_logged_in() ) { 
						echo 
						"<div class='alert alert-info py-0 my-0' role='alert'>
							If you log in, you can show only your preferred algorithms.
						</div> ";
						showAlgsFlex($name, $setid, $pigstage, $pigview, 0);
				} else {
					showAlgsFlex($name, $setid, $pigstage, $pigview, 1);
				}
			?>
		</div>
	</div>
</div>

<?php
	require('layout/footer.php'); 
?>