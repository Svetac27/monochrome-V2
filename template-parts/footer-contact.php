<?php
$data = get_option('contact_us');

$title =  $data['Title'] ?? false;
$text = $data['Text'] ?? false;
$buttonText = isset($data['Button Text']) && $data['Button Text'] !== '' ? $data['Button Text'] : 'Contact Us';
$buttonLink = isset($data['Button Link']) && $data['Button Link'] !== '' ? $data['Button Link'] : '#contact';
$formToOpen = isset($data['Form To Open']) && $data['Form To Open'] !== '' ? $data['Form To Open'] : 'General Enquiry';
$formMessage = isset($data['Form Message']) && $data['Form Message'] !== '' ? $data['Form Message'] : '';

// override
if (is_singular()) {
    global $post;

    $temp = get_field('footer_title', $post->ID);
    if ($temp && $temp !== '') {
        $title = $temp;
    }
    
    $temp = get_field('footer_text', $post->ID);
    if ($temp && $temp !== '') {
        $text = $temp;
    }

    $temp = get_field('footer_button_text', $post->ID);
    if ($temp && $temp !== '') {
        $buttonText = $temp;
    }

    $contactLink = get_field('footer_button_link', $post->ID);
    $contactForm = get_field('footer_form_to_open', $post->ID);
    if ($contactForm && $contactForm !== 'Open Link') {
        $formToOpen = $contactForm;
        $buttonLink = '#contact';
    } else if ($contactLink && $contactLink !== '' && $contactForm === 'Open Link') {
        $buttonLink = $temp;
    }

    $temp = get_field('form_message', $post->ID);
    if ($temp && $temp !== '') {
        $formMessage = $temp;
    }
}
?>
<div class="box w-full page-wrapper flex flex-wrap items-center md:py-[115px] md:px-[80px] rounded-20px">
    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-[120px] w-full items-center">
        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
            <h1 class="wp-block-heading text-22px md:text-40px"><?php echo $title ?? ''; ?></h1>
        </div>

        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
            <p class="text-14px md:text-4 md:mt-0"><?php echo $text ?? ''; ?></p>

            <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
                <div class="wp-block-button">
                    <?php if ($formToOpen == 'Open Link'): ?>
                        <a class="cursor-pointer block btn tracking-[0.84px] relative" href="<?php echo $buttonLink; ?>">
                            <?php echo $buttonText ?? 'Contact Us'; ?>
                        </a>
                    <?php else : ?>
                        <a class="cursor-pointer block btn tracking-[0.84px] relative" href="#contact" data-form="<?php echo $formToOpen; ?>" data-form-message="<?php echo $formMessage; ?>">
                            <?php echo $buttonText ?? 'Contact Us'; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
