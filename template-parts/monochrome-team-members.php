
<?php
    $postType = 'monochrome-team';
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

$teamMembers = [];
if ( $query->have_posts() ) {
    // Loop through the posts and store them in the array
    while ( $query->have_posts() ) {
        $query->the_post();

        $memberTitle = get_field('member_title');
        if ($memberTitle) {
            if (!isset($teamMembers[$memberTitle])) {
                $teamMembers[$memberTitle] = [];
            }

            $featured_img_url = null;
            if ( has_post_thumbnail() ) {
                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                if (strpos($featured_img_url, '30-307416_profile-icon-png-image-free-download-searchpng-employee.png')) {
                    $featured_img_url = get_template_directory_uri() . '/assets/img/team-member-placeholder.svg';
                }
            } else{
                $featured_img_url = get_template_directory_uri() . '/assets/img/team-member-placeholder.svg';
            }


            $teamMembers[$memberTitle][] = [
                'name' => get_the_title(),
                'position' => strip_tags(get_the_content()),
                'linkedin' => get_field('linkedin_url'),
                'image' => $featured_img_url
            ];
        }
    }
    // Reset post data
    wp_reset_postdata();
}


?>

<div class="monochrome-team-members pt-20px">
    <?php $totalCount = count(array_keys($teamMembers));
    foreach (array_keys($teamMembers) as $index => $memberTitle) { ?>
        <?php $group = $teamMembers[$memberTitle]; ?>
        <div class="grouped-members leading-[58px] <?php echo $index < $totalCount - 1 ? 'mb-[80px]' : ''; ?>">
            <h2 class="text-[28px] w-full pb-30px font-gt"><?php echo $memberTitle; ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[40px]">
                <?php foreach ($group as $member) { ?>
                    <?php get_template_part('template-parts/component','team-members', $member); ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>