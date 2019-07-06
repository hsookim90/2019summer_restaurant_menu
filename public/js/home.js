var map;
var service;
var infowindow;

function initMap() {
    var pyrmont = new google.maps.LatLng(49.8951,-97.1384);

    map = new google.maps.Map(document.getElementById('map_nearme'), {
        center: pyrmont,
        zoom: 11
    });
    
    var request = {
        location: pyrmont,
        radius: '15000',
        type: ['restaurant']
    };

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

            infowindow.open(map, marker);
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

/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}
  
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("header").style.padding = "30px 10px";
        document.getElementById("logo").style.fontSize = "25px";
        // document.getElementById("topSearchbar").style.visibility = "hidden";
    } else {
        document.getElementById("header").style.padding = "80px 10px";
        document.getElementById("logo").style.fontSize = "35px";
        // document.getElementById("topSearchbar").style.visibility = "visible";
    }
}

// $(document).ready(function() {
//     $("button").click(function() {
//         $.getJSON('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=49.8951,-97.1384&radius=15000&type=restaurant&key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8', function(data) {
//             $.each(data, function(i, field) {
//                 $('div').append(field + " ");
//             });
//         });
//     });
// });