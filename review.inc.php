<?php 
	//generates the review form if a user is logged in
	echo "<form action=\"\" method=\"post\" class=\"form\" id=\"reviewform\"> <br/>";
	echo "<input type=\"text\" name=\"review\" id=\"review\" placeholder=\"Write Your Reviw Here.\" required/><br/>";
	echo "<select id=\"rating\" name=\"rating\" required>";
		echo "<option value=\"1\">*</option>";
		echo "<option value=\"2\">**</option>";
		echo "<option value=\"3\">***</option>";
		echo "<option value=\"4\">****</option>";
		echo "<option value=\"5\">*****</option>";
		echo "<option value=\"\" disabled selected>Enter Rating</option>";
	echo "</select><br/>";
	echo "<button type=\"button\" class=\"myButton\" onclick=\"submitReviewForm();\">Submit Review</button>";
	echo "</form>";
	echo "<div id=\"errorplaceholder\"></div>";
?>
