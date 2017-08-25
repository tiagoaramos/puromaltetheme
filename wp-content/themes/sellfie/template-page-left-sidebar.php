<?php
/**
Template Name: Page - Left Sidebar
 *
 * @package sellfie
 */

get_header(); ?>

<section id="page-content-container" class="page-left-sidebar page-seperator">
	<div class="grid grid-pad">
    	<div class="col-8-12 push-right">
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
        
                    <?php
                    while ( have_posts() ) : the_post();
        
                        get_template_part( 'template-parts/content', 'page' );
        
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
        
                    endwhile; // End of the loop.
                    ?>
        
                </main><!-- #main -->
            </div><!-- #primary -->
     	</div>
        
   		<?php get_sidebar(); ?>
        
  	</div>
</section>

<?php
get_footer();
