
<?php
    $postType = 'monochrome-offices';
    $limit = $args['limit'] ?? -1;
    $order = $args['order'] ?? 'ASC';

    $queryArgs = array(  
        'post_type' => $postType,
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order'   => $order,
        'ignore_sticky_posts' => true,
    );
        
    
    
$query = new WP_Query( $queryArgs ); 
$resultCount = $query->post_count;

$bg = $args['bg'] ?? get_template_directory_uri() . '/assets/img/new-map.svg';
?>

<div class="monochrome-offices default-padding box-nopadding py-[40px] px-30px lg:py-[105px] lg:px-[50px] bg-contain bg-no-repeat bg-right"
    <?php if ($bg) { echo 'style="background-image: url('.$bg.')"'; } ?>
>
    <h2 class="w-full mb-15px"><?php echo $args['title'] ?? 'One team, three offices'; ?></h2>

    <div class="w-full lg:w-3/5 grid grid-cols-1 md:grid-cols-3 gap-20px">
        <?php
        if ( $query->have_posts() ) {
            // Loop through the posts and store them in the array
            while ( $query->have_posts() ) {
                $query->the_post();
                ?>
                    <div class="border-1px border-black rounded-[10px] border-opacity-20 office-box py-[50px] px-30px default-padding">
                        <div class="font-gilroy-semi-bold text-18px"><?php echo get_the_title(); ?></div>
                        <div class="pt-2 text-14px"><?php echo strip_tags(get_the_content()); ?></div>
                    </div>
                <?php
            }
            // Reset post data
            wp_reset_postdata();
        }
        ?>
    </div>
</div>