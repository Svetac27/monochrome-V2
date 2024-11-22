<?php 
$postType = 'monochrome-projects';
$limit = -1;


$metaQuery = array(
        array(
            'key' => 'display_in_showcase_section', // Replace 'your_custom_field_key' with the key of your custom field
            'value' => '1', // Replace 'desired_value' with the value you want to filter by
            'compare' => '=', // Comparison operator. '=' for equal to, '>' for greater than, '<' for less than, etc.
            'type' => 'BOOLEAN' // Data type of the custom field value. Optional. Default is 'CHAR'.
        )
    );

$queryArgs = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
    'ignore_sticky_posts' => true,
    'order'   => 'ASC',
    'has_password' => false
);

$argsWithMeta = $queryArgs;
$argsWithMeta['meta_query'] = $metaQuery;

$query = new WP_Query( $argsWithMeta ); 

$resultCount = $query->post_count;


?>

<?php if (isset($args['type']) && $args['type'] == 'imageup'): ?>
<div class="w-full mx-auto page-wrapper grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
<?php else: ?>

<section class="showcase-wrapper !max-w-none w-full">
    <div class="items-wrapper w-auto max-w-none max-w-none parent gap-[30px]">
<?php endif; ?>
        <?php 
        // Check if there are posts
        if ( $query->have_posts() ) {
            // Loop through the posts and store them in the array
            while ( $query->have_posts() ) {
                $query->the_post();

                if (isset($args['type']) && $args['type'] == 'imageup'):
                    get_template_part('template-parts/component', 'showcase');
                else: 
                    echo '<div class="image-box" style="background-image: url('.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'full').')"></div>';
                endif;
            }
            // Reset post data
            wp_reset_postdata();
        }
        ?>

        <?php
        // if ($resultCount < $limit) {

            $queryArgs['posts_per_page'] = $limit - $resultCount;
            $queryArgs['meta_query'] = array(
                array(
                    'key' => 'display_in_showcase_section', // Replace 'your_custom_field_key' with the key of your custom field
                    'value' => '1', // Replace 'desired_value' with the value you want to filter by
                    'compare' => '!=', // Comparison operator. '=' for equal to, '>' for greater than, '<' for less than, etc.
                    'type' => 'BOOLEAN' // Data type of the custom field value. Optional. Default is 'CHAR'.
                )
            );

            $query = new WP_Query( $queryArgs ); 

            if ( $query->have_posts() ) {
                // Loop through the posts and store them in the array
                while ( $query->have_posts() ) {
                    $query->the_post();

                    if (isset($args['type']) && $args['type'] == 'imageup'):
                        get_template_part('template-parts/component', 'showcase');
                    else: 
                    echo '<div class="image-box" style="background-image: url('.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'full').')"></div>';
                    endif;
                }
                // Reset post data
                wp_reset_postdata();
            }
        // }

        ?>
<?php if (isset($args['type']) && $args['type'] == 'imageup'): ?>
    </div>
<?php else: ?>
        </div>
    </section>
<?php endif; ?>

<?php get_template_part( 'template-parts/content', 'protected'); ?>
