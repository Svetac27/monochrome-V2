<?php
    // $args['posts_per_page'] = 1;
    $query = new WP_Query( $args ); 
    $total = $query->post_count;

    if ($total > 0) {
?>
<div class="page-wrapper items-center block md:grid wp-block-columns">
    <div class="box-nopadding py-40px px-32px lg:py-[100px] lg:px-[80px] default-padding relative h-full w-full grid grid-cols-1 slider-v2 no-video gap-15 lg:gap-30" data-current-slide="0" data-count="<?php echo $total; ?>" data-type="testimonials" data-animate="false">
        <div class="w-full relative">
            <?php 
            $query->rewind_posts();
            if ( $query->have_posts() ) {
                $index = 1;
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                    <div
                        data-slide="<?php echo $index; ?>"  
                        class="w-full testimonial <?php echo $index == 1 ? 'active' : 'initial-position'; ?>"
                    >
                        <div>
                            <div class="testimonials font-gt-light-italic text-22px md:text-28px md:leading-[44px] text-18px leading-[28px] tracking-[0px] relative">
                                <span class="text-blue text-40px font-gilroy-bold absolute top-0 left-0">"</span>
                                <?php echo strip_tags(get_the_content()); ?>
                            </div>
                            <div class="flex items-center justify-start gap-20px mt-30px">
                                <?php 
                                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // For example, 'large'
                                    if ($thumbnail_url && strpos($thumbnail_url, 'customer-success-manager') === false) { ?>
                                        <div class="h-[60px] w-[60px] rounded-[50%] bg-cover bg-center bg-white" style="background-image: url(<?php echo $thumbnail_url; ?>)"></div>
                                    <?php } else { ?>
                                        <?php get_template_part('template-parts/icons', null, ['icon' => 'customer-success-manager', 'class' => 'h-[60px] w-[60px] rounded-[50%]']); ?>
                                    <?php } ?>
                                <div>
                                    <div class="testimonial-author font-gilroy-semi-bold text-18px leading-[28px]"><?php echo get_the_title(); ?></div>
                                    <div class="font-gilroy text-14px leading-[22px] opacity-80"><?php echo get_field('author_position', get_the_ID()); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $index++;
                } ?>

                <?php if ($total > 1) { ?>
                    <div class="--js-content-height">
                        <div class="slide-timer items-center text-white w-full hidden md:inline-block absolute bottom-[2rem] left-0 z-40 md:px-[1em]">
                            <div class="w-full">
                                <div class="relative w-full md:inline-block md:w-auto text-center">
                                    <div class="inline-flex relative w-auto items-center justify-center gap-[10px] py-2">
                                        <?php for ($i = 0; $i < $total; $i++): ?>
                                            <div class="timer blue" data-slide-timer="<?php echo $i + 1; ?>"></div> 
                                        <?php endfor; ?>
                                        <a class="prev text-black px-1 hidden lg:flex cursor-pointer text-14px"><i class="font-bold p-0 icon-chevron-left"></i></a>
                                        <a class="next text-black px-1 hidden lg:flex cursor-pointer text-14px"><i class="font-bold p-0 icon-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            <?php } else { echo 'no data'; } ?>
        </div>
    </div>
</div>
<?php } ?>