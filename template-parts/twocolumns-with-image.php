<?php
if (isset($args['post_title'])):
$queryFilter = array(
    'post_type' => $args['post_type'] ?? 'page', // Replace 'post' with your custom post type if needed
    'posts_per_page' => -1, // Set to -1 to retrieve all matching posts, or adjust as needed
    'title' => $args['post_title'],
                'ignore_sticky_posts' => true,
);

$query = new WP_Query( $queryFilter );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) { 
        $query->the_post();
        ?>

        <div class="w-full grid gap-10 grid-cols-1 md:grid-cols-2 items-center py-25 <?php echo get_the_ID(); ?>">
            <div>
                <?php the_content(); ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?> <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="text-4">
                <?php 
                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); // 'full' is the size of the image, you can change it as needed
                if ( $thumbnail_url ) {
                    echo '<img class="rounded" src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                }
                ?>
            </div>
        </div>


        <?php
    }
    wp_reset_postdata(); // Restore global post data
}

endif;
?>