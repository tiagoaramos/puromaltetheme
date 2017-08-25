<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sellfie
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    
    	<?php if( get_theme_mod( 'active_social' ) == '') : ?>
        
    		<div class="grid grid-pad">
        		<div class="col-1-1">
            		<?php get_template_part( 'menu', 'social' ); ?> 
            	</div>
        	</div>
            
        <?php endif; ?> 
        
    	<div class="grid grid-pad">
        	<div class="col-1-1">
            
            	<?php if( get_theme_mod( 'active_byline' ) == '') : ?>
                
               		<div class="site-info">
                
						
						<?php if ( get_theme_mod( 'sellfie_footerid' ) ) : ?> 
                
        						<?php echo wp_kses_post( get_theme_mod( 'sellfie_footerid' )); // footer id ?>
                    
						<?php else : ?>
                            
                            	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'sellfie' ) ); ?>"> 
									<?php printf( esc_html__( 'Proudly powered by %s', 'sellfie' ), 'WordPress' ); ?>
                        		</a>
            
            					<span class="sep"> | </span>
                
    							<?php printf( esc_html__( 'Theme: %1$s by %2$s', 'sellfie' ), 'sellfie', '<a href="//modernthemes.net">modernthemes.net</a>' ); ?>
                    
						<?php endif; ?>
                    
                	
                	</div><!-- .site-info -->
                
            	<?php endif; ?>
                
            </div>
       	</div>
        
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
