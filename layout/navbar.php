<?php
//include config
require_once('includes/config.php');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href=".">Aalgs</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	<ul class="navbar-nav">
	  <li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  3x3
		</a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			<?php 
				// get set names from db and put in dropdown
				include('mysqli.php'); 
				$query = "SELECT * from algset";
				$result = mysqli_query($mysqli, $query);
				if (!$result) echo "Query Error [$query] " . mysqli_error();
				else {
					while($res = $result->fetch_array()) {
						$name = $res['name'];
						echo "<a class='dropdown-item' href='set?name=$name'>$name</a>";
			  		}
				}
			?>
		</div>
	  </li>
	</ul>
	<ul class="navbar-nav ml-auto">
		<?php 
			// display login/logout/register as appropriate
			$username = $user->getUsername();
			if( $user->is_logged_in() ) {
				echo "<li class='nav-link disabled'>$username</li>";
				echo '<li class="nav-item"><a class="nav-link" href="logout">Logout</a></li>';
			} else {
				echo '<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
						<li class="nav-item"><a class="nav-link" href="login.php">Log In</a></li>';
			}
		?>
	</ul>
  </div>
</nav>