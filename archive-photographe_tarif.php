
<?php get_header(); ?>

 <section>

<?php $photographe_term_list = get_terms(array( 'taxonomy' => 'prestations', 'hide_empty' => true));  
if (count($photographe_term_list) > 0):

  foreach($photographe_term_list as $the_term): ?>

       <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-sm-10 col-lg-12 col-xl-12"> 

                    <?php  $args_taxo_rupt = array(
                      'post_type' => 'photographe_tarif', //nom du custom post type
                      'posts_per_page' => -1,
                      'orderby' => 'menu_order',
                      'order'   => 'ASC',
                      
                      'tax_query' => array(
                          array(
                            'taxonomy' => 'prestations',
                            'field'    => 'slug',
                            'terms'    => $the_term->slug,
                          )
                        )
                      );
                      $req_taxo_rupt = new WP_Query($args_taxo_rupt);

                      if($req_taxo_rupt->have_posts()): ?>

                        <div class="container">
                          <div class="row">
                            <div class="col-12">
                              <h1><?php echo $the_term->name; ?></h1>
                            </div>
                            <?php while($req_taxo_rupt->have_posts()): ?> 

                              <?php $req_taxo_rupt->the_post();  ?>

                            
                               <h3 class="photographe-tarif-titre">
                                <?php $photographe_tarif_meta_titre   = get_post_meta($post->ID, '_media_meta_titre',  true); echo  $photographe_tarif_meta_titre ?> <br></h3>
                                  <p class="description">
                                    <?php $photographe_tarif_meta_description   = get_post_meta($post->ID, '_media_meta_description',  true);
                                    echo $photographe_tarif_meta_description ?><br></p>
                            <div class="container-tarif">
                              <div class="jumbotron">
                                <div class="row">
                                  <div class="col-md-4">
                                  <?php the_post_thumbnail('tarif', array( 'class' => 'img-fluid card-img-top' )); ?> 
                                  </div>
                                  <div class="col-md-8">
                                    <h5 class="display"><?php the_title(); ?></h5>

                                    <p class="lead"><?php the_content(); ?></p>
                                     <p class="prix photographe-tarif-prix"> <?php 
                                    $photographe_tarif_meta_prix   = get_post_meta($post->ID, '_media_meta_prix',  true);
                                    echo  $photographe_tarif_meta_prix ?> <br></p>
                                
                                  </div>
                                </div>
                              </div>
                            </div>

                            <?php endwhile; wp_reset_postdata();  ?>
                          </div><!-- /row -->
                        </div><!-- /container -->
                      <?php endif;  ?>
                  </div>
              </div>
          </div>
  <?php endforeach;
endif; ?>
</section> 

      <section class="call-to-action">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-sm-6 col-lg-12 col-xl-12 text-center">

                     <div class="calltoaction">
                        <?php  get_template_part('calltoaction'); ?>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-sm-6 col-lg-12 col-xl-12 text-center">
                    <div class="reseauxsociaux">
                        <?php  get_template_part('reseauxsociaux'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


 <?php get_footer(); ?>