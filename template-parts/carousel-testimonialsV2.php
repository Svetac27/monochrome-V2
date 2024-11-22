<?php 
$query = new WP_Query( $args ); 
$total = $query->post_count;
?>
<div class="items-center block md:grid">
    <div class="relative h-full w-full grid grid-cols-1 md:grid-cols-2 slider-v2 gap-15 lg:gap-30" data-current-slide="0" data-count="<?php echo $total; ?>" data-type="testimonials" data-animate="false">
        <div style="aspect-ratio: 14 / 9;" class="relative w-100% max-w-full mx-auto pb-8 md:pb-0">
            <?php
                    
                $index = 1;
                while ( $query->have_posts() ) : $query->the_post();
                    $video = get_field('video_testimonial');
                    $video = remove_attribute($video, 'height');
                    $video = remove_attribute($video, 'width');
                ?>
                    <div
                        data-slide="<?php echo $index; ?>"
                        class="slide-image video w-full <?php echo $index == 1 ? 'active' : 'initial-position '; ?>"
                    ><?php echo $video; ?></div>
                <?php
                $index++;       
                endwhile;
            ?>
            <div class="slide-timer items-center text-white w-full md:hidden absolute top-full left-0 z-40">
                <div class="w-full">
                    <div class="relative w-full md:inline-block md:w-auto text-center">
                        <div class="inline-flex relative w-auto items-center justify-center gap-[10px] py-2 mt-4">
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
        <div class="w-full relative min-h-[150px] lg:min-h-[360px]">
            <?php $query->rewind_posts();
            if ( $query->have_posts() ) {
                $index = 1;
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                    <div
                        data-slide="<?php echo $index; ?>"  
                        class="w-full slide-image testimonial <?php echo $index == 1 ? 'active' : 'initial-position '; ?> absolute-v-middle"
                    >
                        <div class="md:px-[1em]">
                            <div class="testimonials font-gilroy italic text-4 md:text-18px leading-[28px] tracking-[0px]">
                                <i class="icon-double-quotes open text-blue px-0 text-2 align-top pb-2px"></i>
                                <?php echo strip_tags(get_the_content()); ?>
                                <i class="icon-double-quotes close text-blue px-0 text-2 align-top pt-2px"></i>
                            </div>
                            <div class="pt-30px font-gilroy opacity-80 text-14px leading-[28px] tracking-[0px] md:text-4"><?php echo get_the_title(); ?></div>
                        </div>
                    </div>
                    <?php
                    $index++;
                } ?>

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
        </div>
    </div>
</div>