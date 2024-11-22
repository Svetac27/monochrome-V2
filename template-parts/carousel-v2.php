<?php 

// $args['posts_per_page'] = 2;
$loop = new WP_Query( $args ); 
$total = $loop->post_count;


$data = [];
$x = 0;
while ( $loop->have_posts() ) : $loop->the_post(); 
    $full_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $mobile_image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); // 768px wide

    $data[] = [
        'id' => get_the_ID(),
        'title' => get_the_title(),
        'excerpt' => get_the_excerpt(),
        'image' => $full_image_url,
        'mobile_image' => $mobile_image_url,
        'background' => get_field('background_image'),
        'url' => get_field('find_out_more_link'),
        'open_in_new_tab' => get_field('open_link_in_new_tab'),

        // for test purposes
        // 'image' => $x % 2 == 0 ? 'https://i0.wp.com/staging-ffab-monochromecouk.wpcomstaging.com/wp-content/uploads/2024/04/banner01-2.png?fit=3120%2C2954&ssl=1' : 'https://i0.wp.com/staging-ffab-monochromecouk.wpcomstaging.com/wp-content/uploads/2024/04/banner02.png?fit=2048%2C2048&ssl=1',
        // 'mobile_image' => $x % 2 == 0 ? 'https://i0.wp.com/staging-ffab-monochromecouk.wpcomstaging.com/wp-content/uploads/2024/04/banner01-2.png?fit=768%2C727&ssl=1' : 'https://i0.wp.com/staging-ffab-monochromecouk.wpcomstaging.com/wp-content/uploads/2024/04/banner02.png?fit=768%2C768&ssl=1',
        // 'url' => '/asdasd/'

    ];

    $x++;
endwhile;
wp_reset_postdata(); 
?>

<div class="w-full relative slider-v2" autoplay data-current-slide="0" data-count="<?php echo count($data); ?>" data-type="carousel">
    <div class="overlay-bg"></div>
    <?php foreach ($data as $index => $item) : ?>
        <div
            data-slide="<?php echo $index + 1; ?>"
            class="absolute h-full w-full slide-image slide-background bg-no-repeat bg-cover initial-position <?php echo $index == 0 ? 'active' : ''; ?>"

            <?php if (false && isset($item['background'])) { ?>
                style="background-image: url(<?php echo $item['background']; ?>);"
            <?php } ?>
        ></div>
    <?php endforeach; ?>

    <div class="px-page h-full w-full pt-[80px] absolute slide-info pb-40px lg:!pb-0">
        <div class="h-full w-full page-wrapper mx-auto">
            <div class="w-full h-full grid lg:flex items-center">
                <?php // use this as holder for transition ?>
                <div class="pb-[80px] text-column min-h-[250px] w-full lg:w-1/2 flex items-start pt-0 lg:block relative">

                    <?php foreach ($data as $index => $item) : ?>
                        <div
                            data-slide="<?php echo $index + 1; ?>"
                            class="slide-details text-center w-full lg:pr-[10%] lg:text-left <?php echo $index == 0 ? 'active' : ''; ?>"
                        >
                            
                            <div class="title">
                                <h2 class="text-8 md:text-48px md:leading-[60px] lg:text-70px leading-[40px] lg:leading-24 tracking-[1]"><?php echo $item['title']; ?></h2>
                            </div>
                            <div class="text-14px md:text-18px md:leading-[34px] lg:text-5 py-15px lg:pb-30px"><?php echo $item['excerpt'] ?? ''; ?></div>
                            <?php
                            if ($item['url']) { ?>
                                <a href="<?php echo $item['url']; ?>"
                                    <?php echo isset($item['open_in_new_tab']) && $item['open_in_new_tab'] == true ? 'target="_blank"' : ''; ?>
                                    class="font-gilroy-semi-bold uppercase text-3 lg:text-14px arrow-right tracking-[0.84px]">FIND OUT MORE</a>
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>


                    <div class="slide-timer mt-[20px] items-center text-white w-full absolute lg:inline-flex hidden left-0 z-40 top-full" style="display: none;">
                        <div class="w-full">
                            <div class="timer-wrapper relative w-full lg:inline-block lg:w-auto blur-bg lg:rounded text-center">
                                <div class="inline-flex relative w-auto items-center justify-center gap-[10px] py-20px px-22px">
                                    <?php for ($i = 0; $i < $total; $i++): ?>
                                        <div class="timer cursor-pointer" data-slide-timer="<?php echo $i + 1; ?>">
                                            <div class="clickable"></div>
                                        </div> 
                                    <?php endfor; ?>
                                    
                                    <a class="prev text-black hidden lg:flex cursor-pointer text-14px"><i class="font-bold p-0 pl-3 icon-chevron-left"></i></a>
                                    <a class="next text-black hidden lg:flex cursor-pointer text-14px"><i class="font-bold p-0 pl-4 icon-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="image-column w-full min-h-50vh lg:w-1/2 h-full relative">
                    <?php foreach ($data as $index => $item) : ?>
                        <div
                            data-slide="<?php echo $index + 1; ?>"
                            class="relative h-full w-full slide-image initial-position <?php echo $index == 0 ? 'active' : ''; ?>"
                        >
                            <div
                            class="hidden md:block image-item image-item-<?php echo $index + 1; ?> bg-no-repeat bg-bottom bottom-0 left-0 bg-contain absolute h-full max-w-none"
                            style="background-image: url(<?php echo $item['image']; ?>);"
                            ></div>
                            <div
                            class=" md:hidden image-item image-item-<?php echo $index + 1; ?> bg-no-repeat bg-bottom bottom-0 left-0 bg-contain absolute h-full max-w-none"
                            style="background-image: url(<?php echo $item['mobile_image']; ?>);"
                            ></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="slide-timer items-center text-white w-full absolute lg:hidden left-0 z-40 bottom-0">
        <div class="w-full">
            <div class="timer-wrapper relative w-full lg:inline-block lg:w-auto blur-bg lg:rounded text-center">
                <div class="inline-flex relative w-auto items-center justify-center gap-[10px] px-22px py-2 h-10">
                    <div class="absolute h-full w-screen max-w-none left-1/2 top-0 bg-blue-light opacity-75" style="transform: translateX(-50%);"></div>
                    <?php for ($i = 0; $i < $total; $i++): ?>
                        <div class="timer cursor-pointer" data-slide-timer="<?php echo $i + 1; ?>">
                            <div class="clickable"></div>
                        </div> 
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-bottom-gradient-bg absolute bottom-0 h-[299px] w-full z-20"></div>
    <div class="absolute bottom-[1.25rem] z-30 global-brands-desktop" style="z-index:25;">
        <?php get_template_part('template-parts/global', 'brands', ['hideTitle' => true]); ?>
    </div>
</div>
