<?php	// requête pour création du slider client */
			$args = array(
				'post_type' => 'photographe_slider',
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order'   => 'ASC'
				);
			 $slider_query = new WP_Query( $args );   

if($slider_query->have_posts()): ?>

	<section id="home-carousel">
		<div class="container">
			<div id="slider-01" class="carousel slide" data-bs-ride="carousel">


				<!-- Wrapper for slides -->
				<div class="carousel-inner" >

					<?php 
					while ( $slider_query->have_posts() ) : $slider_query->the_post();

						if($thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'presentation' )):
							$thumbnail_src = $thumbnail_html['0'];
						
						 ?>
							<div class="carousel-item<?php echo ($slider_query->current_post == 0 ? " active" : "");   ?>" data-bs-interval="5000" >
								<img class="d-block w-100" src="<?php echo $thumbnail_src; ?>" alt="">
								<div class="carousel-caption">
									<h4><?php the_title(); ?></h4>
									
								</div>
							</div>
							
						<?php endif;
					endwhile;  wp_reset_postdata(); ?>
				</div>

				<!-- Controls -->
				<a class="carousel-control-prev"  type="button" data-bs-target="#slider-01" data-bs-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden"></span>
				</a>
				<a class="carousel-control-next" type="button" data-bs-target="#slider-01" data-bs-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden"></span>
				</a>
			</div><!-- /carousel -->	
				
		</div><!-- /container -->

	</section>

<?php endif; ?>


