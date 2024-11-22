<?php 
$postType = 'monochrome-awards';
$limit = 4;

$args = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
    'ignore_sticky_posts' => true,
    'order'   => 'ASC'
);
$query = new WP_Query( $args ); 

?>
<section class="secton-awards lg:px-page !pt-[90px]">
    <div class="w-full page-wrapper grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[15px] lg:gap-10 text-black mb-[100px]">
        <?php 
        // Check if there are posts
        if ( $query->have_posts() ) {
            // Loop through the posts and store them in the array
            while ( $query->have_posts() ) {
                $query->the_post();
                $points = get_field('points');
                ?>
                <div class="text-center box-nopadding p-20px lg:px-30px lg:pt-[75px] lg:pb-[45px]">
                    <div class="text-[60px] lg:text-[82px] leading-[82px] tracking-0 capitalize opacity-50 font-gt"><?php echo $points; ?></div>
                    <div class="text-18px leading-[28px] tracking-0 font-bold font-gilroy-semibold capitalize mt-30px mb-10px lg:mb-15px"><?php echo get_the_title(); ?></div>
                    <div class="text-14px leading-[22px] opacity-80"><?php echo strip_tags(get_the_content()); ?></div>
                </div>
                <?php
            }
            // Reset post data
            wp_reset_postdata();
        }
        ?>    
    </div>
</section>