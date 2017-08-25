<?php
/**
 * sellfie Theme Customizer
 *
 * @package sellfie
 */


/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function sellfie_add_customizer_css() { 
	
?>
	
<!-- sellfie customizer CSS -->  

	<style> 
		
		
		<?php if ( get_theme_mod( 'sellfie_header_bg' ) ) : ?>
		.site-header { background-color: <?php echo esc_attr( get_theme_mod( 'sellfie_header_bg', '#ffffff' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_header_border' ) ) : ?>
		.site-header { border-color: <?php echo esc_attr( get_theme_mod( 'sellfie_header_border', '#e1e1e1' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_header_cart' ) ) : ?>
		.cart-container a .fa { color: <?php echo esc_attr( get_theme_mod( 'sellfie_header_cart', '#fd3253' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_cart_number' ) ) : ?>
		.site-header .cart-container .cart-number { background-color: <?php echo esc_attr( get_theme_mod( 'sellfie_cart_number', '#111111' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_cart_number_text' ) ) : ?>
		.site-header .cart-container .cart-number { color: <?php echo esc_attr( get_theme_mod( 'sellfie_cart_number_text', '#ffffff' )) ?>; }
		<?php endif; ?>
		
		
		<?php if ( get_theme_mod( 'sellfie_mobile_button_text_color' ) ) : ?>
		.navigation-container button.menu-toggle, .navigation-container button  { color: <?php echo esc_attr( get_theme_mod( 'sellfie_mobile_button_text_color', '#111111' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_mobile_button_hover_color' ) ) : ?>
		.navigation-container button.menu-toggle:hover, .navigation-container button:hover  { 
			color: <?php echo esc_attr( get_theme_mod( 'sellfie_mobile_button_hover_color', '#888888' )) ?>;
			background:none !important; 
		}
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_mobile_menu_bg' ) ) : ?>
		.cbp-spmenu { background-color: <?php echo esc_attr( get_theme_mod( 'sellfie_mobile_menu_bg', '#15171f' )) ?>; }  
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_mobile_menu_link' ) ) : ?>
		.cbp-spmenu a { color: <?php echo esc_attr( get_theme_mod( 'sellfie_mobile_menu_link', '#ffffff' )) ?>; }  
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_mobile_menu_hover' ) ) : ?>
		.cbp-spmenu a:hover { color: <?php echo esc_attr( get_theme_mod( 'sellfie_mobile_menu_hover', '#fd3253' )) ?>; }  
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_site_title_color' ) ) : ?>
		.site-title a { color: <?php echo esc_attr( get_theme_mod( 'sellfie_site_title_color', '#000000' )) ?>; }   
		<?php endif; ?> 
		
		
		
		<?php if ( get_theme_mod( 'sellfie_text_color' ) ) : ?> 
		body, textarea, p { color: <?php echo esc_attr( get_theme_mod( 'sellfie_text_color', '#404040' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_heading_color' ) ) : ?> 
		h1, h2, h3, h4, h5, h6, .comment-form-comment { color: <?php echo esc_attr( get_theme_mod( 'sellfie_heading_color', '#000000' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_link_color' ) ) : ?> 
		a { color: <?php echo esc_attr( get_theme_mod( 'sellfie_link_color', '#3d3d41' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_hover_color' ) ) : ?>
		a:hover { color: <?php echo esc_attr( get_theme_mod( 'sellfie_hover_color', '#3d3d41' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_entry' ) ) : ?>
		.entry-title { color: <?php echo esc_attr( get_theme_mod( 'sellfie_entry', '#000000' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_body_size' ) ) : ?>
		body, p { font-size: <?php echo esc_attr( get_theme_mod( 'sellfie_body_size', '16' )) ?>px; } 
		<?php endif; ?>
		
		
		
		<?php if ( get_theme_mod( 'sellfie_products_bg' ) ) : ?>
		.section-one { background-color: <?php echo esc_attr( get_theme_mod( 'sellfie_products_bg', '#ffffff' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_products_border' ) ) : ?>
		#home-page-section { border-color: <?php echo esc_attr( get_theme_mod( 'sellfie_products_border', '#e1e1e1' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_products_text' ) ) : ?>
		.product-slider h3 { color: <?php echo esc_attr( get_theme_mod( 'sellfie_products_text', '#000000' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_products_title_color' ) ) : ?>
		.product-slider-header { color: <?php echo esc_attr( get_theme_mod( 'sellfie_products_title_color', '#000000' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_products_amount' ) ) : ?>
		.price a, .product-slider span.price { color: <?php echo esc_attr( get_theme_mod( 'sellfie_products_amount', '#fd3253' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_products_amount' ) ) : ?>
		.woocommerce span.onsale { background-color: <?php echo esc_attr( get_theme_mod( 'sellfie_products_amount', '#fd3253' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_products_arrow' ) ) : ?>
		.slick-prev::before, .slick-next::before { color: <?php echo esc_attr( get_theme_mod( 'sellfie_products_arrow', '#000000' )) ?>; } 
		<?php endif; ?>
		 
		
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_bg_color' ) ) : ?> 
		.section-two-no-image { background-color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_bg_color', '#f1f1f1' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_heading_color' ) ) : ?>
		.home-call-to-action h2, .section-two h1, .section-two h2, .section-two h3, .section-two h4, .section-two h5, .section-two h6 { color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_heading_color', '#ffffff' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_text_color' ) ) : ?> 
		.home-call-to-action, .section-two, .section-two p { color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_text_color', '#ffffff' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_link_color' ) ) : ?>
		.section-two a { color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_link_color', '#fd3253' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_link_hover_color' ) ) : ?>
		.section-two a:hover { color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_link_hover_color', '#fd3253' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_button_color' ) ) : ?> 
		.section-two button, .section-two a.button, .home-call-to-action a.button { border-color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_button_color', '#fd3253' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_button_color' ) ) : ?> 
		.section-two button, .section-two a.button, .home-call-to-action a.button { background-color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_button_color', '#fd3253' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_button_text_color' ) ) : ?> 
		.section-two button, .section-two a.button, .home-call-to-action a.button { color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_button_text_color', '#ffffff' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_button_hover_color' ) ) : ?>
		.section-two button:hover, .section-two a.button:hover, .home-call-to-action a.button:hover { background: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_button_hover_color', '#fd3253' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_button_hover_color' ) ) : ?>
		.section-two button:hover, .section-two a.button:hover, .home-call-to-action a.button:hover { border-color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_button_hover_color', '#fd3253' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_hw_area_1_button_hover_text_color' ) ) : ?>
		.section-two button:hover, .section-two a.button:hover, .home-call-to-action a.button:hover { color: <?php echo esc_attr( get_theme_mod( 'sellfie_hw_area_1_button_hover_text_color', '#ffffff' )) ?>; } 
		<?php endif; ?> 
		
		
		
		<?php if ( get_theme_mod( 'sellfie_footer_color' ) ) : ?> 
		.site-footer { background: <?php echo esc_attr( get_theme_mod( 'sellfie_footer_color', '#f1f1f1' )) ?>; }  
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sellfie_footer_text_color' ) ) : ?>
		.site-footer, .site-info, .site-footer p, .site-info p { color: <?php echo esc_attr( get_theme_mod( 'sellfie_footer_text_color', '#888888' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_footer_link_color' ) ) : ?>
		.site-info a, .site-footer a { color: <?php echo esc_attr( get_theme_mod( 'sellfie_footer_link_color', '#111111' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_footer_link_hover_color' ) ) : ?>
		.site-info a:hover, .site-footer a:hover { color: <?php echo esc_attr( get_theme_mod( 'sellfie_footer_link_hover_color', '#111111' )) ?>; } 
		<?php endif; ?> 
		
		
		
		<?php if ( get_theme_mod( 'sellfie_social_color' ) ) : ?>
		.social-media-icons li .fa, #menu-social li a::before { color: <?php echo esc_attr( get_theme_mod( 'sellfie_social_color', '#111111' )) ?>;  } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_social_color_hover' ) ) : ?>
		.social-media-icons li .fa:hover, #menu-social li a:hover::before, #menu-social li a:focus::before { color: <?php echo esc_attr( get_theme_mod( 'sellfie_social_color_hover', '#111111' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_social_text_size' ) ) : ?> 
		.social-media-icons li .fa, #menu-social li a::before { font-size: <?php echo esc_attr( get_theme_mod( 'sellfie_social_text_size', '24' )) ?>px; }
		<?php endif; ?> 
		
		
		
		<?php if ( get_theme_mod( 'sellfie_custom_color' ) ) : ?> 
		button, input[type="button"], input[type="reset"], input[type="submit"] { border-color: <?php echo esc_attr( get_theme_mod( 'sellfie_custom_color', '#fd3253' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_custom_color' ) ) : ?> 
		button, input[type="button"], input[type="reset"], input[type="submit"] { background-color: <?php echo esc_attr( get_theme_mod( 'sellfie_custom_color', '#fd3253' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_button_text_color' ) ) : ?> 
		button, input[type="button"], input[type="reset"], input[type="submit"] { color: <?php echo esc_attr( get_theme_mod( 'sellfie_button_text_color', '#ffffff' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_custom_color_hover' ) ) : ?>
		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { background: <?php echo esc_attr( get_theme_mod( 'sellfie_custom_color_hover', '#fd3253' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_custom_color_hover' ) ) : ?>
		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { border-color: <?php echo esc_attr( get_theme_mod( 'sellfie_custom_color_hover', '#fd3253' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_button_text_hover_color' ) ) : ?>
		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { color: <?php echo esc_attr( get_theme_mod( 'sellfie_button_text_hover_color', '#ffffff' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sellfie_page_border_color' ) ) : ?>
		.page-seperator::before { border-color: <?php echo esc_attr( get_theme_mod( 'sellfie_page_border_color', '#e1e1e1' )) ?>; } 
		<?php endif; ?>
		
		  
	</style>
    
<?php }


add_action( 'wp_head', 'sellfie_add_customizer_css' );

