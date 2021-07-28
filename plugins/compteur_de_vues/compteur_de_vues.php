<?php

/**
 * Plugin Name: Compteur de vues
 * Description: Customized statistics for Entre-Pont.
 * Version: 1.0.0
 * Author: Riccardo
 */


//Getter
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 Vues";
    }
    return $count.' Vues';
}


//Setter
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}





function posts_column_views($defaults){
    $defaults['post-views'] = __('Vues');
    return $defaults;
}

function posts_custom_column_views($column_name, $id){
        if($column_name === 'post-views'){
        echo getPostViews(get_the_ID());
    }
}

add_filter('manage_event_posts_columns', 'posts_column_views');
add_action('manage_event_posts_custom_column', 'posts_custom_column_views',5,2);






//Affichage du nombre de vues dans le tableau de bord
add_filter( 'manage_edit-post_sortable_columns', 'sort_by_views_column' );
function sort_by_views_column( $columns ) {
    $columns['post-views'] = 'post-views';
    return $columns;
}

add_action( 'pre_get_posts', 'post_views_orderby' );
function post_views_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'post-views' == $orderby ) {
        $query->set('meta_key','post_views_count');
        $query->set('orderby','meta_value_num');
    }
}