<form action="" method="post" class="form">
	<label>Venue Information</label>
	<br/>
	<?php 
		//generate the text fields 
		require 'fieldgenerator.inc.php';
		make_textfield($errors,'objectName','Venue Name');
		echo "<br/>";
		make_textfield($errors,'objectDescription','Description');
	?>
	<br/>
	<select id="objectPrice" name="objectPrice" required>
		<option value="1">$</option>
		<option value="2">$$</option>
		<option value="3">$$$</option>
		<option value="4">$$$$</option>
		<option value="5">$$$$$</option>
		<option value="" disabled selected>Enter Price</option>
	</select>
	<br/>
	<select id="objectTime" name="closingTime" >
		<option value=''>24 HR</option>
		<option value="00:00:00">12 AM</option>
		<option value="01:00:00">1 AM</option>
		<option value="02:00:00">2 AM</option>
		<option value="03:00:00">3 AM</option>
		<option value="" disabled selected>Enter Closing Time</option>
	</select>
	<br/>
	<div id="LongLat">
		<input type="number" name="longitude" id="objectLongitude" placeholder="Longitude" step="any" required/>
		<input type="number" name="latitude" id="objectLatitude" placeholder="Latitude" step="any" required/>
	</div>
	<input type="button" value="Enter Current Location" onclick="getLocation()">
	<br/>
	<?php  
		//generate the image field
		make_uploadimg($errors,'locImage','Insert Image', 'Please Select a JPEG image:');
	?>
	<input type="submit" value="Submit" class="myButton">
</form>