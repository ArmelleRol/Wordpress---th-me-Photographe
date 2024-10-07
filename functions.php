<?php 

//=========================================================================
//==============    ajout gestion des sessions
//=========================================================================
function photographe_session_start() {
   if ( !session_id() ) {
      @session_start();

   }
}
add_action( 'init', 'photographe_session_start', 1 );

require('includes/cpt-tarif.php');
require('includes/cpt-prestations.php');

//=========================================================================
//==============                  utilitaires
//=========================================================================
function photographe_setup()  {

    //support des vignettes
    add_theme_support( 'post-thumbnails' );

    // crée format image 
    add_image_size('front-slider', 800, 420, true);
    add_image_size('presentation', 600, 300, true);
    add_image_size('tarif', 400,400, true);
    add_image_size('blog', 300, 300, true);


    //enlève générateur de version
    remove_action('wp_head', 'wp_generator');

    // enlève les guillemets à la française
    remove_filter ('the_content', 'wptexturize');

    // support du titre
    add_theme_support( 'title-tag' );

    // Register Custom Navigation Walker
    require_once('includes/class-wp-bootstrap-navwalker.php');

    // active la gestion des menus
    register_nav_menus( array( 'primary' => 'principal') );  

    add_theme_support('menus');


} // fin function photographe_setup
add_action('after_setup_theme', 'photographe_setup');

//=========================================================================
//==============              chargement des styles/scripts 
//=========================================================================


function photographe_scripts() {

  
    //wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.7.1.min.js',
            array(), true);
        wp_enqueue_script('jquery');

    // Déclarer le JS
    wp_enqueue_script(  'photographe', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0',  true);
    
    //Déclarer le fichier style.css à la racine du thème
    wp_enqueue_style(  'photographe', get_stylesheet_uri() .'/style.css',array(), '1.0'  );
    

    // chargement des styles
    wp_enqueue_style( 'photographe-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'all' );
    wp_enqueue_style( 'photographe-bootstrap-bundle', get_template_directory_uri() . '/css/bootstrap.bundle.min.css', array(), 'all' );

        wp_enqueue_style( 'photographe-animate', get_template_directory_uri() . '/css/animate.css', array(), 'all' );
        wp_enqueue_style( 'photographe-global-css', get_template_directory_uri() . '/style.css', 
            array('photographe-bootstrap-css', 'photographe-animate', 'photographe-bootstrap-bundle'),   'all' );

        wp_enqueue_style( 'photographe-global-css', get_template_directory_uri() . '/style.css', 
            array('photographe-bootstrap-css', 'photographe-bootstrap-bundle'), 'all' );



    // chargement des scripts
    if( !is_admin() ){
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.7.1.min.js',
            array(), true);
        //wp_enqueue_script('jquery');
    }


    wp_enqueue_script('popper-js', get_template_directory_uri() . '/js/popper.min.js', array('jquery'),  true ); 

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', 
        array('jquery', 'popper-js'), true ); 


    wp_enqueue_script( 'photographe_admin_script', get_template_directory_uri() . '/js/admin-script.js', array('jquery', 'bootstrap-js'),  true );


}
add_action('wp_enqueue_scripts', 'photographe_scripts');


//=========================================================================
//==============              chargement des styles/scripts dashboard
//=========================================================================

function photographe_admin_init()  {

    // *****************  action 1
    function photographe_admin_scripts() {
        if(isset($_GET['page'])  && ( $_GET['page'] == "messages_recus")):
            // chargement des styles admin
            wp_enqueue_style('photographe-bootstrap-adm-css', get_template_directory_uri() . '/css/bootstrap.min.css', array() );
            wp_enqueue_style('style-admin', get_template_directory_uri() . '/css/admin.css',
             array('photographe-bootstrap-adm-css') );

            // chargement des scripts admin
            wp_enqueue_media();
            wp_enqueue_script( 'photographe-admin-script', get_template_directory_uri() . '/js/admin-script.js', array(),  true ); 
        endif;

        }  // fin function photographe_admin_scripts

    add_action('admin_enqueue_scripts', 'photographe_admin_scripts' );


    }  // fin photographe_admin_init

add_action('admin_init', 'photographe_admin_init');






//=========================================================================
//==============   CPT slider frontal page d'accueil
//=========================================================================

