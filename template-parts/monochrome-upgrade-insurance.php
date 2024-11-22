<?php 
$postType = 'monochrome-insurance';
$limit = -1;

$queryArgs = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
    'ignore_sticky_posts' => true,
    'order'   => 'ASC'
);
$query = new WP_Query( $queryArgs ); 
$resultCount = $query->post_count;

?>

<div class="monochrome-upgrade-insurance grid grid-cols-1 lg:grid-cols-3 gap-20px">
    <?php
        if ( $query->have_posts() ) {
            // Loop through the posts and store them in the array
            while ( $query->have_posts() ) {
                $query->the_post();
                
                get_template_part('template-parts/component', 'insurance-item');
            }
            // Reset post data
            wp_reset_postdata();
        }
    ?>
</div>