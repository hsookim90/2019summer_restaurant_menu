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

// AJAX
// function loadData(tabName) {
//     $(document).ready(function() {
//         $("#" + tabName).click(function() {
//             $()
//         })
//     });
// }

// https://www.youtube.com/watch?v=Zxf1mnP5zcw&t=601s
function initMap() {
    var options = {
        zoom: 11,
        center:{lat:49.8951, lng:-97.1384} 
    }

    var map = new google.maps.Map(document.getElementById('map'), options);

    var marker = new google.maps.Marker({
        position:{lat:49.8951, lng:-97.1384},
        map: map
    });

    // map.data.loadGeoJson('Neighbourhood.geojson');

    // var script = document.createElement('script');
    // script.src = 'Neighbourhood.geojson';
    // document.getElementsByTagName('head')[0].appendChild(script);

    // window.eqfeed_callback = function(results) {
    //     for (var i = 0; i < results.features.length; i++) {
    //         var coords = results.features[i].geometry.coordinates;
    //         var latLng = new google.maps.LatLng(coords[1],coords[0]);
    //         var marker = new google.maps.Marker({
    //             position: latLng,
    //             map: map
    //         });
    //     }
    // }
}

document.getElementById("defaultOpen").click();