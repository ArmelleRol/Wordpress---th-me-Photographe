<?php
$query = new WP_Query( array( 'pagename' => 'contact' ) );
?>


               <!--On affiche le contenu sur la même logique que la boucle principale -->
            <?php if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();?>
               <button class="btn" type="submit"><a href="<?php echo get_permalink(15); ?>">Contact</a></button>
            <?php }
            }
            /* On utilise la fonction wp_reset_postdata pour restaurer la requête principale (pour éviter des bugs) */
            wp_reset_postdata();?> 
     