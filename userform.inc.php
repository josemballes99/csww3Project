<form action="" method="post" class="form" ><!--onsubmit="return validate(this);>"-->
	<?php  
		// Generate the registration field
		require 'fieldgenerator.inc.php';
		make_textfield($errors,'FirstName','First Name');
		echo " ";
		make_textfield($errors,'LastName','Last Name');
		echo "<br/>";
		make_textfield($errors,'Email','Email');
		echo "<br/>";
		make_passwordfield($errors,'Password','cPassword','Password','Confirm Password');
	?>
	<br/>
	<label>Birthday:</label>
		<fieldset>
	        <select class="month" id="birthMonth" name="birthdate_m" required>
				<option value="" disabled>Month</option>
				<option value="01">Jan</option>
				<option value="02">Feb</option>
				<option value="03">Mar</option>
				<option value="04">Apr</option>
				<option value="05">May</option>
				<option value="06">Jun</option>
				<option value="07">Jul</option>
				<option value="08">Aug</option>
				<option value="09">Sep</option>
				<option value="10">Oct</option>
				<option value="11">Nov</option>
				<option value="12">Dec</option>
			</select>
			<select class="day" id="birthDay" name="birthdate_d" required>
				<option value="" disabled>Day</option>
					<?php  
						//create birth date option
	                    for ($i=1; $i < 10; $i++) { 
	                   		echo "<option value=\"0{$i}\">{$i}</option>";
	                     } 
	                    for ($i=10; $i < 32; $i++) { 
	                     	echo "<option value=\"{$i}\">{$i}</option>";
	                     }
	               ?>
			</select>
				<select class="year" id="birthYear" name="birthdate_y" required>
					<option value="" disabled>Year</option>
					<?php  
						//create birth year option
	                    for ($i=2018; $i > 1900; $i--) { 
	                  		echo "<option value=\"{$i}\">{$i}</option>";
	                   	}
	                ?>
				</select>
	    </fieldset>
	<input type="submit" value="Submit">
</form>