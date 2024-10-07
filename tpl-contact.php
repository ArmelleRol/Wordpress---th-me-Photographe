<?php 
/**
 * Template Name: page contact
*/

// création de deux variables avec la focntion rand pour créer un nombre aléatoire entre  1 et 9 
$nb1 = rand(1,9);
$nb2 = rand(1,9);


if (isset($_POST['send'])): // si le formulaire est validé 

	// echo'<pre>';
	// var_dump($_POST);
	// echo'</pre>';

	$valid = true; // variable $ valid 
	$message = array(); // varaible $ message dans un tableau pour enregistrer les messages d'erreur 


// verification des champs 
	    // Validation du nom si vide message d'erreur  créer dans le tableau message avec la clé nom avec un message à afficher 
    //• Cette regex permet uniquement les lettres (avec accents), les tirets et les espaces. Elle impose aussi une longueur entre 2 et 50 caractères.
    // preg_match() ou filter_var() poir appliquer une validation plus spécifique regex
    if (empty($_POST['ctc-nom']) || !preg_match("/^[a-zA-ZÀ-ÿ\- ]{2,50}$/", $_POST['ctc-nom'])) {
        $message['nom'] = "Le nom est requis et doit contenir uniquement des lettres, espaces ou tirets (2-50 caractères).";
        $valid = false; // recharge ^la page si les champs ne sont pas remplis 
    }

    // Validation du prénom
    if (empty($_POST['ctc-prenom']) || !preg_match("/^[a-zA-ZÀ-ÿ\- ]{2,50}$/", $_POST['ctc-prenom'])) {
        $message['prenom'] = "Le prénom est requis et doit contenir uniquement des lettres, espaces ou tirets (2-50 caractères).";
        $valid = false; 
    }

    // Validation de l'email •  Utilise l'attribut type="email" qui vérifie automatiquement que l'entrée suit le format email standard.
    if (empty($_POST['ctc-mail']) || !filter_var($_POST['ctc-mail'], FILTER_VALIDATE_EMAIL)) {
        $message['mail'] = "Une adresse email valide est requise.";
        $valid = false; 
    }

    // Validation du téléphone •    Cette regex accepte un numéro de téléphone de 10 chiffres, avec ou sans indicatif pays (+33, etc.) et avec des séparateurs optionnels.
    if (empty($_POST['ctc-telephone']) || !preg_match("/^(\+?\d{1,3}[-.\s]?)?\d{10}$/", $_POST['ctc-telephone'])) {
        $message['telephone'] = "Un numéro de téléphone valide est requis (10 chiffres avec ou sans indicatif).";
        $valid = false;
    }

    // Validation des prestations
    $prestationsOptions = ['Mariage', 'Grossesse lifestyle', 'Portrait', 'Evénement professionnel'];
    if (empty($_POST['ctc-prestations']) || !in_array($_POST['ctc-prestations'], $prestationsOptions)) {
        $message['prestations'] = "Veuillez sélectionner une prestation valide.";
        $valid = false; 
    }

    // Validation du message
    if (empty($_POST['ctc-message']) || strlen($_POST['ctc-message']) < 10) {
        $message['message'] = "Le message est requis et doit contenir au moins 10 caractères.";
        $valid = false; 
    }

    // Si aucune erreur n'est trouvée, traiter le formulaire
    if (empty($message)) {
        // Traitez les données (ex : envoyez un email, enregistrez dans une base de données, etc.)
        // Redirigez ou affichez un message de succès
    } else {
        // Vous pouvez afficher les messages d'erreur dans le formulaire en les récupérant
        foreach ($message as $error) {
            echo "<div class='text-danger'>$error</div>";
        } 
        $valid = false; 
    }
 
 


	//teste le captcha meme valeur message car une seule possibilité à chaque fois 
    //est ce captcha vide recupere message avec clé cpatcha et renvoi formaulaire 
	$captcha = $_POST['captcha'];
	if (empty($captcha))  {
		$message['captcha'] = "vous n'avez pas saisi le résultat anti-spam";
		$valid = false; 
	} else if (!is_numeric($captcha))  {
        // si la clé n'est pas numérique message
		$message['captcha'] = "votre saisie anti-spam n'est pas numérique";	
		$valid = false; 
	} else if ($captcha != base64_decode($_POST['check1']) + base64_decode($_POST['check2']))  {
        // verifie si l'opération est juste 
		$message['captcha'] = "la saisie anti-spam ne correspond pas au résultat";	
		$valid = false; 
	}

