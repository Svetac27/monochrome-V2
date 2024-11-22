
<?php
    $postType = 'testimonials';
    $limit = $args['limit'] ?? -1;
    $order = $args['order'] ?? 'DESC';

    $queryArgs = array(  
        'post_type' => $postType,
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order'   => $order,
        'ignore_sticky_posts' => true,
    );
        
    $category = $args['category'] ?? 'all';
    

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

    if (isset($args['id'])) {
        $queryArgs = [
            'p' => $args['id'],
            'post_type' => 'any'
        ];
    }

    if (isset($args['no-video']) || in_array('no-video', $args)) {
        get_template_part( 'template-parts/carousel', 'testimonials-no-video', $queryArgs);
    } else {
        get_template_part( 'template-parts/carousel', 'testimonialsV2', $queryArgs);
    }
?>