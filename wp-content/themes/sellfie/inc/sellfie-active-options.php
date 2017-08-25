<?php	

/**
 * check to see if Home News is active
 */
function sellfie_news_support() {
	
    if( is_active_widget( '', '', 'sellfie_home_news') ) {  
		
        add_theme_support('mt_news');
  
	}
	
}
add_action('after_setup_theme', 'sellfie_news_support'); 
