<?php
	// this method check the entered email to make sure it is valid, 
	// only adds an error to the errors array if there is an issue
	function validateEmail(&$errors, $field_list, $field_name){
		// regex pattern for a valid email
		$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
		// check to see if an email was even entered
		if (!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
			$errors[$field_name]='Please enter an email.';
		} else if (!preg_match($pattern, $field_list[$field_name])){
			//if the email is not valid
			$errors[$field_name]='Please enter a valid email address.';
		}
	}

	// this method check to see if something was entered into the text field
	function validateNames(&$errors, $field_list, $field_name){
		if (!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
			$errors[$field_name]='This field is required!';
		} 
	}

	// this method checks to see if password is valid
	function validatePwd(&$errors, $field_list, $pwd, $confirm_pwd){
		//if the password field is not empty
		if(!empty($field_list[$pwd]) && ($field_list[$pwd] == $field_list[$confirm_pwd])) {
    	$password = htmlspecialchars($field_list[$pwd]); //password
    	$cpassword = htmlspecialchars($field_list[$confirm_pwd]); //confirm password
    		//if the password entered is less than 8 characters
    		// or does not contain a number
    		// or does not contain a capital letter
    		if ((strlen($password) < '8')||(!preg_match("#[0-9]+#",$password))||(!preg_match("#[A-Z]+#",$password))) {
        		$errors[$pwd] = "Your password must contain at least 8 characters, 1 number and 1 capital letter!";
    		} 
    	// if the password does not match the confirm password
		} else if(!empty($field_list[$pwd])) {
   			$errors[$confirm_pwd] = "Please check your confirmed password.";
   		// if a password was not entered
   		} else {
     		$errors[$pwd] = "Please enter a password.";
 		}
	}

	//this method validates that the image submitted is valid jpeg and can be placed on our bucket
	function validateImg(&$errors, $field_list, $field_name){
		$finfo = new finfo (FILEINFO_MIME_TYPE);
		if (!isset($field_list[$field_name]['error'])||($field_list[$field_name]['error'] != UPLOAD_ERR_OK)) {
			$errors[$field_name]="Error while uploading the file.";
	   	} else if (!($finfo->file($field_list[$field_name]['tmp_name'])==="image/jpeg")) {
	   		$errors[$field_name]="File was not a valid image.";
	   	}
	}

?>