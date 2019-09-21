<?php
	//If logged in display the user options, otherwise display the general oprions
	if (isset($_SESSION['isLoggedIn'])) {
		echo '<li class="menulist"><a href="newObject.php" title="Add A Venue">Add A Venue</a></li>';
		echo '<li class="menulist"><a href="login.php?logout=true" title="Log Out">Log Out</a></li>';
	}
	else{
		echo '<li class="menulist"><a href="registration.php" title="Registration">Sign Up</a></li>';
		echo '<li class="menulist"><a href="login.php" title="Log In">Log In</a></li>';
	}
?>