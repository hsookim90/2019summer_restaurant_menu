// https://www.youtube.com/watch?v=Zxf1mnP5zcw&t=601s
var map;
var service;
var infowindow;

function initMap() {
    var pyrmont = new google.maps.LatLng(49.8951,-97.1384);
    // TODO : get the dynamic lat and lng
    infowindow = new google.maps.InfoWindow();

    map_near_me = new google.maps.Map(document.getElementById('map_near_me'), {
        center: pyrmont,
        zoom: 11
    });
    
    var request = {
        location: pyrmont,
        radius: '15000',
        type: ['restaurant']
    };


    service = new google.maps.places.PlacesService(map_near_me);
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
        map: map_near_me,
        position: place.geometry.location
    });

    // address_components are only available in the results of a Place Details request, not a Place Search request. So you'll need to pass the reference ID of each place through a Place Details request in order to get the postal_code.
    google.maps.event.addListener(marker, 'click', function() {
        var request = {
            reference: place.reference
        };

        service.getDetails(request, function(details, status) {            
            infowindow.setContent(
                '<div><strong>' + details.name + '</strong><br>'
                + 'Address: ' + details.formatted_address + '<br>'
                + 'Phone: ' + details.formatted_phone_number+ '<br>'
                + 'Price range: ' + details.price_level + '<br>'
                // price range: 0 (Free), 1 (Inexpensive), ..., 5 (Very Expensive)
                + 'Rating: ' + details.rating + '<br>'
                + 'Website: ' + details.website + '<br>'
                + 'Open Hours: ' + details.opening_hours.weekday_text + '<br>'
                + '</div>'
                // TODO make a line box to the specific restaurant page
            );

            infowindow.open(map_near_me, marker);
        });
    });
}

function popupModal(event, modalName) {
    var modal = document.getElementById(modalName);

    modal.style.display = "block";
}

function closeModal(event, modalName) {
    var modal = document.getElementById(modalName);

    modal.style.display = "none";
}