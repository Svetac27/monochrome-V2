<?php
$isModal = !isset($args['is-modal']) ? true : (isset($args['is-modal']) && $args['is-modal'] == true);
?>


<div class="modal-locked-modal z-[1000] <?php echo $isModal ? 'hidden' : ''; ?> locked-modal text-white block items-center justify-center fixed w-full h-screen top-0 left-0 z-100">
    <div class=" box dark h-full w-full flex justify-center items-center relative !rounded-none">

        <?php if ($isModal): ?>
            <span class="text-gray cursor-pointer close-modal absolute top-[42px] text-4 right-[42px] z-100" onclick="document.querySelector('.open-locked-modal').classList.remove('open-locked-modal')">
                <div class="text-white p-0">
                <?php get_template_part('template-parts/icons', null, ['icon' => 'close']); ?>
                </div>
            </span>
        <?php else: ?>
            <span class="text-gray cursor-pointer close-modal absolute top-[42px] text-4 right-[42px] z-100" onclick="window.location.href= '/showcase'">
                <div class="text-white p-0">
                <?php get_template_part('template-parts/icons', null, ['icon' => 'close']); ?>
                </div>
            </span>

        <?php endif; ?>


        <div class="text-center">
            <h1 class="entry-title text-32px md:text-40px lg:text-70px break-words">Content Locked</h1>
            <p class="text-20px">This content is password protected</p>

            <div class="protected-form hidden">
                <?php echo get_the_password_form(); ?>
            </div>
            <a href="#contact" data-form="Request Showcase Access" class="mt-15px btn bg-white text-black font-gilroy-semi-bold !px-26px !py-22px leading-[0.84px] uppercase border-none inline-block tracking-[0.84px]">Request Access</a>
            <button
                onclick="window.history.back()"
                class="hidden bg-black rounded-30px text-white py-5 px-6 text-14px uppercase">close</button>
        </div>
    </div>
</div>