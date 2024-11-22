<?php 
$postType = 'monochrome-faq';
$limit = $args['limit'] ?? -1;
$category = $args['category'] ?? 'all';

$queryArgs = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
    'ignore_sticky_posts' => true,
    'order'   => 'ASC',
    'post_parent'    => 0, // Get only parent posts
);


if ($category == 'uncategorized') {
    $queryArgs['category__in'] = array(1);
} else if ($category != 'all') {
    $categories = explode(',', $category);
    $queryArgs['tax_query'] = [
        [
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => array_map(function($item) {
                    return slugify($item);
                }, $categories), // Replace with your category slugs
        ]
    ];
}

$query = new WP_Query( $queryArgs );
?>

<?php if ( $query->have_posts() ) { ?>
<section>
    <div class="w-full faqs">
        <?php 
        // Check if there are posts
            ?><ul class="grid grid-cols-1 gap-4"><?php
            // Loop through the posts and store them in the array
            $index = 1;
            while ( $query->have_posts() ) {
                $query->the_post();
                get_template_part('template-parts/component', 'accordionitem');
            }
            ?></ul>
    </div>
</section>
<?php
        }
        wp_reset_postdata();
        ?>