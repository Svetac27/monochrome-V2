<?php 
$loop = new WP_Query( $args ); 
$total = $loop->post_count;
?>

<div class="min-h-screen w-full relative">
    <div class="carousel-slider h-screen w-full relative">
        <div class="slideshow-container h-full w-full" data-current-slide="1" data-items-count="<?php echo $total; ?>">
            <?php
                    
                $i = 1;
                while ( $loop->have_posts() ) : $loop->the_post(); 
                    ?>
                    <?php
                        $image = wp_get_attachment_url( get_post_thumbnail_id($loop->ID), 'thumbnail' );
                        $background = get_field('background_image');
                    ?>
                    <div class="mySlides overflow-hidden fade h-full w-full relative"
                        style="
                            <?php echo $i > 1 ? 'display:none;' : 'display:block'; ?>
                        "
                        data-slide="<?php echo $i; ?>"
                    >
                        <div class="absolute bg-cover bg-no-repeat bg-center w-full h-full left-0 top-0"
                            style="<?php echo $background ? 'background-image: url('.$background.')' : ''; ?>;opacity:0.5;"
                        >
                        </div>
                        <div class="absolute blur-bg-lighter w-full h-full left-0 top-0">&nbsp;</div>
                        <div class="absolute block w-full h-full left-0 top-0 flex items-center px-page">
                            <div class="lg:flex lg:grid-cols-2 gap-10 items-center w-full h-full page-wrapper mx-auto">
                                <div class="h-50vh lg:w-1/2 lg:h-full text-center lg:text-left grid items-center">
                                    <div>
                                        <h2 class="text-8 lg:text-70px"><?php the_title(); ?></h2>
                                        <div class="text-14px lg:text-5 py-40px"><?php echo get_the_excerpt(); ?></div>
                                        <a href="<?php the_permalink(); ?>" class="font-bold uppercase text-3 lg:text-4">FIND OUT MORE <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="h-50vh lg:w-1/2 lg:h-full grid lg:flex justify-center items-end mx-auto">
                                    <img class="mx-auto h-50vh lg:h-full w-auto z-100" src="<?php echo $image; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                endwhile;

                wp_reset_postdata(); 
            ?>

        </div>

        <div class="slide-timer items-center text-white w-full px-page bottom-0 lg:bottom-40">
            <div class="w-full page-wrapper mx-auto">
                <div class="z-100 absolute lg:relative bottom-0 left-0  inline-flex w-full lg:w-auto items-center justify-center gap-2 px-4 py-2 blur-bg lg:rounded h-10">
                    <?php for ($i = 0; $i < $total; $i++): ?>
                        <div class="timer"></div> 
                    <?php endfor; ?>
                    
                    <a class="prev text-black px-1 hidden lg:block">❮</a>
                    <a class="next text-black px-1 hidden lg:block">❯</a>
                </div>
            </div>
        </div>
    </div>
</div>
