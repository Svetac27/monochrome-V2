<?php
	/* Template Name: Homepage */
?>

<?php
get_header();
?>


<div class="w-full slider-wrapper relative">
	<?php do_shortcode('[monochrome-slider postType="carousel-panels" category="home" limit="-1"]'); ?>
</div>

<div class="px-page">
	<main  id="primary" class="site-main w-full page-wrapper mx-auto">
		<div class="py-40px w-full global-brands-mobile justify-center text-center">
			<?php get_template_part(	'template-parts/global', 'brands', [
				'wrapperclass' => 'w-100vw max-w-none'
			]); ?>
		</div>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'home' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</main><!-- #main -->
</div>
<?php
get_sidebar();
get_footer();
