<?php
// check where to display arrow
$totalRows = $args['totalRows'] ?? 1;
$totalRowItems = $args['totalRowItems'] ?? 1;
$currenRow = $args['currentRow'] ?? 1;
$index = $args['index'] ?? 1;

$arrow = null;

if ($currenRow % 4 == 0) {
    if ($index == 1 && $currenRow < $totalRows) {
        $arrow = 'bottom';
    } else {
        $arrow = null;
    }
} else if ($currenRow % 3 == 0) {
    if ($index == 1 && $currenRow < $totalRows) {
        $arrow = 'bottom';
    } else if ($currenRow < $totalRows) {
        $arrow = 'left';
    }
} else if ($currenRow % 2 == 0) {
    if ($index == 3 && $currenRow < $totalRows) {
        $arrow = 'bottom';
    } else {
        $arrow = null;
    }
} else {
    if ($index == 3 && $currenRow < $totalRows) {
        $arrow = 'bottom';
    } else if ($totalRowItems > $index) {
        $arrow = 'right';
    }
}

?>

<div class="relative process-item box <?php echo $arrow ? 'point-'. $arrow : ''; ?> flex items-center w-full !pt-31px !pb-33px !px-30px index-<?php echo $args['index'] ?? 'na'; ?> row-<?php echo $args['currentRow'] ?? 'na'; ?>">
    <?php
        $featured_image_url = $args['data']['thumbnail_url'] ?? null;
    ?>

    <?php if ($featured_image_url): ?>
        <img src="<?php echo $featured_image_url; ?>" class="max-h-[26px] mr-15px" />
    <?php endif; ?>
    <div class="text-14px leading-22px"><?php
    
    echo preg_replace('/<\/?p[^>]*>/', '', $args['data']['content'] ?? '');
    
    ?></div>
</div>