<?php 
/**
 * Template Name: page legales
*/

 get_header(); ?>

    <section>
        <div class="container">
            <?php  if (have_posts()):  ?>
                    <?php while( have_posts()): the_post(); ?>  
                        <div class="row">
                            <div class="col-12">
                                <?php the_title('<h1 class="text-center">','</h1>');  ?>
                                <?php the_content(); ?>
                            </div>
                        </div>          

                    <?php endwhile;  ?>

            <?php else:  ?>
                    <div class="row">
                        <div class="col-12">
                            <p>y a pas de résultats</p>
                        </div>
                    </div>
            <?php endif;    ?>
        </div><!-- /container -->
    </section>

<?php get_footer(); ?>