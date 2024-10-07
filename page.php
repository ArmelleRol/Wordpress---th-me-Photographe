<?php get_header(); ?>


    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-sm-6 col-lg-12">
                    <?php  if (have_posts()):  ?>
                        <?php while( have_posts()): the_post(); ?>              
                        <div class="row">
                            <h1><?php  the_title(); ?></h1>
                                <div class="col">
                                 <?php the_post_thumbnail('tarif', array( 'class' => 'img-fluid' )); ?>
                                 </div>
                                 <div class="col">
                            
                                <?php the_content();   ?>
                                </div>
                      
                        </div><!-- /row -->
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
        </div><!-- /container -->
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