function photographe_slider_init() {   
    
    $labels = array(
        'name' => 'Carousel Accueil',  // nom tableau de bord
        'singular_name' => 'Image accueil',
        'add_new' => 'Ajouter une image',
        'add_new_item' => 'Ajouter une Image accueil',
        'edit_item' => 'Modifier  une Image accueil',
        'new_item' => 'Nouveau',
        'all_items' => 'Voir la liste',
        'view_item' => 'Voir l\'élément',
        'search_item' => 'Chercher une Image accueil',
        'not_found' => 'Aucun élément trouvé',
        'not_found_in_trash' => 'Aucun élément dans la corbeille',
        'menu_name' => 'Slider Frontal'
        );
        
    $args = array(
        'labels' => $labels, //variable  tableau qui contient les valeurs $labels plus tot
        'public' => true, // si public 
        'publicly_queryable' => true, // acces par une requete 
        'show_ui' => true, //si cpt visble interface et depuis le site false ex journal derreurs 
        'show_in_menu' => true,// si elt apparait dans le menu
        'query_var' =>true, // celui au dessus doit etre egal a true - requete spécifique 
        'rewrite' => array('slug' => 'tarif'), // plusieurs valeurs boolean ou tableau : slug, pages ... depend du permaliens 
        'capability_type' => 'post',// role utilisateurs 
        'has_archive' => true, // si page archive est utilisable ou pas 
        'hierachical' => false, // hierarchie dans le cpt -> article false et page oui parent / enfant
        'menu_position' => 10, // position dans le tableau de bord  10 -> avant les médias voir codex 
         'menu_icon' => 'dashicons-admin-customizer', // icone slider 
        'supports' => array('title', 'page-attributes', 'thumbnail') // affiche dans l'éditeur 
    );
    
register_post_type('photographe_slider', $args);
    
}  // end function lgmac_slider_init

add_action('init', 'photographe_slider_init');


//================================================================================
//==============    ajout de l'image et ordre dans la colonne admin pour le slider
//================================================================================
//  

add_filter('manage_edit-photographe_slider_columns', 'photographe_col_change');  // change nom colonnes

function photographe_col_change($columns)  {  
    $columns['photographe_slider_image_order'] = "Ordre"; 
    $columns['photographe_slider_image'] = "Image affichée"; 

    return $columns;    
    }

add_action('manage_photographe_slider_posts_custom_column', 'photographe_content_show', 10 ,2);  // affiche contenu

function photographe_content_show($column, $post_id)  { 
    global $post;  
    if ( $column == 'photographe_slider_image' ) {
        echo the_post_thumbnail(array(200,100));    
        }
    if ( $column == 'photographe_slider_image_order' ) {
        echo $post->menu_order; 
        }

}


//================================================================================
//==============    tri auto sur l'ordre dans la colonne admin pour le slider
//================================================================================

function photographe_change_slides_order($query){

    global $post_type, $pagenow; 

    if($pagenow == 'edit.php' && $post_type == 'photographe_slider'){ 
        $query->query_vars['orderby'] = 'menu_order';
        $query->query_vars['order'] = 'asc';
    }   
}
add_action('pre_get_posts','photographe_change_slides_order');




add_filter('manage_edit-photographe_slider_sortable_columns', 'my_sortable_cake_column');  // change nom colonnes

function my_sortable_cake_column($columns)  {  
    $columns['photographe_slider_image_order'] = "menu_order"; 
  

    return $columns;    
    }


//=========================================================================
//==============                 sidebars and widgetized
//=========================================================================

function photographe_widgets_init() {
    register_sidebar( array(
        'name'          => 'Footer Widget Zone',
        'description'   => 'Widgets affichés dans le footer: 4 au maximum',
        'id'            => 'widgetized-footer',
        'before_widget' => '',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h2 class="h3 text-center">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'photographe_widgets_init' );




//=========================================================================
//===========   ajouter classe img-fluid à toutes les images incluses
//=========================================================================

function photographe_add_img_class( $class ) {
      $class .= ' img-fluid'; // bien mettre un espace devant la chaine de caractères
      return $class;
}
add_filter('get_image_tag_class', 'photographe_add_img_class');
      




//=========================================================================
//==============    opérations sur les messages de de contacts
//=========================================================================
include('includes/build-messages-list.php'); 

//=========================================================================
//==============   associer les fonctions à exécuter suite aux actions ajax
//=========================================================================



function fn_delete_message() {
    $id = $_POST['id']; // recupere id du traitement ajax
    global $wpdb;
    $tablename = $wpdb->prefix . "contacts"; // declare nom de la table 
    
    $sql = "DELETE FROM `$tablename`  WHERE `ctc_id`= '$id'"; // enregistrement bdd
    $result_delete = $wpdb->query($sql);  // variable resultat 

    if($result_delete == 1):
        echo 'success';
    else:
        echo 'failure';
    endif;

    die(); // obligatoire sinon die dans le fichier 
}

add_action( 'wp_ajax_delete_message', 'fn_delete_message' ); // action pour supprimer les messages
