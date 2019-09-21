<?php session_start(); ?>
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
			<h3>Sign Up</h3>
		<?php
			$errors = array();
			// if the form had been submitted
			if (!empty($_POST)) {
				require 'validate.inc.php';
				// validate the following fields
				validateNames($errors,$_POST,'FirstName');
				validateNames($errors,$_POST,'LastName');
				validateEmail($errors, $_POST, 'Email');
				validatePwd($errors, $_POST, 'Password', 'cPassword');

				// if we recieved errors we reload the page with the errors displaying
				if ($errors) {
					include 'userform.inc.php';
				} else {
					//if there are no errors we insert the data into the database
					$pdo = new PDO('mysql:host=localhost;dbname=whats_open', 'webmanager', 'databasepwd23');
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					try{
		    			// create prepared statement
		    			$sql = "INSERT INTO `Users` (`first_name`, `last_name`, `email`, `salt`, `pwd`, `bday`) VALUES ( :firstname, :lastname, :email, :salt, SHA2(CONCAT(:password,:salt),0), :birthday)";

		    			$stmt = $pdo->prepare($sql);
		    
		    			// bind parameters to statement
		    			$stmt->bindParam(':firstname', $_POST['FirstName']);
		    			$stmt->bindParam(':lastname', $_POST['LastName']);
		    			$stmt->bindParam(':email', $_POST['Email']);
		    			$stmt->bindParam(':salt', $salt);
		    			$stmt->bindParam(':password', $_POST['Password']);
		    			$stmt->bindParam(':birthday', $bday);

		    			//generates salt for the password
		    			$salt = uniqid(mt_rand(), true);
		    			$bday = $_POST['birthdate_y'] . '-' . $_POST['birthdate_m'] . '-' . $_POST['birthdate_d'];
		    
		    			// execute the prepared statement
		    			$stmt->execute();
						echo "<br/><br/><h3><u><i>User Account successfully created.</i></u></h3>";
					} catch(PDOException $e){
		    			die("ERROR: Could not able to execute $sql. " . $e->getMessage());
					}
				unset($pdo);
				}
			} else {
				//if this is the first time entering the page and nothing has been submitted yet
				include 'userform.inc.php';
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