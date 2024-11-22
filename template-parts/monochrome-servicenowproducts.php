<?php 
$postType = 'servicenow-products';
$limit = -1;

$args = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
    'ignore_sticky_posts' => true,
    'order'   => 'DESC'
);
$query = new WP_Query( $args ); 

?>

<section class="px-page our-products">
<div class="w-full page-wrapper text-black product-wrapper box !py-[78px] !px-[50px]">
    <h2 class="text-22px lg:text-40px text-center lg:text-left section-title">Our ServiceNow™ Products</h2>
    <div class="grid grid-cols-1 lg:flex lg:gap-[58px]">
        <div class="lg:w-[310px] title-column col-span-1 overflow-x-auto overflow-y-hidden">
            <div class="flex justify-between gap-10 lg:block h-full tabs-wrapper">
                <div class="active-indicator absolute right-0 w-2px"></div>
                <?php
                    // Check if there are posts
                    if ( $query->have_posts() ) {
                        // Loop through the posts and store them in the array
                        $index = 1;
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            ?>
                                <div class="lg:pr-30px cursor-pointer product-item --js-product-item <?php echo $index == 1 ? 'current' : ''; ?>" data-index="<?php echo $index; ?>">
                                    <span><?php the_title(); ?></span>
                                </div>
                            <?php
                            $index++;
                        }
                    }

                ?>
            </div>
        </div>
        <div class="flex items-start w-full">
            <div class="w-full grid grid-cols-1 lg:grid-cols-2 col-span-1 lg:col-span-3 items-center gap-[20px]">
                <?php 
                // Rewind the query posts to start from the beginning again
                $query->rewind_posts(); 
                // Check if there are posts
                $index = 1;
                if ( $query->have_posts() ) {
                    // Loop through the posts and store them in the array
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $video = get_field('video');
                        ?>
                            <div class="product-content product-content-<?php echo $index; ?> lg:pr-30px" style="<?php echo $index != 1 ? 'display: none;' : ''; ?>"><?php echo get_the_content(); ?>
                            <?php
                                $linkLabel = get_field('custom_link_label', get_the_ID());
                            ?>
                                
                                <a href="/request-a-demo/<?php the_ID(); ?>" class="text-14px font-bold arrow-right tracking-[0.84px]" style="padding-right: 24px;"><?php echo $linkLabel ?? 'REQUEST A DEMO'; ?>  <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="product-content product-content-<?php echo $index; ?>" style="<?php echo $index != 1 ? 'display: none;' : ''; ?>"><?php echo $video; ?></div>
                        <?php
                        $index++;
                    }
                    // Reset post data
                    wp_reset_postdata();
                }
                ?>    
            </div>
        </div>
    </div>
</div>
</section>