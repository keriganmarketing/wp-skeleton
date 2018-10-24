<?php /* Editor Filters */

// Remove JPEG compression.
add_filter('jpeg_quality', function () {
    return 100;
}, 10, 2);

/**
* Removes width and height attributes from image tags
* @param string $html
* @return string
*/
function remove_image_size_attributes( $html ) {
    return preg_replace( '/(width|height)="\d*"/', '', $html );
}
    
// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );

// Remove image size attributes from images added to a WordPress post
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );
  
// Add Bootstrap responsive class to images
function add_image_class($class){
    $class .= ' img-fluid';
    return $class;
}

add_filter('get_image_tag_class','add_image_class');