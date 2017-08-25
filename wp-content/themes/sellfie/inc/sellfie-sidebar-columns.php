<?php 

	
/*-----------------------------------------------------------------------------------------------------//
	Home Widget Two
-------------------------------------------------------------------------------------------------------*/

function sellfie_home_widget_two_style() {
	
	$widget_column_two = esc_html( get_theme_mod( 'sellfie_widget_column_two', 'option1' ));
    			
	if( $widget_column_two != '' ) {
    
		switch ( $widget_column_two ) { 
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '#home-page-section .widget, #home-page-section section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '#home-page-section .widget, #home-page-section section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break; 
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '#home-page-section .widget, #home-page-section section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '#home-page-section .widget, #home-page-section section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '#home-page-section .widget, #home-page-section section { width: 25%; float:left; padding-right: 30px; }'; 
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '#home-page-section .widget, #home-page-section section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>';
                break;
				
        }
    }
	
}

add_action( 'wp_enqueue_scripts', 'sellfie_home_widget_two_style' );
