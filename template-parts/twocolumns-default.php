<?php

if (isset($args['post_title'])):
    $queryFilter = array(
        'post_type' => $args['post_type'] ?? 'post', // Replace 'post' with your custom post type if needed
        'posts_per_page' => 1, // Set to -1 to retrieve all matching posts, or adjust as needed
                'ignore_sticky_posts' => true,
        'title' => $args['post_title'],
    );
    
    $query = new WP_Query( $queryFilter );


    if ( $query->have_posts() ) {
        ?>
        <div class="w-full flex flex-wrap items-center py-22px mt-22px md:py-25 md:mt-25">
        <?php
        while ( $query->have_posts() ) { 
            $query->the_post();
            if (strtolower($args['post_title']) === strtolower(get_the_title())): 
            ?>
            <div id="asda-<?php echo get_the_ID(); ?>"><?php echo get_the_content(); ?></div>
            <?php
            endif; 
        }
        wp_reset_postdata(); // Restore global post data
        
        ?>
        </div>
        <?php
    }
endif;
?>

<!--
<div class="w-full flex flex-wrap items-center py-25 mt-25">
    <div class="w-full md:w-1/2">
        <h2 class="text-10">Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt.</h2>
    </div>
    <div class="w-full md:w-1/2 text-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
    </div>
</div>
-->