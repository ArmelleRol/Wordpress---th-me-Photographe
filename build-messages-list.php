<?php 
// utilise le hook after switch theme car l'operation n'a pas
// besoin d'être réalisé à chaque chargement de page, 
//executé une seule fois , uniquement une fois que le thème est en place
function photographe_create_table_contact()  {
	global $wpdb; // global pour le rendre accessible avec ses 
	//propriété et ses méthodes 
	$tablename = $wpdb->prefix . "contacts"; // définit le nom de la table 
	//en prenom le prefixe de la base de données qui est le nom que l'on 
	//donne à la table qui est stocké dans le fichier wp-config	

	if ( $wpdb->get_var("SHOW TABLES LIKE '$tablename'") != $tablename) { 
		// verifier si la table existe sinon on la créé get var-> créé des requetes 
	// requete sql de creation de table 
		$sql = "CREATE TABLE `$tablename` (
		  `ctc_id` bigint(20) NOT NULL AUTO_INCREMENT, /*identique bdd wordpress */
		  `created_at` datetime,  
		  `ctc_nom` varchar(35) NOT NULL,
		  `ctc_prenom` varchar(35) NOT NULL,
		  `ctc_mail` varchar(35) NOT NULL,
		  `ctc_telephone` int(1) NULL,
		  `ctc_prestations` varchar(35) NOT NULL,
		  `ctc_message` text NOT NULL,
		  PRIMARY KEY (`ctc_id`),
		  INDEX (created_at)
		  ) ENGINE=innoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";
	}

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); //abspath designe le repertoire 
		// du site voir fonction dbDeleta dans le fichier wp admin

		dbDelta($sql);//necessaire pour créer table dans bdd n'est pas chargé 
		//par defaut dans wordpress, chargé le dossier au dessus

}  // fin  photographe_create_table_contact

add_action( "after_switch_theme", "photographe_create_table_contact" );



//=========================================================================
//==============   Page des messages contact
//=========================================================================
function photographe_contact_create_menu() {
	add_menu_page( 
		'messages', // affiche dans le titre onglet nav
		'Messages', // apparait dans le menu du tableau de bord
		'edit_pages', // capacité pour voir la page -> role
		'messages_recus' , // slug
		'photographe_create_page_contact', // fonction créé le contenu 
		'dashicons-email-alt', // icone
		  6
		);
}  //fin fn photographe_contact_create_menu


function photographe_create_page_contact() {

	global $wpdb;
	$tablename = $wpdb->prefix . "contacts";	
// requete sql select tous les messages de la table par ordre creation 
	$sql = "SELECT *, DATE_FORMAT(created_at, '%e/%m/%Y à %H:%i') AS date_formatted
			FROM `$tablename`
			ORDER BY `created_at` DESC";
	$result = $wpdb->get_results( $sql, OBJECT);  // fonction get results passe la requete 
	//et sous quel forme ici object (affiche les resultats avec ->)
	 ?>

<!-- affichage -->
	<div class="container" style="margin-top:40px;">
		<div class="row">
			<div class="col">
				<h1>Liste des messages reçus</h1>
				<table id="table-messages" class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Date</th>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Email</th>
							<th>Téléphone</th>
							<th>Prestations</th>
							<th>Message</th>
							<th>&nbsp;</th> <!-- bouton pour effacer champ vide  --> 
						</tr>
					</thead>

					<tbody>
						<?php foreach ($result as $res): // boucle pour affciher les resultats de la requete 
						//$ result = résultat de la requete tous le senregistrement dans la table contact 
						//resultat sous forme d'objet donc avce la fleche 
							echo '<tr>';
							echo '<td>', $res->ctc_id, '</td>';
							echo '<td>', $res->date_formatted, '</td>';
							echo '<td>', $res->ctc_nom, '</td>';
							echo '<td>', $res->ctc_prenom, '</td>';
							echo '<td>', $res->ctc_mail, '</td>';
							echo '<td>', $res->ctc_telephone, '</td>';
							echo '<td>', $res->ctc_prestations, '</td>';
							echo '<td>', stripslashes($res->ctc_message), '</td>'; // fonction pour enlever 
							//les cracateres avec slash ou apostrophes 
							echo '<td><a class="btn btn-default deletable" data-id="'.$res->ctc_id.'">X</a></td>'; 
							// bouton  avec croix  data-id attribut html5 pour requete ajax avec javascript avec 
							//attribut ctcid btn bootsrap
							echo '</tr>';
						endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div><!-- /container -->



<?php
}  // fin fn lgmac_create_page_contact


add_action( 'admin_menu', 'photographe_contact_create_menu');