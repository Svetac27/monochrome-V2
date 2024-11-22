
<div class="box blog-item relative overflow-hidden !p-0">
    <?php
        if ( has_post_thumbnail() ) {
            // Post has a thumbnail
            $thumbnail_url = get_the_post_thumbnail_url( null, 'full' ); // 'full' specifies the size of the thumbnail
        } else {
            // Post does not have a thumbnail
            // display placeholder
            $thumbnail_url = 'https://staging-ffab-monochromecouk.wpcomstaging.com/wp-content/uploads/2024/06/placeholder.webp';
        }
    ?>
    <div class="w-full bg-cover bg-center" style="aspect-ratio: 16 / 9;background-image: url(<?php echo $thumbnail_url; ?>);"></div>
    <div class="py-40px px-32px text-left">
        <h2 class="text-24px leading-[38px] mb-10px"><?php echo get_the_title(); ?></h2>
        <div class="relative overflow-hidden">
            <div class="blog-excerpt tabs:text-4 lg:leading-[28px] ">
            <?php
            if ( has_excerpt() ) {
                // Post has an excerpt
                echo get_the_excerpt();
            } else {
                // Post does not have an excerpt
                echo strip_tags(get_the_content());
            }
            ?>
            </div>
            <div class="blog-read-more hidden tab:block">
                <a class="cursor-pointer block btn tracking-[0.84px] relative" href="<?php echo get_the_permalink(); ?>">Read more</a>
            </div>
        </div>
    </div>
</div>