// si formulaire est ok 
	if ( $valid == true):
		
		global $wpdb;
		$tablename = $wpdb->prefix . "contacts";

	  $ctc_data = array(
		  'ctc_nom' => sanitize_text_field($_POST['ctc-nom']), //récupère les différents champs
		  'ctc_prenom' => sanitize_text_field($_POST['ctc-prenom']),
		  'ctc_mail' => sanitize_email($_POST['ctc-mail']),     
		  'ctc_telephone' 	=> sanitize_text_field($_POST['ctc-telephone']),
		  'ctc_prestations' => sanitize_text_field($_POST['ctc-prestations']),
		  'ctc_message' => sanitize_textarea_field($_POST['ctc-message']),
		  'created_at'	=> current_time('mysql', 0) // date et heure ou le formulaire est rmepli --
		  //  fonction (now) wpdb pas accès au fonction sql -> utilise fonction current time avec format sql
		  // et 2eme parametre 0=temps local(reglages définit dans les réglages de wordpress)
		  //et 1 temps utc 
          // @mailto pour envoyer les messages vers une  autre adresse mail
		);



		if($wpdb->insert($tablename, $ctc_data)): // fonction avec parametre table à modifier et contenu des données à modifier --  insert pour modifier requete => fonction qui protège les données - sécurisation des données - contre le code illicite 
			if(session_id()):
				$_SESSION['contact-result'] = "Votre message est envoyé, nous vous répondrons prochainement";
			endif;
			wp_redirect(home_url()); 
		endif;

	endif;




endif; // validation du formulaire


get_header();
?>

