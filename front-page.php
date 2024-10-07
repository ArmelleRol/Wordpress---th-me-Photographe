<?php get_header();?>


	<section>
		<div class="container">
			<?php  if (have_posts()):  ?>
					<?php while( have_posts()): the_post(); ?>	
						<div class="row">
							<div class="col-12">
								<?php the_title('<h1 class="text-center">','</h1>');  ?>
							</div>
						</div>			

					<?php endwhile;  ?>

			<?php else:  ?>
					<div class="row">
						<div class="col-12">
							<p>y a pas de résultats</p>
						</div>
					</div>
			<?php endif;	?>
		</div><!-- /container -->
	</section>

		

							<!-- integration du template slider-home.php -->
							<?php  get_template_part('slider', 'home'); ?>
				


	<section class="contenu">
		<div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-sm-10 col-lg-12 text-center">
						<div class="description-site">
								<?php the_content(); ?>
						</div>
					 </div>
				</div>
		</div>
	</section>


	<section class="portfolio">
		<div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-sm-10 col-lg-12 text-center">
							<!-- intégration des deux derniers portfolio-> prestations -->
							<?php $args_portfolio = array(
								'post_type' => 'portfolio_media',
								'posts_per_page' => 4 
								);
							$req_portfolio = new WP_Query($args_portfolio); ?>

							<?php if ($req_portfolio->have_posts()): ?>
								<section id="portfolio-front">

									<div class="container">
										<div class="row">
											<h1>Portfolio </h1>
											<?php while($req_portfolio->have_posts() ): $req_portfolio->the_post(); ?>
												<div class="col-6 col-sm-6">
													
													
													<div class="portfolio-accueil">
															<a href="<?php the_permalink(); ?>">
																<?php the_post_thumbnail( 'tarif', array( 'class' => 'img-fluid' ) ); ?>
															</a>
															<?php the_excerpt(); ?>
													</div>
															
												</div>
											<?php endwhile; wp_reset_postdata(); ?>

										</div><!-- /row -->
									</div>
								</section>
							<?php endif; ?>
					</div>
				</div>
			</div>
		</section>


		<section class="article-blog">
			<div class="container">
            <div class="row">
                <div class="col-12 col-md-10 col-sm-10 col-lg-12 text-center">
							<!-- intégration des deux derniers articles de blog -> prestations -->
							<?php $args_blog = array(
								'post_type' => 'post',
								'posts_per_page' => 2
								);
							$req_blog = new WP_Query($args_blog); ?>

							<?php if ($req_blog->have_posts()): ?>
								<section id="blog-front">

									<div class="container">
										<div class="row">
											<?php while($req_blog->have_posts() ): $req_blog->the_post(); ?>
												<div class="col-12 col-md-10 col-sm-10 col-lg-6">
													<div class="card">
														<div class="card-header">
															<h3 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
														</div>
														<div class="card-body">
															<a href="<?php the_permalink(); ?>">
																<?php the_post_thumbnail( 'blog', array('class' =>'img-fluid')); ?>
															</a>
															<?php the_excerpt(); ?>
														</div>
													
													</div>
												</div>
											<?php endwhile; wp_reset_postdata(); ?>

										</div><!-- /row -->
									</div>

								</section>
							<?php endif; ?>
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
		
<?php get_footer(); ?>




