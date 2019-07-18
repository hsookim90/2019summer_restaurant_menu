// ------------- Modal
function popupModal(event, modalName) {
    var modal = document.getElementById(modalName);

    modal.style.display = "block";
}

function closeModal(event, modalName) {
    var modal = document.getElementById(modalName);

    modal.style.display = "none";
}

// -------------- Side Nav
/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}
  
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

// --------------- Scroll
document.addEventListener('DOMContentLoaded', function(event) {
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
})

// --------------- Restaurant List
$(function showList() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("listContents").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "listProvider.php", true);
    xmlhttp.send();
});

// ------------------------------------------------------ //
// Google Maps
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