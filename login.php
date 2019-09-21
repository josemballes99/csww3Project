<?php
	//This function will validate that the password entered matches with the one in our database
	function checkPassword($usr,$pwd) {
		$pdo = new PDO('mysql:host=localhost;dbname=whats_open', 'webmanager', 'databasepwd23');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try{
	    	// create prepared statement
	    	$sql = "SELECT * FROM `Users` WHERE `email`= :username and `pwd`= SHA2(CONCAT(:password,`salt`),0)";

	    	$result = $pdo->prepare($sql);
	    
	    	// bind parameters to statement
	    	$result->bindParam(':username', $user);
	    	$result->bindParam(':password', $pass);

	    	$user=$usr;
	    	$pass=$pwd;
	    
	    	// execute the prepared statement
	    	$result->execute();
	    	//return true if the password matches
	    	return $result->rowCount() === 1;
		} catch(PDOException $e){
	    	die("ERROR: Could not able to execute $sql. " . $e->getMessage());
		}
	}
	session_start();
	// After we recieve a login form submission
	if (isset($_POST['login'])) {
		//check credentials in the database
		if (checkPassword($_POST['signinEmail'],$_POST['signinPwd'])) {
			// Start the logged in session and set the prameters required
			session_start();
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['user'] = $_POST['signinEmail'];
			header("Location: http://" . $_SERVER['HTTP_HOST'] . "/cs4ww3/index.php");
			exit();
		}
		else{
			header("Location: http://" . $_SERVER['HTTP_HOST'] . "/cs4ww3/login.php?attempt=failed");
		}
	}		
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="author" content="Jose M. Ballesteros"/>
	<meta name="keywords" conent="Late, Nightlife, Open, Right Now, 24hr"/>
	<meta name="description" content="This page allows users to search up places that are open late at night." />
	<title>What's Actually Open?</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<script type="text/javascript" src="mainScript.js"></script>
</head>
<body>
	<div class="headbox">
	<header><h1>What's Actually Open?</h1></header>
	</div>
		<nav>
			<ul class="menu">
				<li class="menulist"><a href="index.php" title="Home">Home</a></li>
				<li class="menulist"><a href="registration.php" title="Registration">Sign Up</a></li>
				<li class="menulist"><a href="login.php" title="Log In">Log In</a></li>
			</ul>
		</nav>
		<section>
			<h3>Log In</h3>
			<form action="login.php" method="post" class="form" onsubmit="return validate(this);">
				<input type="text" name="signinEmail" id="email" placeholder="Email" required>
				<br/>
				<input type="password" name="signinPwd" id="pwd" placeholder="Password" required>
				<br/>
				<input type="submit" name="login" value="Log In">
			</form>
			<?php
				//if they failed once we display message
				if (isset($_GET['attempt'])) {
					echo "<p>Login attempt failed, please try again!</p>";
				}
				//if they clicked log out from any page they get redirected here but with the following statment
				else if (isset($_GET['logout'])) {
					echo "<p>You are now Logged Out!</p>";
					unset($_SESSION['isLoggedIn']);
				}
			?>
		</section>
	<footer>
		<ul class="foot">
			<li class="footlist">Made By: Jose M. Ballesteros</li>
			<li class="footlist">Student Number: 001411748</li>
			<li class="footlist">MacID: Ballesjm</li>
			<li class="footlist">COMP SCI 4WW3</li>
		</ul>
	</footer>	
</body>
</html>