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

// function loadData(tabName) {
//     $(document).ready(function() {
//         $("#" + tabName).click(function() {
//             $()
//         })
//     });
// }

function initMap() {
    var options = {
        zoom: 11,
        center:{lat:49.8951, lng:-97.1384} 
    }

    var map = new google.maps.Map(document.getElementById('map'), options);

    var marker = new google.maps.Marker({
        position:{lat:49.8951, lng:97.1384},
        map: map
    });
}

document.getElementById("defaultOpen").click();