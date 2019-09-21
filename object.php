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
	<script type="text/javascript">
		// This method inserts the review on this page through AJAX
		function insertReviewResponse(){
			if (this.status == 200) {
				response = JSON.parse(this.response);
				if (response.status == false) {
					document.getElementById("errorplaceholder").innerHTML="<b>Error: </b>"+ response.message;
				} else {
					document.getElementById("reviewspot").innerHTML="<li>Rating: " + response.rating + "*</li>" + "<li> Review: " + response.review + "</li>";
					document.getElementById("reviewform").innerHTML="<br/>";
					document.getElementById("errorplaceholder").innerHTML="Thank you!";
				}
			}
		}

		// This method send the review information to the php backend for AJAX purposes
		function submitReviewForm(){
			request = new XMLHttpRequest();
			request.open("POST", "submit_review.php");
			request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
			request.onload = insertReviewResponse;
			request.send("location="+encodeURIComponent(<?php echo $_GET['venue'] ?>)+"&rating="+encodeURIComponent(document.getElementById("rating").value)+"&review="+encodeURIComponent(document.getElementById("review").value));
		}

		// Use php to loadup the javascript array with the values from our database
		var locations = [
      		<?php
			$pdo = new PDO('mysql:host=localhost;dbname=whats_open', 'webmanager', 'databasepwd23');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$venueID = $_GET['venue'];

			try{
				$result = $pdo->query("SELECT * FROM `Venues` WHERE `venue_id`=$venueID");
			}catch (PDOException $e) {
				echo $e->getMessage();
			}
			foreach ($result as $venue) {
				echo "['{$venue['location_name']}',{$venue['latitude']},{$venue['longitude']},{$venue['venue_id']}],";
			}
			unset($pdo);
		?>];
	</script>
	<script type="text/javascript" src="map.js"></script>
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
		<div id="venue">
			<?php
				$venueID = $_GET['venue'];
				$pdo = new PDO('mysql:host=localhost;dbname=whats_open', 'webmanager', 'databasepwd23');
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				// Load up the Venue information along with previously submitted reviews from the database
				try{
					$venuesql = "SELECT * FROM `Venues` WHERE `venue_id`=:venueid";
					$reviewsql = "SELECT * FROM `Reviews` WHERE `location_id`=:venueid";

					$result = $pdo->prepare($venuesql);
					$reviewResult = $pdo->prepare($reviewsql);

					$result->bindParam(':venueid', $_GET['venue']);
					$reviewResult->bindParam(':venueid', $_GET['venue']);
					
					$result->execute();
					$reviewResult->execute();
				}catch (PDOException $e) {
					echo $e->getMessage();
				}

				// insert the database results into the page
				foreach ($result as $venue) {
					echo "<h3>{$venue['location_name']}</h3><br/>";
					echo "<p>{$venue['description']}</p><br/>";
					echo "<ul>";
					foreach ($reviewResult as $review) {
						echo "<li>Rating: {$review['rating']}*</li>";
						echo "<li>Review: {$review['review']}</li>";
					}
					echo "<div id=\"reviewspot\"></div>";
					echo "</ul>";
				}
				unset($pdo);

				//if you are logged in you are able to make reviews
				if (isset($_SESSION['isLoggedIn'])) {
					include 'review.inc.php';
				} 
				
			?>
		<br/>
		</div>
		<div id="map-canvas" ">
		<div id="map">
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBW7h9FgXkaGgUPAvQDBmKsSWph67PvrD0&callback=initMap" async defer></script>
		</div>
		</div>
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