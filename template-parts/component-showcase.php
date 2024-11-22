<?php
$logo = get_field('logo') ?? null;
$post_categories = get_the_category();

$mapped = gettype($post_categories) == 'array' ? array_map(function($arr) {
    return 'showcase-platform-' . $arr->slug;
}, $post_categories) : [];
$categoryAsClass = implode(' ', $mapped);


$post_tags = get_the_tags();

$mapped = gettype($post_tags) == 'array' ? array_map(function($arr) {
	return 'showcase-type-' . $arr->slug;
}, $post_tags) : [];

$tagsAsClass = implode(' ', $mapped);


$label = '';

if (isset($args['is-locked']) && $args['is-locked'] === true) {
    if (gettype($post_categories) == 'array' && count($post_categories)) {
        $label = $post_categories[0]->name;
    }
}

if (gettype($post_tags) == 'array' && count($post_tags)) {
    $label = ($label == '' ? '' : $label . ' - ') . $post_tags[0]->name;
}

$haveValidPlatform = true;
$haveValidType = true;
    
// check if passed the platform filter
if (isset($_GET['platform']) && !empty($_GET['platform']) && $_GET['platform'] != 'all' && $_GET['platform'] != '') {

    $haveValidPlatform = in_array(
        $_GET['platform'],
        array_map(
            function($arr) {
                return $arr->slug;
            },
            $post_categories
        )
    );
}

if (isset($_GET['types']) && !empty($_GET['types']) && $_GET['types'] != '') {
    if (gettype($post_tags) == 'array' && count($post_tags)) {

        $arrTypes = array_filter(
            explode(',', $_GET['types']),
            function($value) {
                return $value;
            }
        );
        
        if (!empty($arrTypes)) {
            $postTagsSlugs = array_filter(
                array_map(
                    function($a) {
                        return $a->slug ?? null;
                    },
                    $post_tags
                ),
                function($value) {
                    return $value;
                }
            );
    
            $haveValidType = empty(
                array_diff(
                    $arrTypes,
                    $postTagsSlugs   
                )
            );
        }
    } else {
        $haveValidType = false; 
    }
}

?>
<div class="<?php echo $haveValidPlatform && $haveValidType ? '' : 'hidden' ?> showcase-item h-auto md:h-51 w-full relative overflow-hidden text-center box rounded-20px  <?php echo $categoryAsClass . ' ' . $tagsAsClass; ?>">

    <a href="<?php echo get_permalink(); ?>" <?php echo post_password_required() ? 'locked' : ''; ?> class="showcase-slideup showcase-item-link flex items-center text-left md:text-center md:block relative p-15px md:absolute top-0 left-0 w-full md:p-8">
        <?php if ($logo): ?>
            <?php
                if (is_numeric($logo)) {
                    $logo = wp_get_attachment_url( $logo );
                }
            ?>
        <?php endif; ?>

        <div class="mx-auto md:pb-14px opacity-65 showcase-item-image">
            <img class="hidden md:block mx-auto h-20" src="<?php echo $logo; ?>">
            <div class="md:hidden w-55px h-55px bg-cover bg-center" style="aspect-ratio: 1 / 1;background-image:url(<?php echo $logo; ?>)">
            </div>
        </div>
        <div class="w-full pl-5 md:pl-0 info">
            <strong class="showcase-item-title my-4 text-4 text-black font-gilroy-semi-bold"><?php echo get_the_title(); ?></strong>
            <div class="showcase-item-text pt-15px pb-20px text-14px text-black opacity-80"><?php echo $label; ?></div>
        </div>
        <div class="the-featured-image hidden md:block px-18px">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('full', [
                    'class' => 'mx-auto w-full rounded-5px',
                ]);
            } else {
                
                $gallery = get_post_meta(get_the_ID(), '_my_gallery', true);
                $mobileGallery = get_post_meta(get_the_ID(), '_my_mobile_gallery', true);
                $image = false;
                if($gallery && count($gallery)) {
                    $image = $gallery[0];
                } else if($mobileGallery && count($mobileGallery)) {
                    $image = $mobileGallery[0];
                } 

                if ($image !== false) {
                    ?>
                    <img
                        loading="lazy"
                        decoding="async"
                        src="<?php echo $image; ?>"
                        class="mx-auto w-full rounded-5px wp-post-image" 
                    >
                    <?php 
                }
            } ?>
        </div>
    </a>
</div>
<?php 