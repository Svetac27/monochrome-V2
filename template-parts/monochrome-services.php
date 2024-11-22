<?php

$postType = 'offered-services';
$limit = 5;

$args = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'ignore_sticky_posts' => true,
    'order'   => 'ASC'
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

<div class="section-services grid grid-cols-1 lg:grid-cols-2 gap-15px md:gap-30px lg:gap-10 w-full items-center pt-[80px] lg:pt-[190px]">
    <div class="lg:h-full">
        <?php
        $item = $results[0] ?? [];
        $itemLink = get_field('find_out_more_link', $item->ID); ?>
        <div class="large-box box h-full grid items-center overflow-hidden cursor-pointer" <?php if ($itemLink && !empty($itemLink)) { echo 'onclick="window.location.href = this.querySelector(\'a\').getAttribute(\'href\')"'; } ?>>
            <?php
            
            $gray_icon = get_field('gray_icon', $item->ID);
            $icon = get_field('icon', $item->ID);
            ?>
            <div class="service-item">
                <div class="lg:grid flex items-start lg:grid-cols-1 items-center">
                    <?php if ($icon): ?>
                        <div
                            class="service-icon h-40px w-40px lg:h-50px lg:w-full mb-0 mr-4 lg:mb-20px lg:mr-0 bg-contain bg-left bg-no-repeat"
                            style="background-image: url(<?php echo $icon; ?>)"
                        >
                        </div>
                    <?php endif; ?>
                    <h2 class=""><?php echo html_entity_decode($item->post_title); ?></h2>
                </div>
                <div class="text-3-lines text-16px leading-[28px] my-20px"><?php echo strlen($item->post_excerpt) ? $item->post_excerpt : strip_tags($item->post_content); ?></div>
                <?php
                if ($itemLink) { ?>
                    <a class="font-bold mb-4 -mt-5px uppercase arrow-right !inline-block leading-[0.84px]" href="<?php echo $itemLink; ?>" >Find out more</a>
                <?php } ?>
            </div>
            <?php $thumbnail_url = get_the_post_thumbnail_url($item->ID, 'full'); ?>
            <div class="w-full h-full featured-image" style="background-image: url(<?php echo $thumbnail_url; ?>)"></div>
        </div>
    </div>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-15px md:gap-30px lg:gap-10">
            <?php for ($i = 1; $i < 5; $i++): ?>
                <?php 
                $item = $results[$i] ?? [];
                $gray_icon = get_field('gray_icon', $item->ID);
                $icon = get_field('icon', $item->ID);
                ?>
                <?php
                $itemLink = get_field('find_out_more_link', $item->ID); ?>
                <?php if ($itemLink) { ?>
                    <a href="<?php echo $itemLink; ?>" class="small-box box service-item grid items-start">
                <?php } else { ?>
                    <div class="small-box box service-item grid items-start">
                <?php } ?>
                    <div>
                        <div class="md:grid flex items-start md:grid-cols-1 items-center">
                            <?php if ($icon): ?>
                                <div
                                    class="service-icon h-40px w-40px md:h-50px md:w-[63px] mb-0 mr-4 md:mb-20px md:mr-0 bg-contain bg-left bg-no-repeat"
                                    style="background-image: url(<?php echo $icon; ?>)"
                                >
                                </div>
                            <?php endif; ?>
                            <h2 class="text-4 lg:text-18px font-gilroy-semi-bold leading-[28px]"><?php echo html_entity_decode($item->post_title); ?></h2>
                        </div>
                        <div class="text-14px text-3-lines leading-[22px]"><?php echo strlen($item->post_excerpt) ? $item->post_excerpt : $item->post_content; ?></div>
                    </div>
                <?php if ($itemLink) { ?>
                    </a>
                <?php } else { ?>
                    </div>
                <?php } ?>
            <?php endfor; ?>
        </div>
    </div>
</div>