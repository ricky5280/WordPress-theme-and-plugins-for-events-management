<?php

/**
 * Plugin Name: Events Custom Post Type
 * Description: Extension de gestion d'un caléndrier d'événements
 * Version: 1.0.0
 * Author: Riccardo
 * Text Domain: 
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;       // Exit if accessed directly.
}


function event_custom_post_type() {

    $labels = array(
        'name' => 'Evénements',
        'singular_name' => 'Evénement',
        'add_new' => 'Ajouter un nouvel événement',
        'all_items' => 'Tous les événements',
        'add_new_item' => 'Ajouter un nouvel événement',
        'search_item' => 'Rechercher un événement',        

    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revision'
        ),
        'taxonomies' => array('first-tax', 'second-tax', 'third-tax'),
        'menu_position' => 3,
        'menu_icon' => 'dashicons-calendar-alt',
        'exclude_from_search' => false

    );

    register_post_type('event', $args);

}

add_action('init', 'event_custom_post_type');


function event_custom_taxonomies() {

    register_taxonomy('first-tax', 'event', [
        'labels' => [
            'name' => 'Discipline',
            'singular_name' => 'Discipline',
            'plural_name' => 'Disciplines',
            'search_items' => 'Rechercher des disciplines',
            'all_items' => 'Toutes les disciplines',
            'edit_item' => 'Editer la discipline',
            'add_new_item' => 'Ajouter une discipline'            
        ],
        'show_in_rest' => 'true',   // pour affichage dans l'administration
        'hierarchical' => 'true',   // pour afficher taxonomie en check-box
        'show_admin_column' => 'true'   // pour afficher taxonomie dans la liste d'articles
    ]);

    register_taxonomy('second-tax', 'event', [
            'labels' => [
                'name' => 'Organisateur',
                'singular_name' => 'Organisateur',
                'plural_name' => 'Organisateurs',
                'search_items' => 'Rechercher des organisateurs',
                'all_items' => 'Tous les organisateurs',
                'edit_item' => 'Editer le organisateur',
                'add_new_item' => 'Ajouter un organisateur'            
            ],
            'show_in_rest' => 'true',   // pour affichage dans l'administration
            'hierarchical' => 'true',   // pour afficher taxonomie en check-box
            'show_admin_column' => 'true'   // pour afficher taxonomie dans la liste d'articles
     ]);

     register_taxonomy('third-tax', 'event', [
        'labels' => [
            'name' => 'Lieu',
            'singular_name' => 'Lieu',
            'plural_name' => 'Lieux',
            'search_items' => 'Rechercher des lieux',
            'all_items' => 'Tous les lieux',
            'edit_item' => 'Editer le lieu',
            'add_new_item' => 'Ajouter un lieu'            
        ],
        'show_in_rest' => 'true',   // pour affichage dans l'administration
        'hierarchical' => 'true',   // pour afficher taxonomie en check-box
        'show_admin_column' => 'true'   // pour afficher taxonomie dans la liste d'articles
 ]);


}

add_action('init', 'event_custom_taxonomies');


function event_custom_metaboxes() {

    add_meta_box('event_datetime', 'Date événement', 'entrepont_custom_render_calendar_box', 'event', 'normal');

}

function entrepont_custom_render_calendar_box($post) {

    wp_nonce_field('entrepont_save_datetime_data', 'entrepont_datetime_metabox_nonce');

    $value = get_post_meta($post->ID, 'datetime_value_key', true);

    echo '<label for="entrepont_datetime_field">Date et heure de l\'événement</label>';
    echo '<input type="datetime-local" id="entrepont_datetime_field" name="entrepont_datetime_field" value="'. esc_attr($value) .'">';

}

add_action('add_meta_boxes', 'event_custom_metaboxes');



function entrepont_save_datetime_data($post_id) {

    if (!isset($_POST['entrepont_datetime_metabox_nonce'])) {

        return;  // si le nonce n'a pas été créé on arrête l'éxecution
    }

    if (! wp_verify_nonce($_POST['entrepont_datetime_metabox_nonce'], 'entrepont_save_datetime_data')) {
        return;  // on verifie si le nonce est valide et créé par WP, sinon on on arrête l'éxecution 
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;    // on verifie s'il s'agit d'un enregistrement automatique de WP, dans ce cas 

    }

    if (!(current_user_can('edit_post', $post_id))) {
        return;     // on verifie si l'utilisateur a les permissions d'éditer un post
    }

    if(! isset ($_POST['entrepont_datetime_field'])) {
        return;     //  on verifie si le champ date a été rempli
    }

    $event_date = sanitize_text_field($_POST['entrepont_datetime_field']);

    update_post_meta($post_id, 'datetime_value_key', $event_date);

}

add_action('save_post', 'entrepont_save_datetime_data');





// affichage colonne date événement dans le tableau de bord


function posts_column_datetime($defaults){
    unset($defaults['date']);

    $defaults['event_datetime'] = __('Date et heure');
    return $defaults;
}

function posts_custom_column_datetime($column_name, $post_id){
        if($column_name === 'event_datetime'){
        echo get_post_meta($post_id, 'datetime_value_key', true);
    }
}

add_filter('manage_event_posts_columns', 'posts_column_datetime');
add_action('manage_event_posts_custom_column', 'posts_custom_column_datetime',5,2);



