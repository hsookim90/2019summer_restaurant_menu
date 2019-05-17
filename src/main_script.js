function openTab(event, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    event.currentTarget.className += " active";

    loadData(tabName);
}

// https://www.youtube.com/watch?v=Zxf1mnP5zcw&t=601s
var map;
var service;
var infowindow;

function initMap() {
    var pyrmont = new google.maps.LatLng(49.8951,-97.1384);
    infowindow = new google.maps.InfoWindow();

    map = new google.maps.Map(document.getElementById('map'), {
        // center:{lat:49.8951, lng:-97.1384},
        center: pyrmont,
        zoom: 11
    });

    // var script = document.createElement('script');
    // // This example uses a local copy of the GeoJSON stored at
    // // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
    // // script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
    // script.src = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=49.8951,-97.1384&radius=5000&type=restaurant&key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8';
    // document.getElementsByTagName('head')[0].appendChild(script);
    
    var request = {
        location: pyrmont,
        radius: '15000',
        type: ['restaurant']
    };

    service = new google.maps.places.PlacesService(map);
    service.nearbySearch(request, callback);
}

// Loop through the results array and place a marker for each
// set of coordinates.
// window.eqfeed_callback = function(results) {
//     for (var i = 0; i < results.features.length; i++) {
//         var coords = results.features[i].geometry.coordinates;
//         var latLng = new google.maps.LatLng(coords[1],coords[0]);
//         var marker = new google.maps.Marker({
//         position: latLng,
//         map: map
//         });
//     }
// }

function callback(results, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i=0; i<results.length; i++) {
            var place = results[i];
            createMarker(results[i]);
        }
    }
}

function createMarker(place) {
    var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
    });
}

document.getElementById("defaultOpen").click();