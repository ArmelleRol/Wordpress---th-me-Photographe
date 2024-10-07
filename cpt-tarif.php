<?php
//=========================================================================
//==============   CPT tarif
//=========================================================================


//Initialize custom post type 
function photographe_tarif_init() {

	$labels = array(
		'name' => 'Tarifs',
		'singular_name' => 'tarif',
		'add_new' => 'Ajouter un élément',
		'add_new_item' => 'Ajouter un tarif',
		'edit_item' => 'Modifier un tarif',
		'new_item' => 'Nouveau tarif',
		'all_items' => 'Voir la liste',
		'view_item' => 'Voir l\'élément',
		'search_item' => 'Chercher un tarif',
		'not_found' => 'Aucun élément trouvé',
		'not_found_in_trash' => 'Aucun media dans la corbeille',
		'menu_name' => 'Tarifs'
		);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'publicly_queryable' => true,
		'query_var' =>true,
		'rewrite' => array('slug' => 'photographe_tarif'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 15,
		'menu_icon' =>  'dashicons-calculator',
		'exclude_from_search' => false,
		'supports' => array('title', 'editor','page-attributes','thumbnail','page')
	);


	register_post_type('photographe_tarif', $args);	

}  // end function 


//----------------Action hook to initialize the custom post type 
add_action('init', 'photographe_tarif_init');

//================================================================================
//==============    ajout de l'image et ordre dans la colonne admin 
//================================================================================

add_filter('manage_edit-photographe_tarif_columns', 'photographe_tarif_col_change');  // change nom colonnes

function photographe_tarif_col_change($columns)  {     
    $columns['photographe_tarif_image_order'] = "Ordre"; 
    $columns['photographe_tarif_image'] = "Image affichée";  

    return $columns;    
    }

add_action('manage_photographe_tarif_posts_custom_column', 'photographe_tarif_content_show', 10 ,2);  // affiche contenu

function photographe_tarif_content_show($column, $post_id)  { 
    global $post;  
    if ( $column == 'photographe_tarif_image' ) {
        echo the_post_thumbnail(array(200,100));    
        }
    if ( $column == 'photographe_tarif_image_order' ) {
        echo $post->menu_order; 
        }
    }

//================================================================================
//==============    tri auto sur l'ordre dans la colonne admin pour le slider
//================================================================================

function photographe_tarif_change_slides_order($query){

    global $post_type, $pagenow; 

    if($pagenow == 'edit.php' && $post_type == 'photographe_tarif'){ 
        $query->query_vars['orderby'] = 'menu_order';
        $query->query_vars['order'] = 'asc';
    }   
}
add_action('pre_get_posts','photographe_tarif_change_slides_order');




add_filter('manage_edit-photographe_tarif_sortable_columns', 'my_sortable_cake_column3');  // change nom colonnes

function my_sortable_cake_column3($columns)  {  
    $columns['photographe_tarif_image_order'] = "menu_order"; 
  

    return $columns;    
    }


//=========================================================================
//==============   meta boxes pour custom post type photographe_tarif 
//=========================================================================
function photographe_tarif_register_meta_box() {
    add_meta_box('photographe_tarif_meta','Tarifs','photographe_tarif_meta_building', 'photographe_tarif', 'normal', 'high');  
}  // end function photographe_tarif_register_meta_box

function photographe_tarif_meta_building($post) {
    $photographe_tarif_meta_prix = get_post_meta($post->ID, '_tarif_meta_prix', true);
    $photographe_tarif_meta_titre = get_post_meta($post->ID, '_tarif_meta_titre', true);
    $photographe_tarif_meta_description = get_post_meta($post->ID, '_tarif_meta_description', true);

    wp_nonce_field('photographe_tarif_meta_box_saving', 'photographe_tarif_25896');

    echo '<div>';
    echo '<p><label for="tarif_detail_prix">Tarif -&gt;&nbsp;</label>';
    echo '<input type="text" size="30" value="'.$photographe_tarif_meta_prix. '"   id="tarif_detail_prix" name="tarif_detail_prix"></p>';

    echo '<p><label for="tarif_detail_titre">Titre -&gt;&nbsp;</label>';
    echo '<input type="text" size="30" value="'.$photographe_tarif_meta_titre. '"   id="tarif_detail_titre" name="tarif_detail_titre"></p>';

    echo '<p><label for="tarif_detail_description">Description -&gt;&nbsp;</label>';
    echo '<textarea style="width:480px ; height:157px" id="tarif_detail_description" name="tarif_detail_description">'.$photographe_tarif_meta_description.'</textarea></p>';
    echo '</div>';
}  // end function photographe_tarif_meta_building

//---------------Action hook to initialize the meta boxes for photographe_tarif custom post type
add_action('add_meta_boxes', 'photographe_tarif_register_meta_box');

//=========================================================================
//==============   sauvegarde meta boxes pour custom post type photographe_tarif 
//=========================================================================
function photographe_tarif_save_meta_box($post_id) {

    if (get_post_type($post_id) == 'photographe_tarif' && isset($_POST['tarif_detail_prix'])) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }
        check_admin_referer('photographe_tarif_meta_box_saving', 'photographe_tarif_25896');
        update_post_meta($post_id, '_tarif_meta_prix', sanitize_text_field($_POST['tarif_detail_prix']));
        update_post_meta($post_id, '_tarif_meta_titre', sanitize_text_field($_POST['tarif_detail_titre']));
        update_post_meta($post_id, '_tarif_meta_description', sanitize_text_field($_POST['tarif_detail_description']));
    }

}  // end function photographe_tarif_save_meta_box

// ----------Action hook to save meta-box data when the post is saved
add_action('save_post','photographe_tarif_save_meta_box');



//================================================================================
//==============    taxonomie
//================================================================================

    function photographe_define_taxononomy_tarif()  {

    $labels = array(
        'name' => 'Type de prestations',
        'singular_name' => 'Types',
        'all_items' => 'tous les types',
        'edit_item' => 'modifier le types',
        'update_item' => 'mettre à jour le type',
        'add_new_item' => 'ajouter un type',
        'search_items' => 'Rechercher dans les types',
        'new_item_name' => 'nouveau nom du type',
        'menu_name' => 'Type des prestations',
        'parent_item' => 'Type de projet parent',
    );


    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'tarif'),
        'show_admin_column' => true,
        );

    register_taxonomy('prestations','photographe_tarif', $args); // nom de la taxonomie, nom du custom post type(registerposttype), variable 

}

// ----------Action hook to create taxonomy
add_action('init', 'photographe_define_taxononomy_tarif');
