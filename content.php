
<div class="row">
	<div class="col-sm-2"><!-- la vignette -->
		<?php if ($thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' )) :
        $thumbnail_src = $thumbnail_html['0']; ?>
			<a href="<?php the_permalink(); ?>">
				<img class="img-fluid img-thumbnail" src="<?php echo $thumbnail_src; ?>" alt="">
			</a>
        <?php 
        endif; ?>
	</div>
	<div class="col-sm-10">
		<h1><a class="blog" href="<?php the_permalink(); ?>"><?php  the_title(); ?></a></h1>

		<?php the_excerpt();   ?>
	</div>
</div><!-- /row -->