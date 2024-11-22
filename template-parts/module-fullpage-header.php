<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header fullpage-heading w-full relative z-10 mb-60px lg:mb-0">
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.06] z-[-1]"
        >

        </div>
        <div class="px-page">
            <div class="w-full mx-auto max-w-[834px]">
                <?php
                if ( is_singular() ) :
                    the_title( '<h1 class="leading-[50px] entry-title text-36px md:text-40px lg:text-70px break-words lg:leading-[96px]">', '</h1>' );
                else :
                    the_title( '<h2 class="leading-[50px] entry-title text-36px md:text-40px lg:text-70px break-words lg:leading-[96px]"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;

                ?>
                <?php if (has_excerpt()): ?>
                    <div class="post-excerpt text-4 md:text-20px font-gilroy">
                        <?php echo get_the_excerpt(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        // Check if the post has a featured image
        if ( has_post_thumbnail() ) {
            // Get the URL of the featured image
            $featured_image_url = get_the_post_thumbnail_url();
            
            // Output the URL of the featured image
            ?>

        <div class="post-thumbnail grid h-full px-page relative"
        >
                <img class="!shadow-none w-full !max-w-none" src="<?php echo $featured_image_url; ?>" />
                <div class="hidden fullpage-hero-image bg-no-repeat rounded-20px h-full bg-top" style="background-size: 100% auto;background-image: url(<?php echo $featured_image_url; ?>)"
            ></div>

        </div>
            <?php
        }
        ?>
    </header><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->