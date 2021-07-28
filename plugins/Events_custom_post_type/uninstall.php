<?php

/** 
 * trigger this file on plugin uninstall
 */ 


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// clear database stored data via SQL

global $wpdb;  
// delete all "event" post type
$wpdb->query("DELETE FROM {$wpdb->post} WHERE post_type =\"event\"");  

// delete all postmeta that don't match with the id of existing posts
$wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT id FROM wp_posts)");  

// delete all terms that don't match with the id of existing posts
$wpdb->query("DELETE FROM {$wpdb->relationship} WHERE object_id NOT IN (SELECT id FROM wp_posts)");  