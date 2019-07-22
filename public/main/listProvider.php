<?php
require_once('../../private/initialize.php');

$q = $_REQUEST["q"];

$geoData = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($q) . '&key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8');
$geoDataJSON = json_decode($geoData, true);

$restListData = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' . $geoDataJSON['results'][0]['geometry']['location']['lat'] . ',' . $geoDataJSON['results'][0]['geometry']['location']['lng'] . '&radius=15000&type=restaurant&price_level&key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8');
$restListJSON = json_decode($restListData, true);

foreach ($restListJSON['results'] as $value) {
    echo '<a href="' . 'restaurant.php?restName=' . urlencode($value['name']) .
                        '&address=' . urlencode($value['vicinity']) .
                        '&photo_ref=' . urlencode($value['photos'][0]['photo_reference']) . '">';
    echo '<button class="restItem">';
    // apply responsive design to image size
    echo '<img src="https://maps.googleapis.com/maps/api/place/photo?photoreference=' . $value['photos'][0]['photo_reference'] . '&sensor=false&maxheight=400&maxwidth=400&key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8">' . '<br>';
    echo $value['name'] . '<br>';
    echo $value['vicinity'] . '<br>';
    echo 'Rating: ';
    echo $value['rating'] . '<br>';
    echo 'Price: ';
    echo $value['price_level'] . '<br>';
    echo '<br>';
    echo '</button>';
    echo '</a>';
}
?>