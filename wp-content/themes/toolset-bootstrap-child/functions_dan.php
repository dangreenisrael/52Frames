	<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 1/6/15
 * Time: 13:20
 */

/*
 * Load all Models
 */
require('models/Author.php');
require('models/Photo.php');
require('models/Album.php');
require('models/Comments.php');

/*
$photo = new Photo(123);
 * Find Between (no RegEx)
 */

//$photo = new Photo();
echo "<pre>";
echo $photo->getUrl();
echo "</pre>";
*/ 
function contentBetween($haystack, $start,$end){
    $startsAt = strpos($haystack, $start) + strlen($start);
    $endsAt = strpos($haystack, $end, $startsAt);
    return substr($haystack, $startsAt, $endsAt - $startsAt);
}