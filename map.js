var selected = 0; //This variable is used to identify if an object was selected or not in order to differetiate results page with object page

// initiate the map wherever it is called
function initMap() {
    //Create the google map, centered arounf Hamilton ON
	var map = new google.maps.Map(document.getElementById('map'), {
    	center: {lat: 43.2547, lng: -79.8978},
    	zoom: 12
  	});

  	//Shorten the marker window size
  	var infowindow = new google.maps.InfoWindow({
          maxWidth: 200
    });
  	var marker, i;

  	// Conditional logic used to differentiate results page map vs object page map
  	//if on results page
  	for (i = 0; i < locations.length; i++) {  
  		marker = new google.maps.Marker({
  			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
  			map: map
    		});
  		google.maps.event.addListener(marker, 'click', (function(marker, i) {
      		return function() {
        			infowindow.setContent(locations[i][0]);
        			infowindow.open(map, marker);
      		}
    		})(marker, i));
    }
}

