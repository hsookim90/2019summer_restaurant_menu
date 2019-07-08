var map;
var service;
var infowindow;

function initMap() {
    var pyrmont = new google.maps.LatLng(49.8951,-97.1384);

    map = new google.maps.Map(document.getElementById('restaurant_location'), {
        center: pyrmont,
        zoom: 11
    });
    
    var request = {
        location: pyrmont,
        radius: '15000',
        type: ['restaurant']
    };

    // TODO: only need one specific restaurant location. nearbysearch not in need.
    service = new google.maps.places.PlacesService(map);
    service.nearbySearch(request, callback);
}

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

    // address_components are only available in the results of a Place Details request, not a Place Search request. So you'll need to pass the reference ID of each place through a Place Details request in order to get the postal_code.
    google.maps.event.addListener(marker, 'click', function() {
        var request = {
            reference: place.reference
        };

        service.getDetails(request, function(details, status) {
            // price range: 0 (Free), 1 (Inexpensive), ..., 5 (Very Expensive)
            infowindow.setContent(
                '<div><strong>' + details.name + '</strong><br>'
                + 'Address: ' + details.formatted_address + '<br>'
                + 'Phone: ' + details.formatted_phone_number+ '<br>'
                + 'Price range: ' + details.price_level + '<br>'
                + 'Rating: ' + details.rating + '<br>'
                + 'Website: ' + details.website + '<br>'
                + 'Open Hours: ' + details.opening_hours.weekday_text + '<br>'
                + '</div>'
            );

            infowindow.open(map, marker);
        });
    });
}