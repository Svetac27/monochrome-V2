<?php

$postType = 'global_brands';
$limit = -1;

$queryArgs = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
                'ignore_sticky_posts' => true,
    'order'   => 'DESC'
);

$query = new WP_Query( $queryArgs ); 
$total = $query->post_count;

// Initialize an empty array to store the results
$results = array();

$wrapperClass = $args['wrapperclass'] ?? 'w-full';
?>
<div class="global-brands <?php echo $wrapperClass; ?>">

    <?php if (!(isset($args['hideTitle']) && $args['hideTitle'] == true)) { ?>
        <div class="mb-1 lg:mb-4 w-full px-page">
            <h3 class="page-wrapper mx-auto <?php echo $args['text-class'] ?? 'text-4 lg:text-[1.2rem] text-center lg:text-left'; ?>">Trusted By Global Brands</h3>
        </div>
<?php } ?>

<div class="css-slider-wrapper">
<div class="item-list h-62px">
<?php

$targetNumberOfItems = 36;

$loopTimes = 1;
echo '<div class="h-62px flex items-center">';
while (($loopTimes * $total) < ($targetNumberOfItems + $total)) {

    if ( $query->have_posts() ) {
        // Loop through the posts and store them in the array
        while ( $query->have_posts() ) {
            $query->the_post();

            ?>
                <img class="mx-[15px] lg:mx-[50px]" src="<?php echo get_the_post_thumbnail_url(); ?>" />
            <?php
        }
    }
    $loopTimes++;

    if (($loopTimes * $total) < ($targetNumberOfItems + $total)) {
        $query->rewind_posts(); 
    }
}
echo '</div>';
wp_reset_postdata();

//<div class="w-full overflow-auto hide-scrollbar flex gap-20">

?>
</div>
</div>
</div>
