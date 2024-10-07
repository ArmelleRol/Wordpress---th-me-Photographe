<?php get_header(); ?>

    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12  col-sm-10   col-lg-12 col-xl-12">
                    <?php  if (have_posts()):  ?>
                            <?php while( have_posts()): the_post(); ?>              

                                 <h1><?php  the_title(); ?></a></h1>

                            <?php endwhile;  ?>

                    <?php else:  ?>
                            <div class="row">
                                <div class="col-12">
                                    <p>y a pas de résultats</p>
                                </div>
                            </div>
                    <?php endif;    ?>
                </div>
            </div>
        </div>
    </section>

    
        

    <h1 class="site__heading"><?php post_type_archive_title(); ?></h1>

    <main class="prestations">
                        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
           
    

    <section id="presentations">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10  col-sm-10  col-lg-6 col-xl-6 text-center">
                    <div class="d-flex flex-column justify-content-center">
                            <div class="titre">
                                 <p><?php $lgmac_meta_titre = get_post_meta($post->ID, '_media_meta_titre', true);
                                 echo $lgmac_meta_titre ?> </p>
                            </div>
                            <div class="description">
                               <p><?php $lgmac_meta_description = get_post_meta($post->ID, '_media_meta_description', true);
                                 echo $lgmac_meta_description ?> </p>
                            </div>
                    </div>
                </div>
                <div class="col-12 col-md-10 col-sm-10 col-lg-6 col-xl-6">
                    <div class="bloc-image">
                            <div class="d-flex justify-content-center">
                                <?php the_post_thumbnail('blog', array( 'class' => 'img-fluid' )); ?> 
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

                <?php endwhile; endif; ?>                     
    <section id="portfolio">
        <div class="container">
            <div class="row justify-content-center">
                <h1> Portfolio </h1>
                    <div class="col-12 col-md-12 col-sm-12 col-lg-12">
                    
                       
                    <?php       if (have_posts()): while (have_posts()) : the_post(); //the loop
                                if ( get_post_gallery() ) :
                                echo get_post_gallery();
                            else :
                                echo (the_ID() . " has no gallery.");
                            endif; 
                            endwhile;
                            endif;  
                            ?>
                        
                    </div><!-- /container -->
            </div>
        </div>
    </section>

      <section class="prestations-bloc ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-sm-6 col-lg-12 col-xl-12">
                    <div class="container-prestations">
                        <?php  if (have_posts()):  while( have_posts()): the_post(); ?>
                                        <div class="header">
                                            <h2 class="text-center">
                                                <p><?php $lgmac_meta_titre1 = get_post_meta($post->ID, '_media_meta_titre1', true);
                                                    echo $lgmac_meta_titre1 ?> </p>
                                            </h2>
                                        </div>
                                        <div class="body">
                                        <p><?php $lgmac_meta_description1 = get_post_meta($post->ID, '_media_meta_description1', true);
                                                    echo $lgmac_meta_description1 ?>
                                        </p>
                                        </div>
                    
                        <?php endwhile; wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>


                    <div class="container-prestations">
                        <?php  if (have_posts()):  while( have_posts()): the_post(); ?>
                                        <div class="header">
                                            <h2 class="text-center">
                                                <p><?php $lgmac_meta_titre2 = get_post_meta($post->ID, '_media_meta_titre2', true);
                                                    echo $lgmac_meta_titre2 ?> </p>
                                            </h2>
                                        </div>
                                        <div class="body">
                                        <p><?php $lgmac_meta_description2 = get_post_meta($post->ID, '_media_meta_description2', true);
                                                    echo $lgmac_meta_description2 ?>
                                        </p>
                                    </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="container-prestations">
                        <?php  if (have_posts()):  while( have_posts()): the_post(); ?>
                                        <div class="header">
                                            <h2 class="text-center">
                                                <p><?php $lgmac_meta_titre3 = get_post_meta($post->ID, '_media_meta_titre3', true);
                                                    echo $lgmac_meta_titre3 ?> </p>
                                            </h2>
                                        </div>
                                        <div class="body">
                                        <p><?php $lgmac_meta_description3 = get_post_meta($post->ID, '_media_meta_description3', true);
                                                    echo $lgmac_meta_description3 ?>
                                        </p>
                                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                          <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
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


</main> 


<?php get_footer(); ?>

























