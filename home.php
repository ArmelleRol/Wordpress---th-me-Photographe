<?php get_header(); ?>

    


    <section id="blog-front">
         <div class="container">
            <div class="row justify-content-center">
             
                    <?php  if (have_posts()):  while( have_posts()): the_post(); ?>
                           <div class="col-6 col-md-10 col-sm-10 col-lg-6 col-xl-6 text-center">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    </div>
                                    <div class="card-body">
                                    <?php if ($thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog', array( 'class' => 'img-fluid' ) )) :
                                        $thumbnail_src = $thumbnail_html['0']; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="img-fluid img-thumbnail" src="<?php echo $thumbnail_src; ?>" alt="">
                                            </a>
                                    <?php endif; ?>
                                    </div>
                                </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                     <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>