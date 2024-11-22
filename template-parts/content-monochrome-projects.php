<article id="post-<?php the_ID(); ?>" class="<?php echo implode(' ', get_post_class()); ?>">
	<section
		class="mx-auto w-full page-wrapper grid grid-cols-1 pb-[70px] lg:pb-0 lg:flex lg:gap-[90px]"
	>
		<div class="w-full lg:w-4/10 sticky-wrapper">
			<div class="sticky-element">
				<header class="text-left">
					<?php
					the_title( '<h1 class="text-8 lg:text-70px lg:leading-[84px]">', '</h1>' );

					$category = get_primary_category(get_the_ID());
					$tag = get_single_tag(get_the_ID());

					// get all tags
					$tags = get_the_tags(get_the_ID());
					$tagsToLinks = array_map(function ($arr) use ($category) {
						if ($category) {
							return '<a class="underline normal-case text-16px leading-[0.84px] tracking-[0.8px]" href="/showcase?platform='.$category->slug.'&types='.$arr->slug.'">'.$arr->name.'</a>';
						} else {
							return '<a class="underline normal-case text-16px leading-[0.84px] tracking-[0.8px]" href="/showcase?types='.$arr->slug.'">'.$arr->name.'</a>';
						}
					}, $tags);


					?>
					<div class="text-3 lg:text-4 uppercase text-black opacity-80 pt-6px lg:pt-30px lg:pb-20px">
						<?php
							if ($category && $tag) {
								echo '<a class="underline text-16px leading-[0.84px]" href="/showcase?platform='.$category->slug.'">'. $category->name . '</a> - ' . implode(', ', $tagsToLinks);
							} else if ($category || $tag) {
								echo $category ? '<a class="underline text-16px leading-[0.84px]" href="/showcase?platform='.$category->slug.'">'. $category->name . '</a>' : implode(', ', $tagsToLinks);
							}
						?>
					</div>
				</header><!-- .entry-header -->

				<div class="!text-14px">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</div>
		</div>
		<div class="w-full lg:w-6/10">
			<?php if (has_post_thumbnail()): ?>
				<?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
					<img class="w-full rounded-20px" style="box-shadow: 0px 10px 30px #011A1E26;" src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
			<?php endif; ?>
			

			<?php
			$gallery = get_post_meta(get_the_ID(), '_my_gallery', true);
			if($gallery) : ?>
				<?php foreach($gallery as $image): ?>
					<?php 
						// Get the image ID from the URL
						$attachment_id = attachment_url_to_postid($image);
						
						// Get the image title
						$image_title = get_the_title($attachment_id);
					?>
					<img class="w-full rounded-20px mt-[60px]" style="box-shadow: 0px 10px 30px #011A1E26;" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_title); ?>" >
				<?php endforeach; ?>
			<?php endif; ?>

			<?php
			$gallery = get_post_meta(get_the_ID(), '_my_mobile_gallery', true);
			if($gallery) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-10px md:gap-40px">
					<?php foreach($gallery as $image): ?>
						<?php 
							// Get the image ID from the URL
							$attachment_id = attachment_url_to_postid($image);
							
							// Get the image title
							$image_title = get_the_title($attachment_id);
						?>
						<img class="w-full rounded-20px mt-[60px]" style="box-shadow: 0px 10px 30px #011A1E26;" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_title); ?>" >
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<footer class="entry-footer">
		<?php monochrome_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
