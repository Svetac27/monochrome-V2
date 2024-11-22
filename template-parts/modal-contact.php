

<div class="!fixed box dark blurred-50 h-screen w-full top-0 left-0 contact-modal !p-0 z-[-1] !rounded-[0]">
    <div class="relative w-full h-full flex items-center lg:py-[40px]">

        <div class="message-overlay h-full w-full absolute top-0 left-0 z-20"
        ></div>

        <span class="text-gray cursor-pointer close-modal absolute top-[50px] text-4 right-[50px] p-10px z-100 --js-close-contact-modal hidden lg:block">
            <div class="text-white p-0">
                <?php get_template_part('template-parts/icons', null, ['icon' => 'close']); ?>
            </div>
        </span>

        <div class="content w-full px-page max  -h-full w-full overflow-auto lg:top-1/2 lg:left-1/2">
            <div class="page-wrapper w-full mx-auto text-white lg:flex items-center py-[70px] lg:py-0 lg:gap-[230px] relative">
                
                <span class="text-gray cursor-pointer close-modal absolute top-[20px] text-4 p-10px z-100 --js-close-contact-modal lg:hidden right-0">
                    <div class="text-white p-0">
                        <?php get_template_part('template-parts/icons', null, ['icon' => 'mob-menu-close']); ?>
                    </div>
                </span>
                <div class="w-full lg:w-1/3 text-left z-30">
                    <?php
                        $option_value = get_option('contact_form_settings', []);
                        $title = $option_value['title'] ?? 'Contact Us';
                        $description = $option_value['description'] ?? false;
                    ?>
                    <h2 class="text-32px lg:text-70px lg:leading-[96px] pb-20px lg:pb-0"><?php echo $title; ?></h2>
                    <?php if ($description) { ?>
                        <div class="text-14px lg:text-22px leading-[20px] lg:leading-[36px] lg:pb-0 pb-20px lg:pt-30px"><?php echo $description; ?></div>
                    <?php } ?>
                </div>
                            
                <div class="success-message h-full w-full top-0 left-0 absolute z-30">
                    <div class="relative w-full h-full lg:left-1/3 lg:w-2/3 text-center">
                        <div class="text-22px leading-[36px] font-gilroy flex items-center justify-center h-full text-green-success gap-20px">
                            <?php get_template_part('template-parts/icons', null, ['icon' => 'check', 'class' => 'h-[60px] w-[60px]']); ?>
                            <div class="text-white text-22px leading-[36px] font-gilroy">Thanks for getting in touch, we'll be in contact soon!</div>
                        </div>
                    </div>
                </div>
                <div class="hidden error-message">Something went wrong, please try again later!</div>

                <div class="w-full lg:w-2/3 grid grid-cols-1 items-center contact-forms relative z-10"
                >
                    <style>
                        @media screen and (min-width: 1024px) {
                            .contact-forms {
                                grid-template-columns: 1fr 2fr;
                            }
                        }
                        </style>
                    <div class="tabs overflow-x-auto hide-scrollba hidden lg:block !h-auto" style="min-height:500px;">
                        <div data-index="1" class="form-item text-18px px-7 lg:px-0 p-7 cursor-pointer font-gilroy-semi-bold lg:pr-32px active" data-form="General Enquiry">General Enquiry</div>
                        <div data-index="2" class="form-item text-18px px-7 lg:px-0 p-7 cursor-pointer font-gilroy-semi-bold lg:pr-32px" data-form="Request Showcase Access">Request Showcase Access</div>
                        <div data-index="3" class="form-item text-18px px-7 lg:px-0 p-7 cursor-pointer font-gilroy-semi-bold lg:pr-32px" data-form="Download Presentation Pack">Download Presentation Pack</div>
                        <div data-index="4" class="form-item text-18px px-7 lg:px-0 p-7 cursor-pointer font-gilroy-semi-bold lg:pr-32px" data-form="Book A Meeting">Book A Meeting</div>
                    </div>

                    <div class="form-dropdown lg:hidden mb-30px">
                        <select class="forms font-gilroy-semi-bold w-full rounded-[30px] relative bg-white bg-opacity-15 text-white overflow-hidden py-16px px-20px text-14px leading-[18px] bg-no-repeat bg-right"
                            style="
                                background-image: url(<?php echo get_template_directory_uri() . '/assets/icons/chevron-down-white.svg'; ?>)
                            "
                        >
                            <option class="w-full rounded-none bg-black text-white overflow-hidden py-16px px-20px text-14px leading-[28px]" value="1" selected>General Enquiry</option>
                            <option class="w-full rounded-none bg-black text-white overflow-hidden py-16px px-20px text-14px leading-[28px]" value="2">Request Showcase Access</option>
                            <option class="w-full rounded-none bg-black text-white overflow-hidden py-16px px-20px text-14px leading-[28px]" value="3">Download Presentation Pack</option>
                            <option class="w-full rounded-none bg-black text-white overflow-hidden py-16px px-20px text-14px leading-[28px]" value="4">Book A Meeting</option>
                        </select>
                    </div>
                    <div class="form-items-wrapper lg:pl-50px">
                        <div class="w-full form-items lg:pt-0">
                            <?php
                                // made it array to make it easier to add/remove
                                $forms = [
                                    'general-enquiry',
                                    'request-showcase-access',
                                    'download-presentation-pack',
                                    'book-a-meeting'
                                ];
                            ?>

                            <div class="forms">
                                <?php foreach($forms as $index => $form) { ?>
                                    <div class="<?php echo $index == 0 ? '' : 'hidden'; ?> form-item-<?php echo $form; ?>" data-index="<?php echo $index + 1; ?>">
                                        <?php get_template_part('template-parts/forms', $form, ['text' => isset($option_value[$form]) && !empty($option_value[$form]) ? $option_value[$form] : false]) ?>
                                    </div>
                                <?php } ?>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>