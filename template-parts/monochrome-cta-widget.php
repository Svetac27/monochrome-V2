<?php
$data = get_option('contact_us');

$title = false;
$text = false; // check where to add default value field
$buttonText = $data['Button Text'];
$buttonLink = '#contact';
$formToOpen = $data['Form To Open'] ?? 'General Enquiry';
$formMessage = $data['Form Message'] ?? '';

// overide from attributes
if (isset($args['title']) && !empty($args['title'])) {
    $title = $args['title'];
}
if (isset($args['text']) && !empty($args['text'])) {
    $text = $args['text'];
}
if (isset($args['button-text']) && !empty($args['button-text'])) {
    $buttonText = $args['button-text'];
}
if (isset($args['button-link']) && !empty($args['button-link'])) {
    $buttonLink = $args['button-link'];
}
if (isset($args['form']) && !empty($args['form'])) {
    $formToOpen = $args['form'];
}
if (isset($args['message']) && !empty($args['message'])) {
    $formMessage = $args['message'];
}
?>

<div class="page-wrapper cta-widget">
<div class=" box-nopadding flex flex-wrap py-40px px-32px lg:py-50px justify-center items-center gap-x-[40px] gap-y-[20px] mt-[50px] md:mb-[-150px]">
    <?php if ($title || $text): ?>
        <div>
            <?php if ($title): ?>
                <strong><?php echo $title; ?></strong>
            <?php endif; ?> 
            <?php if ($text): ?>
                <div class="text">
                    <?php echo $text; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <a
        class="relative cursor-pointer block inline-block btn tracking-[0.84px] default-padding"
        href="<?php echo $buttonLink; ?>"
        data-form="<?php echo $formToOpen; ?>"
        data-form-message="<?php echo $formMessage; ?>"
    >
        <?php echo $buttonText; ?>
    </a>

</div>
</div>