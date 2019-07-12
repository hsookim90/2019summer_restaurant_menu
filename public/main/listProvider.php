<?php
$q=$_GET["q"];

$xmlDoc = new DOMDocument();
$xmlDoc->load("https://maps.googleapis.com/maps/api/place/nearbysearch/xml?location=49.8951,-97.1384&radius=15000&type=restaurant&key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8");

// $x=$xmlDoc->getElementsByTagName('ARTIST');

// for ($i=0; $i<=$x->length-1; $i++) {
//     //Process only element nodes
//     if ($x->item($i)->nodeType==1) {
//         if ($x->item($i)->childNodes->item(0)->nodeValue == $q) {
//             $y=($x->item($i)->parentNode);
//         }
//     }
// }

// $cd=($y->childNodes);

// for ($i=0;$i<$cd->length;$i++) { 
//     //Process only element nodes
//     if ($cd->item($i)->nodeType==1) {
//         echo("<b>" . $cd->item($i)->nodeName . ":</b> ");
//         echo($cd->item($i)->childNodes->item(0)->nodeValue);
//         echo("<br>");
//     }
// }

$x=$xmlDoc->getElementsByTagName('name');

// exclude next_page_token
for ($i=0; $i<=$x->length-2;$i++) {
    // check if type of each result is element
    if ($x->item($i)->nodeType==1) {
        echo("name: ");
        echo($x->item($i)->childNodes->item(0)->nodeValue);
        echo("<br>");
    }
}
?>