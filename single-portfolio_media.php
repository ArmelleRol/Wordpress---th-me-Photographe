<?php get_header(); ?>
    
     <section id="titre">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-sm-6 col-lg-12">
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
                </div><!-- /container -->
             </div>
        </div>
    </section>


    <section id="portfolio">
        <div id="container-portfolio">
            <div class="row justify-content-center">
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
                </div>
            </div><!-- /container -->
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

<?php get_footer(); ?>
