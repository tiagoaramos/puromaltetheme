<?php
/**
 * The template part for displaying home widget area
 *
 * @package sellfie
 */
?>


	<?php if ( is_active_sidebar('home-widget-area-one') ) : ?>  
        
        <?php if ( get_theme_mod( 'sellfie_widget_bg_one' ) ) : ?> 
        	
            <section id="home-page-section" class="section-two" data-parallax="scroll" data-image-src="<?php echo esc_url( get_theme_mod( 'sellfie_widget_bg_one' )); ?>">
        
        <?php else : ?>
        
    		<section id="home-page-section" class="section-two-no-image">  
             
        <?php endif; ?>
        
        		<div class="grid grid-pad">
            		<div class="col-1-1">
                	
					<?php dynamic_sidebar('home-widget-area-one'); ?>
                	
                	</div>
            	</div>
       		</section><!-- .home-widget -->
                
	<?php endif; ?>
        