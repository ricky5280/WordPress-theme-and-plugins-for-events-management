<?php 

/**
 * Essential theme supports
 * */

function entrepont_customtheme_supports() {

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); 
    add_theme_support('menus'); 
    add_theme_support( 'custom-logo', array(
        'header-text' => array('site-title', 'site-description'),
        'height' => 50,
        'width' => 50, 
        'flex-height' => true,
        'flex-width' => true,
        ));
    register_nav_menu('header', 'En tete du menu');
    register_nav_menu('footer', 'Pied de page');

    add_image_size('card-event', 350, 215, true);
    add_image_size('single-event', 600, 350, true);

};

add_action('after_setup_theme', 'entrepont_customtheme_supports');


/**
 * Theme assets     
 * */

function entrepont_customtheme_register_assets() {

    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('main_stylesheet', get_stylesheet_uri(), [], 1.0);

    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js',
     ['popper', 'jquery'], 4.6, true);  //dependences: on déclare que bootstrap a besoin de popper et jquery

    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', 
    [], 1.16, true);
    
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', [], false, true);

    wp_enqueue_script('bootstrap');

};

add_action('wp_enqueue_scripts', 'entrepont_customtheme_register_assets');


// ajout de la class nav-item aux <li>
function entrepont_customtheme_menu_class($classes)
{    
    $classes[] = 'nav-item';
    return $classes;
}

add_filter('nav_menu_css_class', 'entrepont_customtheme_menu_class');


// ajout de la class nav-link aux <a>
function entrepont_customtheme_link_class($attrs)
{    
    $attrs['class'] = 'nav-link';
    return $attrs;
}

add_filter('nav_menu_link_attributes', 'entrepont_customtheme_link_class');


// ajout de métadonnées
// ajout d'une méta box avec fonction associée
function entrepont_customtheme_add_custom_box() {
    add_meta_box('event_date', 'calendar', 'entrepont_customtheme_render_calendar_box', 'post', 'side');
}

function entrepont_customtheme_render_calendar_box($post_id) {
        
        global $wpdb;
        $db = $wpdb->prefix . 'postmeta';
        $event_id = get_the_id();
        $event_date = $wpdb->get_var("SELECT meta_value FROM $db WHERE post_id = $event_id AND meta_key = event_datetime");

        echo $event_date;

        //$value = get_post_meta($post_id, 'event_datetime', true);
        // var_dump($value);
        // die();
    ?>
        <label for="event_datetime">Date et heure de l'événement</label>
        <input type="datetime-local" id="event_datetime" name="event_datetime"  value="<?= $event_date; ?>"><br>            

    <?php
}

add_action('add_meta_boxes', 'entrepont_customtheme_add_custom_box');


// sauvegarde métadonnée date et heure en bdd
function entrepont_customtheme_save_datetime($post_id) {
    if(array_key_exists('event_datetime', $_POST) && current_user_can('edit_post', $post_id))  {
           update_post_meta($post_id, 'event_datetime', ($_POST['event_datetime']));
        }
    } 

add_action('save_post', 'entrepont_customtheme_save_datetime');



// taxonomies 
// function entrepont_customtheme_init() {
//     register_taxonomy('discipline', 'post', [
//         'labels' => [
//             'name' => 'Discipline',
//             'singular_name' => 'Discipline',
//             'plural_name' => 'Disciplines',
//             'search_items' => 'Rechercher des disciplines',
//             'all_items' => 'Toutes les disciplines',
//             'edit_item' => 'Editer la discipline',
//             'add_new_item' => 'Ajouter une discipline'            
//         ],
//         'show_in_rest' => 'true',   // pour affichage dans l'administration
//         'hierarchical' => 'true',   // pour afficher taxonomie en check-box
//         'show_admin_column' => 'true'   // pour afficher taxonomie dans la liste d'articles
//     ]);

//     register_taxonomy('lieu', 'post', [
//         'labels' => [
//             'name' => 'Lieu',
//             'singular_name' => 'Lieu',
//             'plural_name' => 'Lieux',
//             'search_items' => 'Rechercher des lieux',
//             'all_items' => 'Tous les lieux',
//             'edit_item' => 'Editer le lieu',
//             'add_new_item' => 'Ajouter un lieu'            
//         ],
//         'show_in_rest' => 'true',   // pour affichage dans l'administration
//         'hierarchical' => 'true',   // pour afficher taxonomie en check-box
//         'show_admin_column' => 'true'   // pour afficher taxonomie dans la liste d'articles
//     ]);

    
    // register_post_type('events', [
    //     'label' => 'Evénements',
    //     'public' => true,
    //     'menu_position' => 3,
    //     'menu_icon' => 'dashicons-calendar-alt'    

    // ]);

    // register_taxonomy('discipline', 'events', [
    //     'label' => 'Disciplines'
    // ]);

    // register_taxonomy('category', 'events', [
    //     'label' => 'Catégories'
    // ]);

    // register_taxonomy('lieu', 'events', [
    //     'label' => 'Lieux'
    // ]);

// }

// add_action('init', 'entrepont_customtheme_init');



function entrepont_register_widget() {

    require_once 'widgets/YouTubeWidget.php';
    
    register_widget(YouTubeWidget::class);
    
    register_sidebar([
        'id' => 'homepage',
        'name' => 'Sidebar Accueil', 
        'before_widget' => '<div class="p-4 %2$s" id="%1$s" >',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="fst-italic">',
        'after_title' => '</h4>'

    ]);

}

add_action('widgets_init', 'entrepont_register_widget');



// Masquer la version de WordPress des liens scripts et style

function fjarrett_remove_wp_version_strings( $src ) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
    $src = remove_query_arg('ver', $src);
    }
    return $src;
    }
    add_filter( 'script_loader_src', 'fjarrett_remove_wp_version_strings' );
    add_filter( 'style_loader_src', 'fjarrett_remove_wp_version_strings' );
    