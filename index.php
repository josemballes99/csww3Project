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
		home = true;
		x = document.getElementById("changeCity");
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
		<h3>Search for whats open right now.</h3>
		<div id="SearchForm" >
			<form action="results.php" method="post">
				<input type="search" name="mainSearch" id="searchObject" value="" tabindex="1" placeholder="Search By Venue Name" />
				<div id="changeCity">
					<input type="number" name="cityLongitude" id="cityObject" placeholder="Longitude" />
					<input type="number" name="cityLatitude" id="cityObject" placeholder="Latitude" />	
				</div>
				<select id="rating" name="rateSearch">
					<option value="1">*</option>
					<option value="2">**</option>
					<option value="3">***</option>
					<option value="4">****</option>
					<option value="5">*****</option>
					<option value="0" disabled selected>Search by Rating</option>
				</select>
				<br/>
				<input class="myButton" type="submit" value="Search">
				<input class="myButton" type="button" value="Enter Current Location" onclick="getLocation()">
			</form>
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