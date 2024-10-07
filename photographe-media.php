<?php 

//=========================================================================
//==============   custom post type photographe_media 
//=========================================================================

//Initialize custom post type photographe-media
function photographe_media_init() {

	$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Ajouter un portfolio',
		'add_new_item' => 'Ajouter un Portfolio',
		'edit_item' => 'Modifier  un  Portfolio',
		'new_item' => 'Nouveau portfolio',
		'all_items' => 'Voir les portfolios',
		'view_item' => 'Voir le portfolio',
		'search_item' => 'Chercher un porfolio',
		'not_found' => 'Aucun élément trouvé',
		'not_found_in_trash' => 'Aucun media dans la corbeille',
		'menu_name' => 'Portfolio'
		);

	$args = array(
		'labels' => $labels, // variable  tableau qui contient les valeurs $labels plus tot
		'public' => true, 
		'publicly_queryable' => true, // si on peut faire des requetes 
		'show_ui' => true, ///si cpt visble interface et depuis le site false ex journal derreurs 
		'show_in_menu' => true, // si elt apparait dans le menu
        'show_in_nav_menus'=>true,
		'query_var' =>true, // celui au dessus doit etre egal a true - requete spécifique 
		'rewrite' => array('slug' => 'portfolio'), // plusieurs valeurs boolean ou tableau : slug, pages ... depend du permaliens 
		'capability_type' => 'post', // role utilisateurs post = 
		'has_archive' => true, // si page archive est utilisable ou pas 
		'hierarchical' => false, // hierarchie dans le cpt -> article false et page oui parent / enfant 
		'menu_position' => 10, // position dans le tableau de bord 
		'menu_icon' =>  'dashicons-portfolio',
		'exclude_from_search' => false,
		/*'taxonomies'=>array('post_tag', 'thumbnail'),*/
		'supports' => array('title', 'editor', 'thumbnail', 'page') // supports codex 
	);


	register_post_type('portfolio_media', $args);	

}  // end function lgmac_media_init



//----------------Action hook to initialize the custom post type photographe_media
add_action('init', 'photographe_media_init');


//=========================================================================
//==============   custom taxonomy pour photographe-media 
//=========================================================================
function photographe_define_taxononomy_prestations()  {

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
		'query_var' => true,
		'rewrite' => array('slug' => 'prestations'),
		'show_admin_column' => true,
		);

	register_taxonomy('prestations', array('portfolio_media', 'photographe_mariage'), $args); // nom de la taxonomie, nom du custom post type(registerposttype), variable 

}

// ----------Action hook to create taxonomy
add_action('init', 'photographe_define_taxononomy_prestations');



//=========================================================================
//==============   meta boxes pour custom post type photographe_media 
//=========================================================================

function photographe_media_register_meta_box()  {
	add_meta_box(
		'photographe_media_meta',
		'Portfolio',
		'photographe_media_meta_building', 
		'portfolio_media',
		'normal',
		'high');
	// nom interne metabox, titre associé metabox, nom fonction contenu metabox, tyoe de contenu sapplique la metabox, contexte = normal juste en dessous de l'éditeur, priorité)
}  // end function  photographe_media_register_meta_box


// focntion contenu de la metabox 
function photographe_media_meta_building($post) { 
	$photographe_prestations = get_post_meta($post->ID, '_media_meta_prestations', true);
	wp_nonce_field('photographe_media_meta_box_saving', 'photographe_25896'); // id + valeur permet de verifier que la personne 

	$photographe_prestations = array(1 =>'Mariages', 2=>'Grossesse_lifestyle', 3=>'Portrait', 4=>'Evenement_professionnel');
	
	for($i='mariages'; $i<'Evenement_professionnel'; $i++) { $photographe_prestations[] = $i; }


	echo '<div>';
	echo '<p><label for="media_detail_prestations"> Prestations -&gt;&nbsp;</label>';
	echo '<select id="media_detail_prestations" name="media_detail_prestations">';
		foreach($photographe_prestations as $photographe_prestation):
			echo '<option value="' . $photographe_prestation . '"' . selected($photographe_meta_prestations, $photographe_prestation, false). '>' . $photographe_prestation . '</option>';
		endforeach;
	echo '</select></p>';
	echo '</div>';

}  // end function  mv_media_meta_building


//---------------Action hook to initialize the meta boxes for lgmac_media custom post type
add_action ('add_meta_boxes', 'photographe_media_register_meta_box');


//=========================================================================
//==============   sauvegarde meta boxes pour custom post type photographe_media 
//=========================================================================

function photographe_media_save_meta_box($post_id) {

	if ( get_post_type( $post_id ) == 'photographe_media' && isset( $_POST['media_detail_prestations'] ) ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {  return;  } // verifie si wordpress fait une sauvegarde automatique, on n'execute pas le reste de la focntion, sinon aller retour bdd et ralentit performance 
		check_admin_referer('photographe_media_meta_box_saving', 'photographe_25896'); // meme id + meme valeur // permet de vrifier piratage iintrusion 
		update_post_meta($post_id, '_media_meta_prestations',       sanitize_text_field($_POST['media_detail_prestations'])); // met a jour la metadonné param id post + nom metabox crée en interne dans la bdd + contenu 
	}
}


