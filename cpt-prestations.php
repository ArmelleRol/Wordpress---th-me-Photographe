<?php

//=========================================================================
//==============   CPT mes prestations
//=========================================================================


function photographe_register_post_types() {
    // La déclaration de nos Custom Post Types
    $labels = array(
        'name' => 'Mes prestations',  // nom tableau de bord
        'singular_name' => 'Prestations',
        'add_new' => 'Ajouter une prestation',
        'add_new_item' => 'Ajouter une prestation',
        'edit_item' => 'Modifier  une prestation',
        'new_item' => 'Nouveau',
        'all_items' => 'Voir la liste',
        'view_item' => 'Voir l\'élément',
        'search_item' => 'Chercher une prestation',
        'not_found' => 'Aucun élément trouvé',
        'not_found_in_trash' => 'Aucun élément dans la corbeille',
        'menu_name' => 'Mes prestations',
        );

    $args = array(
        'labels' => $labels, // 
        'public' => true, // si public 
        'publicly_queryable' => true, // acces par une requete 
        'show_ui' => true, 
        'show_in_menu' => true,
        'show_in_nav_menu' => true,
        'query_var' =>true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierachical' => false,
        'supports' => array( 'title', 'editor','thumbnail', 'page-attributes' ),
        'menu_position' => 5, 
        'menu_icon' => 'dashicons-star-filled',
    );

    register_post_type( 'mes_prestations', $args );
}
add_action( 'init', 'photographe_register_post_types' );


//================================================================================
//==============    ajout de l'image et ordre dans la colonne admin 
//================================================================================

add_filter('manage_edit-mes_prestations_columns', 'photographe2_col_change');  // change nom colonnes

function photographe2_col_change($columns)  {     
    $columns['menu_order'] = "Ordre"; 
    $columns['mes_prestations_image'] = "Image affichée";  

    return $columns;    
    }

add_action('manage_mes_prestations_posts_custom_column', 'photographe2_content_show', 10 ,2);  // affiche contenu

function photographe2_content_show($column, $post_id)  { 
    global $post;  
    if ( $column == 'mes_prestations_image' ) {
         echo get_the_post_thumbnail($post_id, array(200, 100));  
        }
    if ( $column == 'menu_order' ) {
        echo $post->menu_order; 
        }
    }

//================================================================================
//==============    tri auto sur l'ordre dans la colonne admin pour le slider
//================================================================================

function photographe_change_slides_order3($query){

    global $post_type, $pagenow; 

    if($pagenow == 'edit.php' && $post_type == 'mes_prestations'){ 
        $query->query_vars['orderby'] = 'menu_order';
        $query->query_vars['order'] = 'asc';
    }   
}
add_action('pre_get_posts','photographe_change_slides_order3');




add_filter('manage_edit-mes_prestations_sortable_columns', 'my_sortable_cake_column4');  // change nom colonnes

function my_sortable_cake_column4($columns)  {  // définir la colonne pour qu'elle soit triable 
    $columns['menu_order'] = "menu_order"; 
  

    return $columns;    
    }


//=========================================================================
//==============   meta boxes pour custom post type 
//=========================================================================
function lgmac_media_register_meta_box2()  {
    add_meta_box('lgmac_media_meta','Presentation','lgmac_media_meta_building2', 'mes_prestations', 'normal', 'high'); 
}  // end function  lgmac_media_register_meta_box

