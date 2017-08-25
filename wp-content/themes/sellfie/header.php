<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sellfie
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"> 
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'sellfie' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
    	<div class="grid grid-pad">
        	<div class="col-1-1">
            
            	<div class="navigation-container">
                	 
                	<button class="toggle-menu menu-left push-body" aria-controls="primary-menu" aria-expanded="false">
                    	<?php $sellfie_menu_toggle_option = sellfie_sanitize_menu_toggle_display( get_theme_mod( 'sellfie_menu_toggle', 'both' )); 
    
                        		$sellfie_menu_display = '';
    
                        			if ( $sellfie_menu_toggle_option == 'icon' ) {
                    
                            	$sellfie_menu_display = sprintf( '<i class="fa fa-bars"></i>' );
                
                        			} else if ( $sellfie_menu_toggle_option == 'label' ) {
                    
                           	 	$sellfie_menu_display = esc_html__( 'Menu', 'sellfie' ); 
                
                        			} else if ( $sellfie_menu_toggle_option == 'both' ) {
                    
                           	 	$sellfie_menu_display = __( '<i class="fa fa-bars"></i> Menu', 'sellfie' ); 
                
                        			}  
									
    
                        		echo wp_kses_post( $sellfie_menu_display ); ?>
                    </button>
                    
                </div>
                
                <?php if ( class_exists('Woocommerce') ) :
					  
					global $woocommerce; ?>
                        
                        <div class="cart-container">
                            
                    		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
                     
                     				<i class="fa fa-shopping-basket"></i>
									<span class="cart-number">
										<?php echo $woocommerce->cart->get_cart_contents_count(); ?>
                                    </span>
								
                            </a>
                      
               			</div>
                        
               	<?php else: ?> 
                
                		<div class="cart-container"></div>
                            
				<?php endif; ?>
                
                <div class="site-branding">
                
                	<?php get_template_part( 'template-parts/content', 'logo' ); ?> 
                
                </div><!-- .site-branding -->
                
          	</div>
       	</div> 
	</header><!-- #masthead -->
    
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left">
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    </nav>

	<div id="content" class="site-content">
