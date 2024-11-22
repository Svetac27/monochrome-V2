<div class="w-full grid gap-10 grid-cols-1 md:grid-cols-2 items-center py-25">
    <div class="text-4">
        <?php
            $postType = 'video_testimonials';
            $loop = new WP_Query([
                'post_type' => $postType,
                'posts_per_page' => 1,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order'   => 'DESC',
                'ignore_sticky_posts' => true,
            ]); 
        ?>
        <?php
            while ( $loop->have_posts() ) : $loop->the_post(); 
                the_content();
            endwhile;

            wp_reset_postdata(); 
        ?>
    </div>
    <div class="">
        <?php
            $postType = 'testimonials';
            $limit = 5;

            $args = array(  
                'post_type' => $postType,
                'posts_per_page' => $limit,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order'   => 'DESC',
                'ignore_sticky_posts' => true,
            );

	        get_template_part( 'template-parts/carousel', 'testimonials', $args);
        ?>
    </div>
</div>