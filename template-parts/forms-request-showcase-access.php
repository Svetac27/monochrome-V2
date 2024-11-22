<div class="dark-bg">
    <?php if (isset($args['text']) && $args['text'] !== false && !empty($args['text'])) { ?>
        <div class="pb-30px lg:pb-36px text-leftcenter text-4"><?php echo $args['text']; ?></div>
    <?php } ?>

    <form data-form-name="request-showcase-access" class="grid grid-cols-1 gap-x-[26px] gap-y-[20px]">
        <div class="input-wrapper">
            <label class="w-full">Name</label>
            <input class="w-full" placeholder="Your full name" required type="text" name="name">
        </div>
        <div class="input-wrapper">
            <label class="w-full">Email</label>
            <input class="w-full" type="text" name="email" required placeholder="Your email address">
        </div>
        <div class="input-wrapper">
            <label class="w-full">Company</label>
            <input class="w-full" type="text" name="company" required placeholder="Company">
        </div>
        <div class="input-wrapper col-span-1">
            <button type="submit" class="btn bg-white text-black font-gilroy-semi-bold !px-26px !py-22px tracking-[0.84px] uppercase">Send Request</button>
        </div>
    </form>
</div>