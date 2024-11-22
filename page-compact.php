<?php
	/* Template Name: Compact */

get_header();
?>
<main id="primary" class="site-main px-page">
    <?php
    while ( have_posts() ) :
        the_post();
        
        ?>
            <article id="post-<?php the_ID(); ?>" class="<?php echo implode(' ', get_post_class()); ?>">
                <header class="entry-header page-wrapper mx-auto w-full !max-w-[800px] mx-auto !mb-0">
                    <?php the_title( '<h1 class="text-left lg:text-center leading-[38px] lg:leading-[96px] entry-title text-32px md:text-40px lg:text-60px break-words pb-23px lg:pb-60px">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="blog-entry-content page-compact box !p-0 w-full max-w-[800px] mx-auto rounded-20px overflow-hidden">

                    <?php if (has_post_thumbnail()): ?>
                        <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                        <div class="post-thumbnail w-full ">
                            <img class="w-full " src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (is_page()): ?>
                        <div class="content w-full px-page md:px-[80px] py-40px md:py-[80px] text-4 leading-[28px] font-gilroy">
                    <?php else: ?>
                        <div class="content w-full px-page md:px-[119px] py-40px md:py-[44px] text-4 leading-[28px] font-gilroy">
                    <?php endif; ?>
                        <?php the_content(); ?>
                    </div>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->

        <?php
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->
<?php
get_sidebar();
get_footer();
