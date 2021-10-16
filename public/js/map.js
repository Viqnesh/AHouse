// ====== Create map objects ======
var latlng = new google.maps.LatLng(-34.397, 150.644);
var mapOptions = {
        zoom: 10,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
var geo = new google.maps.Geocoder(); 
var map = new google.maps.Map(document.getElementById("map"), mapOptions);
var bounds = new google.maps.LatLngBounds();

// ====== Geocoding ======
function getAddress(search) {
    geo.geocode({address:search}, function (results,status)
      { 
        // If that was successful
        if (status == google.maps.GeocoderStatus.OK) {
          // Lets assume that the first marker is the one we want
          var p = results[0].geometry.location;
          var lat=p.lat();
          var lng=p.lng();
          // Output the data
          createMarker(search,lat,lng);
        }
        // ====== Decode the error status ======
        else {
            alert('Something went wrong. Please Try again.');
        }
      }
    );
}


// ======= Function to create a marker
function createMarker(location,lat,lng) {
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat,lng), 
        map: map
    });

    google.maps.event.addListener(marker, 'click', function() {
        alert("Your Location : "+location);
     });

     bounds.extend(marker.position); 
}