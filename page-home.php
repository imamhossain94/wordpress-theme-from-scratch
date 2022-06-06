<?php get_header(); ?>


<div class="row">
		
		<?php 
			
			$args_cat = array(
				'include' => '13, 14, 15'
			);
			
			$categories = get_categories($args_cat);
			foreach($categories as $category):
				

				$args = array( 
					'type' => 'post',
					'posts_per_page' => 1,
					'category__in' => $category->term_id,
					'category__not_in' => array( 10 ),
				);
				
				$lastBlog = new WP_Query( $args );
				
				if( $lastBlog->have_posts() ):
					
					while( $lastBlog->have_posts() ): $lastBlog->the_post(); ?>
						
						<div class="col-xs-12 col-sm-4">
                            <div class="thumbnail"><?php echo "<h2> " . $category->term_id . " </h2>"; ?></div>
							<?php get_template_part('content','featured'); ?>
						
						</div>
					
					<?php endwhile;
					
				endif;
				
				wp_reset_postdata();
				
			endforeach;
		
		?>
		
</div>

<div class="row">


<div class="row">

    <div class="col-xs-12">
        <h1>Most Recent Posts</h1>
        <?php
            $lastBlogPost = new WP_Query(array(
                'posts_per_page' => 1,
                'post_type' => 'post',
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if( $lastBlogPost->have_posts() ) :
                while( $lastBlogPost->have_posts() ) : $lastBlogPost->the_post(); ?>
                    <?php get_template_part('content', $lastBlogPost->get_post_format()); ?>
                <?php endwhile;
            endif;
        ?>
        wp_reset_postdata();
    </div>

    <div class="col-xs-12 col-sm-8">

        <h1>Main Content</h1>

        <?php 
        if( have_posts() ) :
            while( have_posts() ) : the_post(); ?>
                <?php get_template_part('content', get_post_format()); ?>
            <?php endwhile;
        endif;
        ?>
    
    </div>

    
    <div class="col-xs-12">
        <h1>Last Two Posts</h1>
        <?php
        // last two posts
            $lastBlogPost = new WP_Query(array(
                'posts_per_page' => 2,
                'offset' => 1,
                'type' => 'post',
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if( $lastBlogPost->have_posts() ) :
                while( $lastBlogPost->have_posts() ) : $lastBlogPost->the_post(); ?>
                    <?php get_template_part('content', $lastBlogPost->get_post_format()); ?>
                <?php endwhile;
            endif;
        ?>
        wp_reset_postdata();
    </div>



    <div class="col-xs-12">
        <h1>All Reviews</h1>
        <?php
            // post with category reviews
            $lastBlogPost = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'post',
                'category_name' => 'reviews',
                'orderby' => 'date',
                'order' => 'DESC'
            ));


            if( $lastBlogPost->have_posts() ) :
                while( $lastBlogPost->have_posts() ) : $lastBlogPost->the_post(); ?>
                    <?php get_template_part('content', $lastBlogPost->get_post_format()); ?>
                <?php endwhile;
            endif;
        ?>
        wp_reset_postdata();
    </div>


    <div class="col-xs-12 col-sm-4">
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>