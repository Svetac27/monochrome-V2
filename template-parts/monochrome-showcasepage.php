<?php 
$postType = 'monochrome-projects';
$limit = -1;

?>

<?php
// Get all categories used in the specified post type
$categories = get_terms( array(
    'taxonomy' => 'category',
    'object_ids' => get_posts( array(
        'post_type' => $postType,
        'posts_per_page' => -1,
        'fields' => 'ids',
    )),
));

// Get all tags used in the specified post type
$tags = get_terms( array(
    'taxonomy' => 'post_tag',
    'object_ids' => get_posts( array(
        'post_type' => $postType,
        'posts_per_page' => -1,
        'fields' => 'ids',
    )),
));

$platforms = ['all' => 'All'];
$tagsByCategory = ['all' => []];
foreach ($categories as $category) {
    $platforms[$category->slug] = $category->name;

    $temp = getTagsUsedInPostCategory($postType, $category->slug);
    $tagsByCategory[$category->slug] = $temp;
    $tagsByCategory['all'] = array_merge($tagsByCategory['all'], $temp);
}

$types = [];
foreach ($tags as $tag) {
    $types[$tag->slug] = $tag->name;
}

$selectedPlatform = 'all';
if (isset($_GET['platform']) && !empty($_GET['platform'])) {
    $selectedPlatform = $_GET['platform'];
}
$selectedType = null;
if (isset($_GET['types']) && !empty($_GET['types'])) {
    $selectedType = $_GET['types'];
}
?>