<section class="formulaire">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-sm-12 col-lg-6 col-xl-6">
                <h1>Nous contacter</h1>
                <form id="lg-contact" action="<?php the_permalink(); ?>" method="post">
                    <p>Utilisez ce formulaire pour nous contacter, nous vous répondrons dans les meilleurs délais.</p>

                    <div class="form-group">
                        <label for="ctc-nom">Nom</label>
                        <?php if (isset($message['nom'])) { ?>
                            <div class="text-white bg-danger px-3"><?php echo $message['nom']; ?></div>
                        <?php } ?> 
                        <!-- operateur ternaire php si $_post ctc nom existe formulaire validé, attribue la valeur avec esc-attr par mesure de sécurité -->
                        <input type="text" class="form-control" id="ctc-nom" name="ctc-nom" size="50" placeholder="Votre Nom..."
                               value="<?php echo (isset($_POST['ctc-nom'])) ? esc_attr($_POST['ctc-nom']) : ''; ?>" 
                               pattern="^[a-zA-ZÀ-ÿ\- ]{2,50}$" required />
                        <small class="text-danger"><b>* Requis</b></small>
                    </div>

                    <div class="form-group">
                        <label for="ctc-prenom">Prénom</label>
                        <?php if (isset($message['prenom'])) { ?>
                            <div class="text-white bg-danger px-3"><?php echo $message['prenom']; ?></div>
                        <?php } ?>
                        <input type="text" class="form-control" id="ctc-prenom" name="ctc-prenom" size="50" placeholder="Votre Prénom..."
                               value="<?php echo (isset($_POST['ctc-prenom'])) ? esc_attr($_POST['ctc-prenom']) : ''; ?>"
                               pattern="^[a-zA-ZÀ-ÿ\- ]{2,50}$" required />
                        <small class="text-danger"><b>* Requis</b></small>
                    </div>

                    <div class="form-group">
                        <label for="ctc-mail">Votre email</label>
                        <?php if (isset($message['mail'])) { ?>
                            <div class="text-white bg-danger px-3"><?php echo $message['mail']; ?></div>
                        <?php } ?>
                        <input type="email" class="form-control" id="ctc-mail" name="ctc-mail" size="50" placeholder="Votre mail..."
                               value="<?php echo (isset($_POST['ctc-mail'])) ? esc_attr($_POST['ctc-mail']) : ''; ?>"
                               required />
                        <small class="text-danger"><b>* Requis</b></small>
                    </div>

                    <div class="form-group">
                        <label for="ctc-telephone">Votre téléphone</label>
                        <input type="text" class="form-control" id="ctc-telephone" name="ctc-telephone" size="50" placeholder="Votre téléphone..."
                               value="<?php echo (isset($_POST['ctc-telephone'])) ? esc_attr($_POST['ctc-telephone']) : ''; ?>"
                               pattern="^(\+?\d{1,3}[-.\s]?)?\d{10}$" required />
                        <small class="text-danger"><b>* Requis</b></small>
                    </div>

                    <div class="form-group">
                        <label for="ctc-prestations">Quelles prestations vous intéressent ?</label>
                        <?php if (isset($message['prestations'])) { ?>
                            <div class="text-white bg-danger px-3"><?php echo $message['prestations']; ?></div>
                        <?php } ?>
                        <select class="form-control" id="ctc-prestations" name="ctc-prestations" required>
                            <option value="">--Choisir une option--</option>
                            <option value="Mariage">Mariage</option>
                            <option value="Grossesse lifestyle">Grossesse lifestyle</option>
                            <option value="Portrait">Portrait</option>
                            <option value="Événement professionnel">Événement professionnel</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ctc-message">Message</label>
                        <?php if (isset($message['message'])) { ?>
                            <div class="text-white bg-danger px-3"><?php echo $message['message']; ?></div>
                        <?php } ?>
                        <textarea class="form-control" id="ctc-message" name="ctc-message" cols="42" rows="10" placeholder="Votre message..." required><?php echo (isset($_POST['ctc-message'])) ? esc_attr($_POST['ctc-message']) : ''; ?></textarea>
                        <small class="text-danger"><b>* Requis</b></small>
                    </div>
              

                <!-- dexu éléments hidden caché par l'utilisateur contient valeur = nombre aléatoire que l'on encode -->
                <div class="form-group">
                  <input type="hidden" name="check1" value=<?php echo base64_encode($nb1); ?> />
                  <input type="hidden" name="check2" value=<?php echo base64_encode($nb2); ?> />
                  <p>Anti-Spam, saisir le résultat de l'opération&nbsp;: 
                    <span id="captcha">
                        <?php echo $nb1; ?>&nbsp;+&nbsp;<?php echo $nb2; ?> 
                      </span>
                    </p> 
                  <label for="captcha"> dans&nbsp;cette&nbsp;zone:&nbsp;</label>
                            <?php if (  isset($message['captcha']) ) { ?>
                                <div class="text-white bg-danger px-3"><?php echo $message['captcha'];  ?></div>
                            <?php } ?>
                  <input type="text" id="captcha" name="captcha" /><small class="text-danger"><b> * Requis</b></small>
                </div>



                        <div class="form-group">
                            <input type="submit" class="btn" id="send" name="send" value="Envoyer"/>
                        </div>


             </form>
            </div>
      

        
            <div class="col-12 col-md-12 col-sm-12 col-lg-6">
                <div class="contact">
                    <h1><?php the_title() ?></h1>
                        <?php if ( have_posts() ) :     while ( have_posts() ) : the_post(); ?>
                            <?php the_content(); ?>
                            <?php endwhile;endif; ?>
                    <div class="maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d42142.58953504759!2d6.132239365198742!3d48.688050054976266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4794986e17a692cd%3A0x4ed671b10d82498d!2sNancy!5e0!3m2!1sfr!2sfr!4v1720183006632!5m2!1sfr!2sfr" class='img-fluid' style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                 </div>     
            </div>
        </div>
    </div>
</section>

 <section class="call-to-action">
        <div class="container">
            <div class="row justify-content-center">
            
                <div class="col-12 col-md-8 col-sm-6 col-lg-12 col-xl-12 text-center">
                    <div class="reseauxsociaux">
                        <?php  get_template_part('reseauxsociaux'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>





 <?php get_footer(); ?>