function lgmac_media_meta_building2($post) {
    $lgmac_meta_titre = get_post_meta($post->ID, '_media_meta_titre', true);
    $lgmac_meta_description = get_post_meta($post->ID, '_media_meta_description', true);
    $lgmac_meta_titre1 = get_post_meta($post->ID, '_media_meta_titre1', true);
    $lgmac_meta_description1 = get_post_meta($post->ID, '_media_meta_description1', true);
    $lgmac_meta_titre2 = get_post_meta($post->ID, '_media_meta_titre2', true);
    $lgmac_meta_description2 = get_post_meta($post->ID, '_media_meta_description2', true);
    $lgmac_meta_titre3 = get_post_meta($post->ID, '_media_meta_titre3', true);
    $lgmac_meta_description3 = get_post_meta($post->ID, '_media_meta_description3', true);

    wp_nonce_field('lgmac_media_meta_box_saving2', 'lgmac_25896');



    echo '<div>';

    echo '<p><label for="media_detail_titre">Titre -&gt;&nbsp;</label>';
    echo '<input type="text" size="30" value="'.$lgmac_meta_titre. '"   id="media_detail_titre" name="media_detail_titre"></p>';

    echo '<p><label for="media_detail_description">Description -&gt;&nbsp;</label>';
    echo '<input type="textarea"  style="width:480px ; height:157px"  value="'.$lgmac_meta_description.'"  id="media_detail_description" name="media_detail_description"></p>';


    echo '<p><label for="media_detail_titre1">Bloc 1 Titre -&gt;&nbsp;</label>';
    echo '<input type="text" size="30" value="'.$lgmac_meta_titre1. '"   id="media_detail_titre1" name="media_detail_titre1"></p>';

    echo '<p><label for="media_detail_description1">Description -&gt;&nbsp;</label>';
    echo '<input type="textarea"  style="width:480px ; height:157px"  value="'.$lgmac_meta_description1.'"  id="media_detail_description1" name="media_detail_description1"></p>';

     echo '<p><label for="media_detail_titre2">Bloc 2 Titre -&gt;&nbsp;</label>';
    echo '<input type="text" size="30" value="'.$lgmac_meta_titre2. '"   id="media_detail_titre2" name="media_detail_titre2"></p>';

    echo '<p><label for="media_detail_description2">Description -&gt;&nbsp;</label>';
    echo '<input type="textarea"  style="width:480px ; height:157px"  value="'.$lgmac_meta_description2.'"  id="media_detail_description2" name="media_detail_description2"></p>';

     echo '<p><label for="media_detail_titre3">Bloc 3 Titre -&gt;&nbsp;</label>';
    echo '<input type="text" size="30" value="'.$lgmac_meta_titre3. '"   id="media_detail_titre3" name="media_detail_titre3"></p>';

    echo '<p><label for="media_detail_description3">Description -&gt;&nbsp;</label>';
    echo '<input type="textarea"  style="width:480px ; height:157px"  value="'.$lgmac_meta_description3.'"  id="media_detail_description3" name="media_detail_description3"></p>';
    echo '</div>';

    
}  // end function  mv_media_meta_building



//---------------Action hook to initialize the meta boxes for lgmac_media custom post type
add_action ('add_meta_boxes', 'lgmac_media_register_meta_box2');



//=========================================================================
//==============   sauvegarde meta boxes pour custom post type lgmac_media 
//=========================================================================

function lgmac_media_save_meta_box2($post_id) {

    if ( get_post_type( $post_id ) == 'mes_prestations' && isset( $_POST['media_detail_titre'] ) ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {  return;  }
        check_admin_referer('lgmac_media_meta_box_saving2', 'lgmac_25896');
        update_post_meta($post_id, '_media_meta_titre',  sanitize_text_field($_POST['media_detail_titre']));
        update_post_meta($post_id, '_media_meta_description',  sanitize_text_field($_POST['media_detail_description']));
        update_post_meta($post_id, '_media_meta_titre1',  sanitize_text_field($_POST['media_detail_titre1']));
        update_post_meta($post_id, '_media_meta_description1',  sanitize_text_field($_POST['media_detail_description1']));
         update_post_meta($post_id, '_media_meta_titre2',  sanitize_text_field($_POST['media_detail_titre2']));
        update_post_meta($post_id, '_media_meta_description2',  sanitize_text_field($_POST['media_detail_description2']));
         update_post_meta($post_id, '_media_meta_titre3',  sanitize_text_field($_POST['media_detail_titre3']));
        update_post_meta($post_id, '_media_meta_description3',  sanitize_text_field($_POST['media_detail_description3']));
    }

}  // end function lgmac_media_save_meta_box


// ----------Action hook to save meta-box data when the post is saved
add_action('save_post','lgmac_media_save_meta_box2');

