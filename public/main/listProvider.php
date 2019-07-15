<?php
require_once('../../private/initialize.php');
$q=$_GET["q"];

$xmlDoc = new DOMDocument();
$xmlDoc->load("https://maps.googleapis.com/maps/api/place/nearbysearch/xml?location=49.8951,-97.1384&radius=15000&type=restaurant&price_level&key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8");

// $x=$xmlDoc->getElementsByTagName('name');

// // exclude next_page_token
// for ($i=0; $i<=$x->length-2;$i++) {
//     // check if type of each result is element
//     if ($x->item($i)->nodeType==1) {
//         echo("name: ");
//         echo($x->item($i)->childNodes->item(0)->nodeValue);
//         echo("<br>");
//     }
// }

$numResults=$xmlDoc->getElementsByTagName('result');

$names=$xmlDoc->getElementsByTagName('name');
$addresses=$xmlDoc->getElementsByTagName('vicinity');
$ratings=$xmlDoc->getElementsByTagName('rating');
$price=$xmlDoc->getElementsByTagName('price_level');

// https://maps.googleapis.com/maps/api/place/photo?photoreference=PHOTO_REFERENCE&sensor=false&maxheight=MAX_HEIGHT&maxwidth=MAX_WIDTH&key=YOUR_API_KEY
for ($i=0; $i<=$numResults->length-1;$i++) {
    echo '<a href="' . 'restaurant.php?restName=' . urldecode($names->item($i)->nodeValue) . '">';
    echo '<button class="restItem">';
    echo $names->item($i)->nodeValue . '<br>';
    echo $addresses->item($i)->nodeValue . '<br>';
    echo 'Rating: ';
    echo $ratings->item($i)->nodeValue . '<br>';
    echo 'Price: ';
    echo $price->item($i)->nodeValue . '<br>';
    echo '<br>';
    echo '</button>';
    echo '</a>';
}
?>