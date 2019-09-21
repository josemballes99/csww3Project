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
	<script type="text/javascript" language="javascript">
		home = false;
		x = document.getElementById("LongLat");
	</script>
	<script type="text/javascript" src="mainScript.js" ></script>
</head>
<body>
	<div class="headbox">
	<header><h1>What's Actually Open?</h1></header>
	</div>
		<nav>
			<ul class="menu">
				<li class="menulist"><a href="index.php" title="Home">Home</a></li>
				<?php
					include 'user_session.inc.php';
				?>
			</ul>
		</nav>
		<section>
			<h3>Add a new late night venue</h3>
		<?php
			//clear the errors array
			$errors = array();
			//if we recieve something upon submission
			if (!empty($_POST)) {
				require 'validate.inc.php';
				//validate the entered test fields
				validateNames($errors,$_POST,'objectName');
				validateNames($errors,$_POST,'objectDescription');
				// validateImg($errors, $_FILES, 'locImage');

				//if there were errors upon submission, we reload the form but with the errors showing and with text typed in
				if ($errors) {
					include 'objectform.inc.php';
				}
				else {

					// The following code was supposed to be used for the Bucket upload but I was experiencing an issue with
					// the S3 library and its ability to submit to my bucket


	    			// $fileextention == "jpg";
	    			// $filehash = sha1_file($_FILES['locImage']['tmp_name']);
	    			// $filename = $filehash . "." . $fileextension;
	    			// move_uploaded_file($_FILES['locImage']['tmp_name'],"/tmp/" . $filehash . ".jpg");

	    			// $awsAccessKey = "AKIAJRIR73ZGOCDYR7JQ"; 
	    			// $awsSecretKey = "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"; 
	    			// $bucketName = "jmbwebupload";
	    			// require("S3.php");
	    			// $s3 = new S3($awsAccessKey, $awsSecretKey);
	    			// $ok = $s3->putObjectFile($_FILES['locImage']['tmp_name'],$bucketName,$filename,S3::ACL_PUBLIC_READ);

					$pdo = new PDO('mysql:host=localhost;dbname=whats_open', 'webmanager', 'databasepwd23');
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					//The following sql query will add the venue to the database
					try{
	    				// create prepared statement

	    				$sql = "INSERT INTO `Venues` (`venue_id`, `location_name`, `closing_time`, `price`, `longitude`, `latitude`, `description`) VALUES (NULL, :venue_name, :closing_time, :price, :longitude, :latitude, :description)";

	    				$stmt = $pdo->prepare($sql);

	    				// bind parameters to statement
	    				$stmt->bindParam(':venue_name', $_POST['objectName']);
	    				if ($_POST['closingTime']==='') {
	    					$_POST['closingTime']=NULL;
	    				}
	    				$stmt->bindParam(':closing_time', $_POST['closingTime']);
	    				$stmt->bindParam(':price', $_POST['objectPrice']);
	    				$stmt->bindParam(':longitude', $_POST['longitude']);
	    				$stmt->bindParam(':latitude', $_POST['latitude']);
	    				$stmt->bindParam(':description', $_POST['objectDescription']);
	    
	    				// execute the prepared statement
	    				$stmt->execute();

	    				// if ($ok) {
	    				// 	$url = 'https://s3.amazonaws.com/' . $bucketName . '/'. $filename;
	    				// 	echo "<br/><br/><h3><u><i>Venue inserted successfully.</i></u></h3>";
	    				// 	echo '<p>File upload successful: <a href="' . $url . '">' . $url . '</a></p><img src="' . $url . '" />';
	    				// }else {
	    				// 	echo '<p>Error during file upload.</p>';
	    				// }

	    				echo "<br/><br/><h3><u><i>Venue inserted successfully.</i></u></h3>";
						
					} catch(PDOException $e){
	    				die("ERROR: Was not able to execute. You probobly entered a previously submitted venue--> " . $e->getMessage());
					}
					unset($pdo);
				}
			} else {
				//if nothing has been submitted previously (ex. first time on page) we will load the form without errors
				include 'objectform.inc.php';
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