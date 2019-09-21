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
		//create the javascript array with the database information depending on the search criteria
		var locations = [
      		<?php
			$pdo = new PDO('mysql:host=localhost;dbname=whats_open', 'webmanager', 'databasepwd23');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if (!isset($_POST['rateSearch'])) {
					$searchq = $_POST['mainSearch'];
				} else {
					$searchq = $_POST['mainSearch'];
					$searchq = $_POST['rateSearch'];
				}
			$searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

			try{
				$result = $pdo->query("SELECT * FROM (SELECT `venue_id`, `location_name`, `closing_time`, `price`, `location_id`,`longitude`,`latitude`, AVG(rating) AS `avgrating` FROM (SELECT * FROM Venues t1 LEFT OUTER JOIN Reviews t2 ON t1.venue_id=t2.location_id) AS mixed GROUP BY `venue_id`) AS results WHERE `location_name` LIKE '%$searchq%' OR `avgrating` LIKE '%$searchq%'");
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
		</nav>
	<section>
		<h3>Results for Hamilton:</h3>
		<div id="results">
		<table>
			<thead>
				<tr>
					<th>Location</th>
					<th>Open Until</th>
					<th>Price on a scale of 1-5</th>
					<th>Rating on a scale of 1-5</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$pdo = new PDO('mysql:host=localhost;dbname=whats_open', 'webmanager', 'databasepwd23');
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					// if no rating was entered
					if (!isset($_POST['rateSearch'])) {
						$searchq = $_POST['mainSearch'];
					} else {
						//if a rating was entered priortize word search then rating search
						$searchq = $_POST['mainSearch'];
						$searchq = $_POST['rateSearch'];
					}
					$searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

					try{
						$result = $pdo->query("SELECT * FROM (SELECT `venue_id`, `location_name`, `closing_time`, `price`, `location_id`,`longitude`,`latitude`, AVG(rating) AS `avgrating` FROM (SELECT * FROM Venues t1 LEFT OUTER JOIN Reviews t2 ON t1.venue_id=t2.location_id) AS mixed GROUP BY `venue_id`) AS results WHERE `location_name` LIKE '%$searchq%' OR `avgrating` LIKE '%$searchq%'");
					}catch (PDOException $e) {
						echo $e->getMessage();
					}
					// dynamically display the results obtained on the page
					foreach ($result as $venue) {
						echo "<tr>";
						echo "<td><a href=\"object.php?venue={$venue['venue_id']}\"> {$venue['location_name']} </a></td>";
						if (!$venue['closing_time']) {
							echo "<td>24 Hrs</td>";
						} else {
							echo "<td>{$venue['closing_time']}AM</td>";
						}
						echo "<td>{$venue['price']}</td>";
						echo "<td>{$venue['avgrating']}</td>";
						echo "</tr>";
					}
					unset($pdo);
				?>
			</tbody>
		</table>
		</div>
		<div id="map-canvas">
		<div id="map">
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBW7h9FgXkaGgUPAvQDBmKsSWph67PvrD0&callback=initMap" async defer>
			</script>
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