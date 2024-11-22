<?php

if (isset($args['id'])) {
    $post_id = $args['id'];
    $post = get_post($post_id);

    if ($post) { ?>
        <div class="wp-block-columns">
            <div class="box-nopadding py-12 px-6 lg:py-[55px] lg:px-[80px] grid grid-cols-1 lg:grid-cols-2 w-full items-center default-padding">
                <div class="w-full">
                    <h2 class="text-30px lg:text-40px lg:leading-[58px] capitalize font-gt pb-30px"><?php echo $post->post_title; ?></h2>
                    <div class="font-gilroy text-14px lg:text-16px leading-[28px] opacity-80 text-black pb-30px"><?php echo $post->post_content; ?></div>
                    <div class="download-link text-blue flex gap-10px items-center pb-30px lg:pb-0">
                        <?php
                            get_template_part('template-parts/icons', null, ['icon' => 'download2']);

                            $downloadLink = get_field('download_link', $post_id);
                            $downloadLinkLabel = get_field('download_link_label', $post_id) ?? 'Download Now';
                            $downloadSize = get_field('download_size', $post_id);
                            $linkAction = get_field('link_action', $post_id) ?? 'Open Link';
                        ?>

                        <div class="flex flex-wrap items-center gap-x-10px">
                            <a
                                href="<?php echo $linkAction == 'Open Link' ? $downloadLink : '#contact' ?>"
                                <?php echo $linkAction != 'Open Link' ? 'data-form="'.$linkAction.'"' : '' ?>
                                class="text-black text-14px tracking-[0.84px] leading-[24px] uppercase font-gilroy-semi-bold"
                            >
                                <?php echo $downloadLinkLabel; ?>
                            </a>
                            <div class="text-12px text-black opacity-80 tracking-[0.72px] leading-[28px] font-gilroy">
                                <?php echo strip_tags($downloadSize); ?>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="w-full">
                    <?php if (has_post_thumbnail($post_id)) { ?>
                    <?php 
                    $thumbnail_id = get_post_thumbnail_id($post_id);
                    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');
                    ?>
                    <img class="h-full max-w-full w-auto" src="<?php echo $thumbnail_url[0]; ?>" />
                    <?php } ?>        
                </div>
            </div>
        </div>
    <?php } wp_reset_postdata(); ?>
<?php } ?>

