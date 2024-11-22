<?php 
$loop = new WP_Query( $args ); 
$total = $loop->post_count;
?>
<div class="grid items-center">
    <div class="carousel-slider relatice h-full w-full">
        <div class="slideshow-container h-full w-full" data-current-slide="1" data-items-count="<?php echo $total; ?>">
            <?php
                    
                $i = 1;
                while ( $loop->have_posts() ) : $loop->the_post(); 
                    ?>
                    <div class="mySlides fade h-full w-full relative"
                        style="
                            <?php echo $i > 1 ? 'display:none;' : ''; ?>
                        "
                        data-slide="<?php echo $i; ?>"
                    >
                        <div class="w-full">
                            <div class="w-full">
                                <div class="italic"><?php echo get_the_content(); ?></div>
                                <div><?php the_title(); ?></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                endwhile;

                wp_reset_postdata(); 
            ?>
        </div>
        <br>

        <div class="slide-timer items-center text-white flex gap-4">
            <?php for ($i = 0; $i < $total; $i++): ?>
                <div class="timer green"></div> 
            <?php endfor; ?>
            
            <a class="prev text-black">❮</a>
            <a class="next text-black">❯</a>
        </div>
    </div>
</div>