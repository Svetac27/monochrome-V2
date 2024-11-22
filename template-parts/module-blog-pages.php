<?php
$showRelated = false;
if (!isset($args['show-related'])) {
    $showRelated = true;
} else if (isset($args['show-related']) && !$args['show-related'] === 'false' && !$args['show-related'] === false) {
    $showRelated = true;
}

?>


<article id="post-<?php the_ID(); ?>" class="<?php echo implode(' ', get_post_class()); ?> blog-page">
	<header class="entry-header page-wrapper mx-auto w-full !max-w-[800px] mx-auto !mb-0">
		<?php the_title( '<h1 class="text-left lg:text-center entry-title text-32px lg:text-60px break-words lg:max-w-[741px] m-auto leading-[38px] lg:leading-[80px]">', '</h1>' ); ?>

        <?php $subHeading = get_field('sub_heading', get_the_ID()); ?>
        <?php if ($subHeading): ?>
            <div class="sub-heading text-20px mt-15px lg:mt-0 text-left lg:text-center "><?php echo $subHeading; ?></div>
		<?php else: ?>
        <?php endif; ?>


        <?php $intro = get_field('introduction', get_the_ID()); ?>
        <?php $withIntro = false; ?>
        <?php if ($intro): ?>
            <?php $withIntro = true; ?>
	        <div class="blog-introduction text-4 md:text-20px leading-[32px] text-center font-gilroy opacity-80 pt-40px">
	            <?php echo $intro; ?>
	        </div>
		<?php elseif (has_excerpt()): ?>
            <?php $withIntro = true; ?>
	        <div class="blog-introduction text-4 md:text-20px leading-[32px] text-center font-gilroy opacity-80 pt-40px">
	            <?php echo get_the_excerpt(); ?>
	        </div>
		<?php else: ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

            

	<div class="blog-entry-content page-compact blog-page box !p-0 w-full max-w-[800px] mx-auto rounded-20px overflow-hidden mt-[60px]">

        <?php if (has_post_thumbnail()): ?>
            <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
            <div class="post-thumbnail w-full ">
                <img class="w-full " src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
            </div>
        <?php endif; ?>
		<div class="content w-full px-page md:p-[80px] p-40px text-4 leading-[28px] font-gilroy">
			<?php the_content(); ?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->



<?php if ($showRelated): ?>
<div class="w-full page-wrapper mx-auto py-[105px] lg:pb-0">
<?php
    
    $categories = get_the_category(get_the_ID());
    
    // Initialize an array to hold the slugs
    $slugs = array();
    
    // Loop through each category and get the slug
    if ( ! empty( $categories ) ) {
        foreach ( $categories as $category ) {
            $slugs[] = $category->slug;
        }
    }

    // echo '<pre>'; print_r($slugs); echo '</pre>';

    $viewAllLink = '/category/' . implode(',',$slugs);
	
	$viewAllLink = '/blog';

    echo do_shortcode('[monochrome-blogs category="'. implode(',',$slugs) .'" limit="3" title="Related Articles" view-all-link="'.$viewAllLink.'" exclude="'.get_the_ID().'"]');
    ?>
</div>
<?php endif; ?>