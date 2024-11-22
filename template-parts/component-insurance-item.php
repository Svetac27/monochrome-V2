<div class="border-1px border-black rounded-[10px] insurance-item px-20px !pb-[46px] pt-[60px] w-[200px] mx-auto">
    <?php
      $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>

    <div class="insurance-image bg-contain bg-center bg-no-repeat h-[64px] w-full mb-30px" style="background-image:url(<?php echo $thumbnail_url; ?>)"></div>
    <div class="insurance-title font-gilroy-semi-bold text-center"><?php echo get_the_title(); ?></div>
</div>