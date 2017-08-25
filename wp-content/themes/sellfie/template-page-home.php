<?php
/**
Template Name: Home Page
 *
 * @package sellfie
 */

get_header(); ?>

<section id="hero-section" class="hero-image">

	<?php if ( get_theme_mod( 'sellfie_home_bg_image' ) ) : ?>
    	
        <?php if ( get_theme_mod( 'sellfie_bg_url' ) ) : ?>
        	<a href="<?php echo esc_url( get_page_link( get_theme_mod('sellfie_bg_url'))) ?>">
        <?php endif; ?>
        
			<img src="<?php echo esc_url( get_theme_mod( 'sellfie_home_bg_image' )); ?>">
            
        <?php if ( get_theme_mod( 'sellfie_bg_url' ) ) : ?>
        	</a>
        <?php endif; ?>
        
    <?php endif; ?>
	
</section>


<?php if ( get_theme_mod( 'active_home_products' ) == '' ) : ?>

	<section id="home-page-section" class="section-one">
		<div class="grid grid-pad slider-grid">
    
    
    		<div class="col-1-1">
         			
            	<h2 class="product-slider-header">
					<?php echo wp_kses_post( get_theme_mod( 'sellfie_products_title' )); ?>
                </h2> 
    				
           	</div>
         
         	<?php if (class_exists('Woocommerce')) : ?> 
            
    		<div class="col-1-1">
        		<ul class="product-slider woocommerce">
                  	
					<?php
					
							$sellfie_products_length = ( get_theme_mod( 'sellfie_products_length', '12' ));
							
							$args = array( 
								'post_type' => 'product', 
								'posts_per_page' => intval( $sellfie_products_length )
							);
                			$loop = new WP_Query( $args );
                	
							if ( $loop->have_posts() ) {
               		
								while ( $loop->have_posts() ) : $loop->the_post();
                				woocommerce_get_template_part( 'content', 'product' );
                				endwhile;
                			
							} else {
                				echo __( 'No products found' );
                			}
                	
							wp_reset_postdata();
                	?> 
            	
                </ul>
        	</div>
            
            <?php endif; ?>
        
    	</div>
	</section>

<?php endif; ?>


<?php if ( get_theme_mod( 'active_hw_1' ) == '' ) : ?>
        
    <?php get_template_part( 'template-parts/content', 'home-widget-1' ); // home widget 1 ?>  	
        
<?php endif; ?>



<?php
get_footer();
