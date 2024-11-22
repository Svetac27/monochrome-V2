<?php 
$postType = 'monochrome-pricing';
$limit = 4;

$args = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
    'ignore_sticky_posts' => true,
    'order'   => 'ASC',
    'post_parent'    => 0, // Get only parent posts
);
$query = new WP_Query( $args ); 
?>
<section class="lg:!pt-0 lg:!mt-50px">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-7 pricing">
        <?php 
        // Check if there are posts
        if ( $query->have_posts() ) {
            // Loop through the posts and store them in the array
            $index = 1;
            while ( $query->have_posts() ) {
                $query->the_post();
                $packages = array_map(function($arr) {
                    $temp = explode(':', $arr);

                    $newData = [];
                    $newData['package'] = isset($temp[1]) && !empty(trim($temp[1])) ? trim($temp[0]) : implode(':', $temp);

                    if (isset($temp[1]) && !empty(trim($temp[1]))) {
                        $newData['tooltip'] = trim($temp[1]);
                    }

                    return $newData;
                }, explode("\n", get_field('package_includes')));

                $buttonLabel = get_field('button_label');
                $icon = get_field('icon');
                $iconLocation = get_field('icon_position');
                $isPopular = get_field('popular');
                $packagePrice = get_field('package_price');
                $resourcePoints = get_field('resource_points');
                ?>
                <div class="relative <?php echo $index == 2 ? '' : 'lg:py-4'; ?>">
                    <div class="pricing-box box-nopadding max-w-[450px] mx-auto h-full <?php echo $index == 2 ? '' : ''; ?> rounded-[20px] pb-[100px] lg:pb-[105px] px-20px pt-40px lg:pt-12 lg:px-40px overflow-hidden relative"
                    >
                        <div
                        class="overlay absolute top-0 left-0 w-full h-full z-[-1] opacity-20"
                        style="<?php echo $index == 2 ? 'background: transparent linear-gradient(180deg, #09A3BFCC 0%, #09A3BF00 100%) 0% 0% no-repeat padding-box;backdrop-filter: blur(10px);-webkit-backdrop-filter: blur(10px);' : ''; ?>;"
                        ></div>
                        <?php if ($isPopular === true): ?>
                            <div class="absolute top-16px right-20px text-12px text-blue font-gilroy-semi-bold uppercase tracking-[1.2px]">
                                <i class="icon-star text-4 font-bold p-0 pr-10px"></i>Recommended
                            </div>
                        <?php endif; ?>
                        <h2 class="text-22px lg:text-40px <?php echo $index == 2 ? 'lg:pt-4' : ''; ?>"><?php the_title(); ?></h2>
                        <div class="pt-10px pb-15px text-14px lg:text-4"><?php echo strip_tags(get_the_content()); ?></div>
                        <?php if ($packagePrice) {

                            [$price, $per] = array_pad(
                                explode('/', $packagePrice),
                                2,
                                null
                            );

                            ?><div class="whitespace-nowrap flex items-baseline pricing-price"><?php
                            if ($price) { ?>
                                <div
                                    class="font-gt <?php echo $per ? 'text-22px lg:text-40px' : 'text-4 md:text-7 pt-18px'; ?>"
                                ><?php echo $price; ?></div>
                            <?php }
                            if ($per) { ?>
                                <div class="font-gt text-4 lg:text-24px"><span class="px-2">/</span><?php echo trim($per); ?></div>
                            <?php }
                            ?></div><?php
                        } ?>

                        <?php if ($resourcePoints) {
                            ?><div class="text-14px lg:text-4 leading-[12px] pt-10px pb-5px opacity-80"><?php echo $resourcePoints; ?></div> <?php
                        } ?>

                        <?php if (count($packages) > 0): ?>
                            <div class="divider bg-black h-1px flex w-full opacity-20 my-35px"></div>
                            <div class="uppercase text-black opacity-80 text-12px lg:text-14px leading-[0.6px] pb-31px inline-block tracking-[0.84px] tier-includes"><?php the_title(); ?> includes: </div>
                            <ul>
                                <?php foreach ($packages as $item) { ?>
                                    <li class="py-8px">
                                        <div class="relative inline-flex items-center text-14px lg:text-4">
                                            <?php get_template_part('template-parts/icons', null, ['icon' => 'check', 'class' => ' m-0 mr-15px h-25px w-25px ' . ( $index == 2 ? 'text-blue' : 'opacity-80')]); ?>
                                            <div class="opacity-80"><?php echo $item['package']; ?></div>
                                            <?php if (isset($item['tooltip'])): ?>
                                                <i class="cursor-pointer icon-info tooltip-icon text-5 font-bold" alt="<?php echo $item['tooltip']; ?>" aria-hidden="true">
                                                </i>

                                                <div class="absolute bottom-full right-0 p-4 text-white bg-black rounded tooltip-msg">
                                                    <?php echo $item['tooltip']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php endif; ?>
                        <?php
                        $buttonLink = '#contact';
                        $action = get_field('button_action', get_the_ID());
                        $formToOpen = null;

                        if (!$action || $action == 'Open Link') {
                            $buttonLink = get_field('button_link', get_the_ID());
                        } else if ($action) {
                            $formToOpen = $action;
                        }

                        ?>

                        <a href="<?php echo $buttonLink; ?>" <?php if ($formToOpen) { echo 'data-form="'.$formToOpen.'"'; } ?> class=" absolute h-60px lg:h-20 bottom-0 left-0 w-full uppercase font-gilroy-semi-bold text-12px lg:text-14px flex items-center justify-center gap-15px
                            <?php echo $index == 2 ? 'bg-blue text-white tracking-[1.4px]' : 'bg-black bg-opacity-10 text-black tracking-[0.84px]'; ?>
                            <?php echo $icon !== 'clock' ? 'animate-icon' : ''; ?>
                        ">
                            <?php
                            $str = '';
                            $style = ($icon == 'clock' ? '' : 'style="display:contents;font-size:normal;"');

                            ob_start();

                            // Load the template part (replace 'your-template-part' with the actual slug)
                            get_template_part('template-parts/icons', null, [
                                'icon' => $icon,
                                'class' => 'inline-flex p-0' . ($icon == 'clock' ? 'h-21px w-21px text-21px' : 'h-14px w-14px text-14px '),
                            ]);
                            
                            // Get the template part output as a string
                            $template_part_output = ob_get_clean();

                            if ($iconLocation == 'left') {
                                // if ($index == 2) {
                                    $str .= $template_part_output;
                                // } else {
                                //     $str .= '<i class="'.($index == 2 ? 'text-white' : '').' inline-flex '.($icon == 'clock' ? 'p-0 h-21px w-21px text-21px' : '').' icon-'.$icon.'" '.$style.'></i>';
                                // }
                            }
                            $str .= $buttonLabel;
                            if ($iconLocation != 'left') {
                                // if ($index == 2) {
                                    $str .= $template_part_output;
                                // } else {
                                //     $str .= '<i class="inline-flex '.($icon == 'clock' ? 'p-0 h-21px w-21px text-21px' : '').' icon-'.$icon.'" '.$style.'></i>';
                                // }
                            }

                            echo $str;
                            ?>
                        </a>
                    </div>
                </div>
                <?php
                $index++;

                $index = $index > 3 ? 1 : $index;
            }
            // Reset post data
        }
        wp_reset_postdata();
        ?>
    </div>
</section>