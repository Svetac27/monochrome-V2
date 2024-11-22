<?php 
$postType = 'monochrome-process';
$limit = -1;

$queryArgs = array(  
    'post_type' => $postType,
    'posts_per_page' => $limit,
    'post_status' => 'publish',
    'orderby' => 'date',
    'ignore_sticky_posts' => true,
    'order'   => 'ASC'
);
$results = group_array_by(add_dummy_items(get_posts_as_array( $queryArgs ), 4, 'dummy', 2), 3);
?>


<section class="module-how-we-work">
    <div class="w-full page-wrapper grid grid-cols-1 gap-30px">
        <?php 
        // Check if there are posts
        if ( count($results)) {
            $totalRows = count($results);
            // Loop through the rows
            foreach ($results as $currentRow => $row) { ?>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-30px">
                    <?php 
                        if (($currentRow + 1) % 4 == 2) {
                            // display items in reverse
                            $index = 0;
                            for ($i = count($row) - 1; $i >= 0; $i--) {
                                $item = $row[$i]; ?>
                                <?php if (is_array($item)) { ?>
                                    <?php get_template_part('template-parts/component', 'process', [
                                        'data' => $item,
                                        'currentRow' => $currentRow + 1,
                                        'index' => $index + 1,
                                        'totalRows' => $totalRows,
                                        'totalRowItems' => count($row)

                                    ]); ?>
                                <?php } else { ?>   
                                    <div class="filler hidden lg:block"></div>
                                <?php }

                                $index++;
                            }
                        } else {
                            foreach ($row as $index => $item) { ?>
                                <?php if (is_array($item)) { ?>
                                    <?php get_template_part('template-parts/component', 'process', [
                                        'data' => $item,
                                        'currentRow' => $currentRow + 1,
                                        'index' => $index + 1,
                                        'totalRows' => $totalRows,
                                        'totalRowItems' => count($row)

                                    ]); ?>
                                <?php } else { ?>   
                                    <div class="filler hidden lg:block"></div>
                                <?php } ?>
                            <?php }
                        }
                    ?>
                </div>
            <?php }
        }
        ?>    
    </div>
</section>
