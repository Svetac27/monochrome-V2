<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package monochrome
 */

get_header(); ?>
<?php
// $categories = explode('category/', trim($_SERVER['REQUEST_URI'], '/')); 
// print_r($categories[1]); exit;
?>

<div class="category-page-content">



<article id="post-<?php the_ID(); ?>" class="<?php echo implode(' ', get_post_class()); ?> px-page">
	<header class="entry-header page-wrapper mx-auto">

        <?php
            $categorySlugs = get_category_slugs_from_url();
            $categoryNames = array_map(function($slug) {
                $category = get_category_by_slug($slug);
                
                if ($category) {
                    return $category->name;
                } return $slug;

            }, $categorySlugs);
        ?>
		<h1 class="leading-[1] entry-title text-32px md:text-40px lg:text-70px break-words"><?php echo implode(', ', $categoryNames); ?></h1>
		<?php /* if (has_post_thumbnail()): ?>
	        <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
	        <div class="post-thumbnail w-full mt-50px">
	            <img class="w-full rounded-20px" src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
	        </div>
		<?php endif;*/ ?>
    </header>

    <div class="entry-content">
        <?php

        $category = get_queried_object();

        // Check if the queried object is a category and get the slug
        if (is_category()) { ?>
            <?php echo do_shortcode('[monochrome-blogs category="'.implode(',', $categorySlugs).'" limit="24" paginate="true"]'); ?> 
        <?php }
        ?>
    </div><!-- .entry-content -->
<?php
get_sidebar();
get_footer();
