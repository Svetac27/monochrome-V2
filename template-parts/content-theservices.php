<?php

$postType = 'offered-services';
$limit = 5;

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
if ( $query->have_posts() ) {
    // Loop through the posts and store them in the array
    while ( $query->have_posts() ) {
        $query->the_post();
        $results[] = get_post(); // Add the current post object to the array
    }
    // Reset post data
    wp_reset_postdata();
}
?>

<div class="section-services grid grid-cols-1 md:grid-cols-2 gap-10 w-full items-center">
    <div class="md:h-full">
        <div class="large-box box h-full grid items-center overflow-hidden">
            <?php
            $item = $results[0] ?? [];
            
            $gray_icon = get_field('gray_icon', $item->ID);
            $icon = get_field('icon', $item->ID);
            ?>
            <div class="service-item">
                <div class="md:grid flex items-start md:grid-cols-1 items-center">
                    <?php if ($icon): ?>
                        <img class="service-icon h-30px md:h-50px w-auto mb-0 mr-4 md:!mb-50px md:mr-0"
                            src="<?php echo $icon; ?>)"
                        />
                    <?php endif; ?>
                    <h2 class="text-14px"><?php echo html_entity_decode($item->post_title); ?></h2>
                </div>
                <?php echo strlen($item->post_excerpt) ? $item->post_excerpt : $item->post_content; ?>
                <a class="font-bold pb-4 uppercase block" href="/services" >Find out more <i class="fa-solid fa-arrow-right"></i></a>
                <?php
                
                    $featured_image_id = get_post_thumbnail_id( $item->ID );

                    // Get the image URL
                    $image_url = wp_get_attachment_image_src( $featured_image_id, 'full' ); // 'full' is the image size
                    if ( $image_url ) {
                        // Output the image URL
                        echo "<img class=\"md:hidden -mb-12 \" src='".$image_url[0]."' />";
                    }
                ?>
            </div>
        </div>
    </div>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <?php for ($i = 1; $i < 5; $i++): ?>
                <?php 
                $item = $results[$i] ?? [];
                $gray_icon = get_field('gray_icon', $item->ID);
                $icon = get_field('icon', $item->ID);
                ?>
                <a href="<?php the_permalink($item->ID); ?>" class="small-box box service-item grid items-start">
                    <div>
                        <div class="md:grid flex items-start md:grid-cols-1 items-center">
                            <?php if ($icon): ?>
                                <img class="service-icon h-30px md:h-50px w-auto mb-0 mr-4 md:!mb-50px md:mr-0"
                                    src="<?php echo $icon; ?>)"
                                />
                            <?php endif; ?>
                            <h2 class="text-4 md:text-18px font-gilroy-semibold"><?php echo html_entity_decode($item->post_title); ?></h2>
                        </div>
                        <div class="text-14px"><?php echo strlen($item->post_excerpt) ? $item->post_excerpt : $item->post_content; ?></div>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</div>