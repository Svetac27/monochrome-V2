<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package monochrome
 */

get_header();
?>

	<?php // if (post_password_required() && !(isset($_COOKIE['wp-postpass_' . COOKIEHASH]) && wp_check_password($_COOKIE['wp-postpasprotecteds_' . COOKIEHASH], $post->post_password, $post->ID))) : ?>
	<?php if (post_password_required() && !ecAllowed()) : ?>
		<?php get_template_part( 'template-parts/content', 'protected', ['is-modal' => false]); ?>
	<?php else: ?>
	<main id="primary" class="site-main px-page">

		<?php
		while ( have_posts() ) :
			the_post();
			if (strpos(get_post_type(), 'monochrome')) {
				get_template_part( 'template-parts/content-' . get_post_type() );
			} else {
				get_template_part( 'template-parts/content', get_post_type() );
			}

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'monochrome' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'monochrome' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if (false && (comments_open() || get_comments_number()) ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
<?php endif; ?>
<?php
get_sidebar();
get_footer();
