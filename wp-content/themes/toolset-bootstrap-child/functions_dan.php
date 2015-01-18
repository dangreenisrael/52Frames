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

//$photo = new Photo();
echo "<pre>";
echo $photo->getUrl();
echo "</pre>";
*/

function my_cred_validation($field_data, $form_data) {
    list($fields,$errors)=$field_data;
 
    if ($form_data['id'] == 92) {
         
        if ( empty($fields['_featured_image']['value']) ) {
            $errors['_featured_image']='This field is required';
        }
    }
 
    return array($fields,$errors);
}
// add_filter('cred_form_validate', 'my_cred_validation', 10, 2);