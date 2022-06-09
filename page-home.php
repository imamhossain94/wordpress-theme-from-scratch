<?php get_header(); ?>
    <div class="row">
        <div class="col-xs-12">
            <!--Adding carousel-->
            <div id="awesome-theme" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <?php
                    $args_cat = array(
                        'include' => '6, 7, 8'
                    );
                    $categories = get_categories($args_cat);
                    $count = 0;
                    $bullets = '';
                    foreach ($categories as $category):
                        $args = array(
                            'type' => 'post',
                            'posts_per_page' => 1,
                            'category__in' => $category->term_id,
                            'category__not_in' => array(10),
                        );
                        $lastBlog = new WP_Query($args);
                        if ($lastBlog->have_posts()):
                            while ($lastBlog->have_posts()): $lastBlog->the_post(); ?>

                                <div class="item <?php if ($count == 0): echo 'active'; endif; ?>">
                                    <div class="thumbnail"><?php the_post_thumbnail('full'); ?></div>
                                    <div class="carousel-caption">
                                        <?php the_title(sprintf('<h1 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h1>'); ?>
                                        <small><?php the_category(' '); ?></small>
                                    </div>
                                </div>

                                <?php
                                $is_active = 'active';
                                if ($count != 0) {
                                    $is_active = '';
                                }
                                $bullets .= sprintf('<li data-target="#awesome-theme" data-slide-to="%d" class="%s"></li>', $count, $is_active); ?>


                            <?php endwhile;
                        endif;
                        wp_reset_postdata();
                        $count++;
                    endforeach;
                    ?>


                </div>

                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php echo $bullets; ?>
                </ol>

                <!-- Controls -->
                <a class="left carousel-control" href="#awesome-theme" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#awesome-theme" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <?php
            if (have_posts()):
                while (have_posts()): the_post(); ?>
                    <?php get_template_part('content', get_post_format()); ?>
                <?php endwhile;

            endif;
            ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>


