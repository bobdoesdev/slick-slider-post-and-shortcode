<?php
// exit if file is called directly
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
global $post; 

 ?>


<?php if ($this->atts['testimonials']): ?>
	<div class="shortcode-slider-content">
		<?php the_content(); ?>
	</div>

<?php else: ?>

<?php

	if (get_post_meta($post->ID, 'video_embed', true)) : ?>

		<iframe src="<?php echo get_post_meta($post->ID, 'video_embed', true); ?>"></iframe>

	<?php else: ?>

		<?php
			$attachment = get_post_thumbnail_id();
			if ( $attachment ) :
				$img_src = wp_get_attachment_image_src( $attachment, 'carousel-lg' ); // desktop image
				$img_srcset = wp_get_attachment_image_srcset( $attachment, 'carousel-lg' );
				$img_sizes  = wp_calculate_image_sizes('carousel-lg', NULL, NULL, $attachment);

			endif;
		?>

		<img src="<?php echo $img_src[0]; ?>"
		srcset="<?php echo $img_srcset; ?>"
	    sizes="<?php echo $img_sizes; ?>"
	    alt="<?php the_title(); ?>">

    <?php endif; ?>


	<?php 
		if ( $this->atts['captions']) : ?>
			<div class="shortcode-slider-content">
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
			<?php if(get_post_meta($post->ID, 'slide_link', true) ) : ?>
				<div class="slider-link">
				<a href="<?php echo get_post_meta($post->ID, 'slide_link', true); ?>"><?php echo get_post_meta($post->ID, 'slide_link_text', true); ?></a>
				</div>
			<?php endif; ?>
	<?php endif; ?>	

<?php endif; ?>


