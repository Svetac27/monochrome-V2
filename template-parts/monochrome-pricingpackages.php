<?php 
$postType = 'monochrome-pricing';
$limit = -1;


$queryArgs = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
    'ignore_sticky_posts' => true,
    'order'   => 'ASC',
    'post_parent'    => 0, // Get only parent posts
);
$query = new WP_Query( $queryArgs ); 
?>
<section>
    <div class="box pricing-packages !px-[50px] !py-18">
        <h2 class="w-full text-left text-32px md:text-40px"><?php echo $args['title'] ?? 'What is Included'; ?></h2>
        <?php 

        // hold pricing packages
        $packages = [];

        // Check if there are posts
        if ( $query->have_posts() ) {
            ?>
            <ul class="tabs border-b-1px border-black border-opacity-20 flex pt-21px text-18px justify-between md:justify-start">
                <?php
                $index = 0;
                // Loop through the posts and store them in the array
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?><li><a class=" font-gilroy-semi-bold <?php echo $index == 0 ? 'border-b-2px border-blue' : 'opacity-70'; ?> text-black block --js-package-includes py-3 px-30px text-18px " data-package="<?php the_ID(); ?>" href="#package-<?php the_ID(); ?>"><?php the_title(); ?></a></li><?php

                    $parentId = get_the_ID();

                    // Query children posts for the current parent post
                    $packages[$parentId] = get_children(array(
                        'post_parent'    => $parentId, // Get children of the current parent post
                        'posts_per_page' => -1, // Retrieve all children posts
    'order'   => 'ASC',
                        // Add any additional query parameters as needed
                    )) ?? [];

                    $index++;
                }
                // Reset post data
            ?>
            </ul>

            <div class="w-full pt-12 pb-5px">
                <?php
                $index = 0;
                foreach ($packages as $parent => $children) { ?>
                    <div class="package-item package-<?php echo $parent; ?> grid grid-cols-1 md:grid-cols-4 gap-5
                        <?php echo $index == 0 ? '' : 'hidden'; ?>
                        ">
                        <?php foreach ($children as $package): ?>
                            <div class="text-14px border-1px border-black rounded-[10px] border-opacity-20 p-30px">
                                <?php
                                    $featured_image_url = get_the_post_thumbnail_url($package->ID);

                                    // Check if the featured image exists
                                    if ($featured_image_url) {
                                        echo '<img class="h-[50px] w-[50px]" src="' . esc_url($featured_image_url) . '">';
                                    }
                                    ?>

                                <h3 class="text-18px pt-18px font-gilroy-semi-bold"><?php echo get_the_title($package->ID); ?></h3>
                                <div class="pt-2 text-14px leading-[22px]"><?php echo strip_tags($package->post_content); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php $index++;
            } ?> 
            </div>
        <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</section>