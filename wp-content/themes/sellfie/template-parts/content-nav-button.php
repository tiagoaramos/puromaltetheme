				
                <div class="sellfie-mobile-only">
               		<div class="navigation-container push-right">
                    	<nav id="site-navigation" class="main-navigation" role="navigation">
                        <button class="toggle-menu menu-right push-body" aria-controls="primary-menu" aria-expanded="false">
                        
							 <?php $sellfie_menu_toggle_option = sellfie_sanitize_menu_toggle_display( get_theme_mod( 'sellfie_menu_toggle', 'icon' )); 
    
                        		$sellfie_menu_display = '';
    
                        			if ( $sellfie_menu_toggle_option == 'icon' ) {
                    
                            	$sellfie_menu_display = sprintf( '<i class="fa fa-bars"></i>' );
                
                        			} else if ( $sellfie_menu_toggle_option == 'label' ) {
                    
                           	 	$sellfie_menu_display = esc_html__( 'Menu', 'sellfie' ); 
                
                        			} 
    
                        		echo wp_kses_post( $sellfie_menu_display ); ?>  
                                
                        </button> 
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?> 
                       </nav><!-- #site-navigation -->
                	</div>
                </div> 
                
          	