<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package monochrome
 */

?>

<article id="post-<?php the_ID(); ?>" class="<?php echo implode(' ', get_post_class()); ?> px-page">
	<header class="entry-header page-wrapper mx-auto lg:!mb-0">
		<?php
		$video = get_field('featured_video', get_the_ID());

		if ( is_singular() ) :
			the_title( '<h1 class="entry-title text-32px lg:text-70px break-words max-w-[741px] m-auto leading-[38px] lg:leading-[96px]">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title text-32px lg:text-70px break-words  max-w-[741px] m-auto leading-[38px] lg:leading-[96px]"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
		<?php if (has_excerpt()): ?>
	        <div class="post-excerpt text-4 md:text-20px font-gt max-w-[741px] <?php echo $video ? 'pb-20px' : ''; ?>">
	            <?php echo get_the_excerpt(); ?>
	        </div>
		<?php endif; ?>

		<?php if (has_post_thumbnail()): ?>
	        <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
	        <div class="post-thumbnail w-full mt-40px">
	            <img class="w-full rounded-20px" src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
	        </div>
		<?php endif; ?>


		<?php
			// featured video
			if ($video) { ?>
				<?php $videoThumbnail = get_field('featured_video_placeholder_image', get_the_ID()); ?>
			
		        <div class="post-thumbnail video-thumbnail <?php echo $videoThumbnail ? 'have-video-thumbnail' : 'no-video-thumbnail'; ?> video-aspect-ratio w-[741px] relative max-w-full inline-block overflow-hidden mt-40px mb-65px <?php if (is_exact_shortcode($video)): echo 'inline-block overflow-hidden justify-center rounded-20px'; endif; ?>">
			
					
					<?php
					if (is_exact_shortcode($video)) {
						echo do_shortcode($video);
					} else {
						echo $video;
					}
					?>
					<?php
					if ($videoThumbnail) { ?>
						<div class="h-full max-w-full w-[640px] absolute top-0 left-0 bg-cover bg-center cursor-pointer video-aspect-ratio override-video-thumbnail z-50" style="background-image: url(<?php echo $videoThumbnail; ?>)" ></div>
						<div class="play-button h-[80px] w-[80px] text-black bg-white rounded-full absolute absolute-middle flex justify-center items-center cursor-pointer z-50">
							<?php get_template_part('template-parts/icons', null, ['icon' => 'play', 'class' => 'h-22px w-22px']); ?>
						</div>
					<?php } ?>
				</div> <?php
			}
		?>
	</header><!-- .entry-header -->



	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'monochrome' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php monochrome_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
