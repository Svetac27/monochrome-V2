
<li class="box !p-0 faq-item">
    <div class="flex px-5 py-6 justify-between items-center accordion-title cursor-pointer text-3 text-black">
        <span class="text-4 font-gilroy-semi-bold"><?php the_title(); ?> </span><i class="text-10px icon-chevron-down !p-0 flex h-7px w-14px"></i>
    </div>
    <div class="faq-answer h-0 h-auto overflow-hidden">
        <div class="px-5 pb-6"><?php echo get_the_content(); ?></div>
    </div>
</li>