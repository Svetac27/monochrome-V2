<?php
	/* Template Name: Fullscreen Heading */
?>

<?php
get_header();
?>


<div class="">
	<main  id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/module', 'fullpage-header' );

			?>

			<div class="px-page">
			    <div class="entry-content lg:pt-37 page-wrapper w-full mx-auto">
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

			        wp_link_pages(
			            array(
			                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'monochrome' ),
			                'after'  => '</div>',
			            )
			        );
			        ?>
			    </div><!-- .entry-content -->
			</div>
			<?php

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
