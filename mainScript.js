//Start the geolocation call and make sure the browser supports it
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        alert('Geolocation Not supported by current browser');
    }
}

//Insert location information depending on Search page or add venue page
function showPosition(position) {
	// if on the home page
	if (home) {
		var lon = position.coords.longitude;
		var lat = position.coords.latitude;
    	x.innerHTML = '<input type="number" name="cityLongitude" id="cityObject" value="' + lon.toFixed(6) + '" required/>' + 
    	'<input type="number" name="Latitude" id="cityObject" value="' + lat.toFixed(6) + '" required/>';
	}
	//if on the add object page
	else{
		var lon = position.coords.longitude;
		var lat = position.coords.latitude;
    	x.innerHTML = '<input type="number" name="Longitude" id="objectLongitude" value="' + lon.toFixed(6) + '" required/>' + 
    	'<input type="number" name="Latitude" id="objectLatitude" value="' + lat.toFixed(6) + '" required/>';
	}
}

//Email form validation
function validateEmail(form){
	if (!(/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(form.email.value))) {
		window.alert("Please Enter A proper Email.");
		return false;
	}
	else {
		return true;
	}
}


//Name form validation
function validateName(form){
	if ((form.lastName.value)==="") {
		window.alert("No name entered.");
		return false;
	}
	else {
		return true;
	}
}

//Password form validation
function validatePassword(form){
	if ((form.pwd.value).length < 8) {
		window.alert("Please enter an password longer than 8 characters.");
		return false;
	}
	else {
		return true;
	}
}

//Calls all validate functions from the form
function validate(form) {
	validateEmail(form);
	validateName(form);
	validatePassword(form);
}