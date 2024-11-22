<div class="box team-member-box flex grid-cols-2 !p-0">
    <div class="image-profile h-[120px] w-[120px] lg:h-[181px] lg:w-[181px] pl-full bg-cover bg-center" style="background-image: url(<?php echo $args['image']; ?>);"></div>
    <div class="relative member-details-wrapper" >
        <a href="<?php echo $args['linkedin']; ?>" class="absolute top-[20px] right-[20px] opacity-30 text-black">
            <?php get_template_part('template-parts/icons', null, ['icon' => 'linkedin']); ?>
        </a>

        <div class="absolute member-details top-1/2 px-30px translate-y-1/2">
            <h3 class="whitespace-no-wrap font-gilroy-semi-bold text-18px leading-[28px] tracking-0 pb-10px"><?php echo $args['name'] ?? ''; ?></h3>
            <div class="text-4 leading-[22px] font-gilroy"><?php echo $args['position']; ?></div>
        </div>
    </div>
</div>  