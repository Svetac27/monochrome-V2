<?php

$postType = 'global_brands';
$limit = -1;

$args = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
                'ignore_sticky_posts' => true,
    'order'   => 'DESC'
);

$query = new WP_Query( $args ); 
$total = $query->post_count;

// Initialize an empty array to store the results
$results = array();

// Check if there are posts
?>
<div class="w-full absolute bottom-[2rem] left-0 py-22px md:py-0">
    <div class="mb-4 w-full px-page">
        <h3 class="text-6 page-wrapper mx-auto ">Trusted By Global Brands</h3>
    </div>

<div class="w-full overflow-auto hide-scrollbar flex gap-20">
<?php
if ( $query->have_posts() ) {
    // Loop through the posts and store them in the array
    while ( $query->have_posts() ) {
        $query->the_post();

        ?>
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" />
        <?php
    }
    // Reset post data
    wp_reset_postdata();
}
?>
</div>
</div>
