<div class="dark-bg">
    <?php if (isset($args['text']) && $args['text'] !== false && !empty($args['text'])) { ?>
        <div class="pb-30px lg:pb-36px text-4 text-left"><?php echo $args['text']; ?></div>
    <?php } ?>

    <form data-form-name="general-enquiry" class="grid grid-cols-2 gap-x-[26px] gap-y-[20px]">
        <div class="input-wrapper col-span-2 md:col-span-1">
            <label class="w-full">Name</label>
            <input class="w-full" placeholder="Your full name" required type="text" name="name">
        </div>

        <div class="input-wrapper col-span-2 md:col-span-1">
            <label class="w-full">Email</label>
            <input class="w-full" type="text" name="email" required placeholder="Your email address">
        </div>
        <div class="input-wrapper col-span-2 md:col-span-1">
            <label class="w-full">Business</label>
            <input class="w-full" type="text" name="business" required placeholder="Name of your business">
        </div>
        <div class="input-wrapper col-span-2 md:col-span-1">
            <label class="w-full">Phone</label>
            <input class="w-full" type="text" name="phone" required placeholder="Your phone number">
        </div>
        <div class="input-wrapper col-span-2">
            <label class="w-full">Message</label>
            <textarea class="w-full min-h-[100px]" name="message" required placeholder="How can we help?"></textarea>
        </div>
        <div class="input-wrapper col-span-2">
            <button type="submit" class="btn bg-white text-black font-gilroy-semi-bold !px-26px !py-22px tracking-[0.84px] uppercase">Send message</button>
        </div>
    </form>
</div>