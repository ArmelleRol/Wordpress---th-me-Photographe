jQuery(document).ready(function($) {  // encapsule $ car wordpress 
    //utilise plusieurs librairie jquery
  
    if(document.getElementById('table-messages')) {
      let contentBefore, $td, id_to_delete; // declaration des 
      //variables pour les modifier en dehors de la variable
      let clickable = true; // creation variable si on clique sur le bouton 
  
      $("#table-messages").on('click', '.deletable', function(e) {
  
        if (clickable == true)  { // si variable = true on execute le code 
          clickable = false; // terminer l'opération avant de cliquer 
          //sur un autre bouton 
  
          e.preventDefault();
          let $this = $(this);
          id_to_delete = $this.data('id'); // stocke id 
          $td = $this.parent(); // contenu de la cellule qui contient 
          //le bouton this parent-> element supérieur 
          contentBefore = $td.html(); //contenu de la cellule td  =
          // lien pour le restituer si annulation de la suppression
          $(".deletable").addClass('tempo').removeClass('btn btn-default');
  
          $td.html('');
          let stringConfirm  = "<p id='confirm-delete' >La suppression est irréversible!"; 
          // indique les éléments html 
          stringConfirm     += "<a id='my-confirm'  href='#'>Confirmer</a>"; // + lien confirmer 
          stringConfirm     += "<a id='my-cancel'  href='#'>Annuler</a></p>"; // + lien annuler
          $td.wrapInner(stringConfirm); // inserer dans la cellule du tableau 
  
        } // fin du if clickable == true
  
  
      });  // fin écouteur evt click
  
      // ecouteur d'evenement click sur bouton my cancel pour annuler opération
      // - on => detecter par jquery apres qu'il a été créé
      $("#table-messages").on('click', '#my-cancel', function(e) {  
        e.preventDefault(); 
        $td.find("#confirm-delete").remove().end().html(contentBefore);
         // cellule td chercher element eneleve la croix et affiche  
         //confirm delete html-> contenu de content before
        $(".deletable").removeClass('tempo').addClass('btn btn-default'); //
        clickable = true;
      });  // fin du on(click  #my-cancel)
  
      // ecouteur bouton lien my confirm
      $("#table-messages").on('click', '#my-confirm', function(e) {  
        e.preventDefault(); // appel de la focntion ajax
  
        $.post(
          ajaxurl, // 
          {
            'action': 'delete_message', // parametre action delete doit correspondre 
            //au hook wp_ajax_delete_message dans le fichier function 
            'id': id_to_delete //parametre id 
          },
          function(response){  
            if (response == 'success') { // si reponse est ok 
              $td.parent().remove(); // cellule du tableau bouton remonte au parent tr enleve le tableau  
              clickable = true; //remet variable à true pour cliquer sur autre bouton 
            } else {
              alert("Il y eu un problème avec la base de données lors de la suppression, veuillez contacter le responsable technique: ");
              $td.find("#confirm-delete").remove().end().html(contentBefore); // sinon message alerte - remet le contenu initial
              clickable = true;
            }
            $(".deletable").removeClass('tempo').addClass('btn btn-default');
          }
        );
  
      });  // fin du on(click  #my-confirm)
    }  // fin du document.getElementById('table-messages')
  });  // fin du ready jQuery