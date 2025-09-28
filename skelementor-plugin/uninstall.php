<?php

/**
 * Trigger this file on Plugin uninstall
 * 
 * @package SkelementorPlugin
 */

// to make sure no one or nothing other than wordpress can trigger this uninstall option, we check if the wp_uninstall_plugin global var exists.
// this security check is super important

if (! defined( 'WP_UNINSTALL_PLUGIN' )) {

    die;
}

// Clear Database stored data (generate from custom post types, this is imp and we need to be careful here)

//method 1: if you know what custom post type you have, delete like this (esp if not comfy with SQL).

$books = get_posts(array('post type' => 'book', 'numberposts' => -1)); //the post type must be the same as when registered. -1 indicated all posts are covered

foreach( $books as $book ) {
    wp_delete_post( $book -> ID, true ); //if set to true, deletes post no matter what, if set to false, doesn't trigger delete if it's in trash already
}

//method 2: the mighty wpdp by triggering an SQL query directly inside the wordpress database (only if you're comfortable with SQL)
// global $wpdb;
// $wpdb -> query( "DELETE FROM wp_posts WHERE post_type = 'book' ");
// $wpdb -> query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
// $wpdb -> query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");