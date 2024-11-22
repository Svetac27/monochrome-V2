<?php
$posttype = explode(',', $args['posttype'] ?? 'post');
// $posttype = ['post', 'blogs'];

$category = $args['category'] ?? 'all';
$limit = $args['limit'] ?? -1;
$paginate = false;
if (isset($args['paginate']) && ($args['paginate'] === true || $args['paginate'] === 'true')) {
    $paginate = true;
}
$viewAllLink = $args['view-all-link'] ?? null;
$sectionTitle = $args['title'] ?? null;
$exclude = isset($args['exclude']) ? explode(',',$args['exclude']) : [];

$queryArgs = array(  
    'post_type' => $posttype,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
    'ignore_sticky_posts' => true,
    'order'   => 'DESC',
    'post_parent'    => 0, // Get only parent posts
    'post__not_in' => $exclude
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
$count = $query->found_posts;
?>
<?php if ( $query->have_posts() ) { ?>
    <section>
        <div class="w-full blogs" data-blogs data-posttype="<?php echo implode(',', $posttype); ?>" data-items-per-page="<?php echo $limit; ?>" data-page="1">
            <?php if ($sectionTitle || $viewAllLink): ?>
                <div class="flex justify-between items-center">
                <?php
                if ($sectionTitle) {
                    echo '<h2 class="py-38px wp-block-heading leading-[40px]">'.$sectionTitle.'</h2>';
                }
                if ($viewAllLink) {
                    echo '<a class="arrow-right uppercase text-14px tracking-[0.84px] leading-[24px] font-gilroy-semi-bold" href="'.$viewAllLink.'">View All</a>';
                } ?>
            </div>
                
            <?php endif; ?>
            <?php
            ?><div class="grid grid-cols-1 lg:grid-cols-3 gap-30px blog-list"><?php
            while ( $query->have_posts() ) {
                $query->the_post();
                get_template_part('template-parts/component', 'blog-card');
            }
            ?></div><?php
            ?>
            <?php if ($count <= 0) { ?>
                <div class="text-center text-20px">
                    No items found.
                </div>
            <?php } ?>

            <?php if ($paginate && $count >= $limit && $limit != -1) { ?>
                <div class="text-center pt-40px w-full">
                    <button class="load-more btn">load more</button>
                </div>
            <?php } ?>
        </div>
    </section>
<?php }
wp_reset_postdata();
?>