<section class="z-20 relative grid grid-cols-1 lg:flex justify-center items-start lg:px-page !py-0 gap-[20px] showcase-filters">
    <div class="platform-wrapper relative w-full lg:w-auto lg:px-5 relative lg:text-right grid items-center">
        <div class="platform-dropdown bg-gray-mid bg-blur rounded-30px px-5 py-4 inline-flex items-center mx-auto cursor-pointer whitespace-nowrap leading-[28px]">
            <div class="divider hidden lg:block absolute w-1px right-0 top-0 bg-black opacity-20 h-30px top-15px"></div>
            <span class="pr-10px">Platform:</span><span class="font-bold selected-platform pr-2"><?php echo $platforms[$selectedPlatform]; ?></span><i class="h-10px w-12px p-0 inline-flex icon-chevron-down"></i>
        </div>
        <div class="absolute left-[1rem] max-w-[180px] rounded-20px w-full platform-options">
            <ul class="text-left sub-menu py-4">
                <?php foreach ($platforms as $slug => $name) {
                    $catTags = [];
                    if (isset($tagsByCategory[$slug]) and count($tagsByCategory[$slug]) > 0) {
                        $catTags = array_keys($tagsByCategory[$slug]);
                    }
                    
                    ?>
                    <li data-value="<?php echo $slug; ?>" data-tags="<?php echo implode(',', $catTags); ?>" class="--js-showcase-platform cursor-pointer px-5 <?php echo $selectedPlatform == $slug ? 'font-bold' : ''; ?>">
                        <div class="w-full !flex items-center justify-between">
                            <span><?php echo $name; ?></span>
                            <i class="<?php echo $selectedPlatform == $slug ? '' : 'hidden'; ?> text-blue h-6 w-6 p-0">
                                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            </i>
                        </div>
                    </li>
                <?php } ?>
            </ul>

        </div>
    </div>

    <?php 
    $showAll = false;
    if (isset($_GET['types']) && !empty($_GET['types'])) {
        $showAll = true;
    }

    ?>
    <div class="w-auto flex flex-col lg:flex-row flex-wrap text-center gap-10px filter-wrapper justify-start <?php echo $showAll ? 'show-all' : ''; ?>">
        <div class="w-full flex lg:flex-wrap justify-start gap-10px filter-options">
            <?php
                $typeArray = explode(',', ($selectedType ?? ''));
            ?>
            <?php
                $sortedTags = get_option('sort_tags') ?? [];

                if (!is_array($sortedTags)) {
                    $sortedTags = (array)json_decode($sortedTags);
                }

                foreach ($types as $slug => $name) {
                    if (!in_array($tag->slug, array_keys($sortedTags))) {
                        $sortedTags[$slug] = $name;
                    }
                }

                $visibleTags = array_keys($tagsByCategory[$selectedPlatform] ?? []);

                foreach ($sortedTags as $slug => $tag_name) {
                    $isActive = '';
                    if ($selectedType && in_array($slug, $typeArray)) {
                        $isActive = 'active';
                    }
                    if (in_array($tag_name, $types)) {
                        ?>  
                        <div data-value="<?php echo $slug; ?>" class="<?php echo $isActive; echo in_array($slug, $visibleTags) ? '' : 'hidden'; ?> --js-showcase-types overflow-hidden leading-[28px] dropdown box !rounded-30px !px-5 !pt-4 !pb-14px inline-flex cursor-pointer">
                            <?php echo $tag_name; ?>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
    <div class="hidden lg:flex items-center min-w-[190px] justify-start <?php echo $showAll ? 'show-all' : ''; ?>">
        <button class="show-all-filter bg-transparent rounded-30px py-4 inline-block cursor-pointer overflow-hidden border-transparent flex items-center mx-auto h-[60px]">
            <span class="view-more whitespace-nowrap leading-[28px] items-center"><i class="h-16px icon-plus font-bold text-3 pr-10px pl-0"></i> View more</span>
            <span class="view-less whitespace-nowrap leading-[28px] items-center"><i class="h-16px icon-minus font-bold text-3 pr-10px pl-0"></i> View less</span>
        </button>
        <?php
            $showClearFilterButton = (isset($_GET['types']) && $_GET['types'] != '') || (isset($_GET['platform']) && $_GET['platform'] != '');

        ?>
        <button class="clear-filters" style="<?php echo $showClearFilterButton ? '' : 'display:none;'; ?>">
            <?php
                get_template_part(
                    'template-parts/icons',
                    null,
                    [
                        'icon' => 'reset',
                        'class' => 'ml-[70px]'
                    ]
                ); ?>
            </button>
    </div>
</section>


<?php

$queryArgs = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'title',
    'ignore_sticky_posts' => true,
    'order'   => 'ASC',
    'has_password' => false
);
$query = new WP_Query( $queryArgs ); 

?>
<section class="!pt-[55px] showcase-list">

    <div class="no-public-designs-found hidden text-center text-18px lg:text-36px tracking-[0px] leading-[96px] opacity-50 text-black capitalize font-gt">
        No Publicly Visible Designs With Those Filters
    </div>
    <div class="no-designs-found hidden text-center text-18px lg:text-36px tracking-[0px] leading-[96px] opacity-50 text-black capitalize font-gt">
    No Designs With Those Filters
    </div>

    <div class="w-full grid grid-cols-1 lg:grid-cols-4 gap-10px lg:gap-10 pc-contents">
        <?php 
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                get_template_part('template-parts/component', 'showcase', ['have_filters' => true, 'is-locked' => false]);
            }
            wp_reset_postdata();
        }
        ?>    
    </div>
    <?php
    $lockedItemsArgs = $queryArgs;
    $lockedItemsArgs['has_password'] = true;
    $lockedItemsArgs['posts_per_page'] = !ecAllowed() ? 8 : -1;
    $lockedItems = new WP_Query( $lockedItemsArgs ); 
    
    if ( $lockedItems->have_posts() ) { ?>
        
        <div class="flex flex-col <?php echo !ecAllowed() ? 'lg:flex-row' : ''; ?> items-center justify-center gap-30px my-40px ec-elm hidden">
            <?php if (!ecAllowed()) { ?>
                <span class="text-20px text-center lg:text-left text-description">Want to see more? Click here to get access to more designs</span><a href="#contact" data-form="Request Showcase Access" class="btn tracking-[0.84px]">Unlock exclusive content</a>
            <?php } else { ?>
                <div class="font-gt text-32px"><?php echo $args['ec-title'] ?? 'Exclusive Contents'; ?></div>
                <?php if (isset($args['ec-description']) and !empty($args['ec-description'])) { ?>
                    <div class="font-gilroy text-18px"><?php echo $args['ec-description']; ?></div>
                <?php } ?>
            <?php } ?>
        </div>


        <div class="ec-elm hidden ec-items w-full grid grid-cols-1 lg:grid-cols-4 gap-10px lg:gap-10 p-4 -m-4 <?php echo !ecAllowed() ? 'locked-items-wrapper' : ''; ?>" style="width: calc(100% + 2rem); max-width: calc(100% + 2rem);">
            <?php // if (ecAllowed()) {
                $index = 0;
                while ( $lockedItems->have_posts() ) {
                    $lockedItems->the_post();
                    get_template_part('template-parts/component', 'showcase-locked', ['index' => $index]);
                    $index++;
                }
                wp_reset_postdata();
            //} else {
                // for ($i = 0; $i < 8; $i++) {
                //     get_template_part('template-parts/component', 'showcase-locked');
                // }
            // }
            ?>    
        </div>
    <?php } ?>
</section>
