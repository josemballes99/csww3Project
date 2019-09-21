<?php  

	//This function will return the value for the name at the _POST array
	function getPostedValue($name){
		if (isset($_POST[$name])) {
			return $_POST[$name];
		} else {
			return "";
		}
	}

	// This function will create a Error lable provided that there is an error
	function makeErrorLabel($errors,$name){
		if (isset($errors[$name])) {
			echo "<span class=\"error\"><b>{$errors[$name]}</b></span><br/>";
		} 
	}

	// This function will create a text field with the name and label parameters
	function make_textfield($errors,$name,$label){
		$value = getPostedValue($name);
		makeErrorLabel($errors,$name);
		echo "<input type=\"text\" name=\"{$name}\" id=\"{$name}\" placeholder=\"{$label}\" value=\"{$value}\"/>";
	}

	//This function will create both the password and the confrim password field and will also adjust to the error situation
	// NOTE: we must force the user to rewrite the password in order for them to be 100% sure
	function make_passwordfield($errors,$name,$cname,$label,$confirmlabel){
		$value = getPostedValue($name);
		// if the error was with the confirmed password
		if (isset($errors[$cname])) {
			echo "<input type=\"password\" name=\"{$name}\" id=\"{$name}\" placeholder=\"{$label}\" value=\"{$value}\"/><br/>";
			makeErrorLabel($errors,$cname);
			echo " <input type=\"password\" name=\"{$cname}\" id=\"{$cname}\" placeholder=\"{$confirmlabel}\" value=\"\"/><br/>";
		// if the error was in the password field
		} else if (isset($errors[$name])){
			makeErrorLabel($errors,$name);
			echo "<input type=\"password\" name=\"{$name}\" id=\"{$name}\" placeholder=\"{$label}\" value=\"{$value}\"/><br/>";
			echo " <input type=\"password\" name=\"{$cname}\" id=\"{$cname}\" placeholder=\"{$confirmlabel}\" value=\"\"/><br/>";
		// if the page is loading up for the first time
		} else {
			makeErrorLabel($errors,$name);
			echo "<input type=\"password\" name=\"{$name}\" id=\"{$name}\" placeholder=\"{$label}\" value=\"\"/><br/>";
			echo " <input type=\"password\" name=\"{$cname}\" id=\"{$cname}\" placeholder=\"{$confirmlabel}\" value=\"\"/><br/>";
		}
	}

	//This function will make an upload image input tag
	function make_uploadimg($errors,$name,$label, $Comment){
		makeErrorLabel($errors,$name);
		echo "<label>{$label}</label>";
		echo "<p>{$Comment} <input type=\"file\" name=\"{$name}\" size = '50' accept=\"image/*\"> </p><br/>";
	}
?>