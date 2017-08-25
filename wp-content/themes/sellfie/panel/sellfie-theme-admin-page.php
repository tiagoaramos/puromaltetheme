<?php

     
    add_action('admin_menu', 'sellfie_setup_menu');
     
    function sellfie_setup_menu(){
    	add_theme_page( esc_html__('Sellfie Theme Details', 'sellfie' ), esc_html__('Sellfie Theme Details', 'sellfie' ), 'edit_theme_options', 'sellfie-setup', 'sellfie_init' ); 
    }  
      
 	function sellfie_init(){
		
		wp_enqueue_style( 'sellfie-font-awesome-admin', get_template_directory_uri() . '/fonts/font-awesome.css' ); 
		wp_enqueue_style( 'sellfie-style-admin', get_template_directory_uri() . '/panel/css/theme-admin-style.css' ); 
		
	 	echo '<div class="grid grid-pad"><div class="col-1-1"><h1 style="text-align: center;">'; 
		printf(esc_html__('Thank you for using Sellfie!', 'sellfie' ));
        echo "</h1></div></div>";
			
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 40px; margin-bottom: 30px;" ><div class="col-1-3"><h2>'; 
		printf(esc_html__('WooCommerce Ready', 'sellfie' )); 
        echo '</h2>';
		
		echo '<p>';
		printf(esc_html__('We created a quick videos to show you how you how to set up WooCommerce for Sellfie. Watch the video with the link below.', 'sellfie' )); 
		echo '</p>';
		
		echo '<a href="https://modernthemes.net/sellfie-documentation/sellfie-add-products-woocommerce-setup/" target="_blank"><button>'; 
		printf(esc_html__('View Video', 'sellfie' )); 
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf(esc_html__('Documentation', 'sellfie' ));
        echo '</h2>';  
		
		echo '<p>';
		printf(esc_html__('Check out our documentation for tutorials on theme functions and how to get the most out of sellfie.', 'sellfie' ));   
		echo '</p>'; 
		
		echo '<a href="https://modernthemes.net/sellfie-documentation/" target="_blank"><button>';
		printf(esc_html__('Read Docs', 'sellfie' )); 
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf(esc_html__('ModernThemes', 'sellfie' )); 
        echo '</h2>';  
		
		echo '<p>';
		printf(esc_html__('Need some more themes? We have a large selection of both free and premium themes to add to your collection.', 'sellfie' ));
		echo '</p>';
		
		echo '<a href="https://modernthemes.net/" target="_blank"><button>'; 
		printf(esc_html__('Visit Us', 'sellfie' ));
		echo '</button></a></div></div>';
		
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( esc_html__('Go Pro. Get more out of Sellfie.', 'sellfie' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>';
		printf( esc_html__('More Layouts + Sliders', 'sellfie' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Sellfie Pro adds more home page layouts with options for Home Hero Sliders that give you more ways to present products to customers.', 'sellfie' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-home"></i><h4>';
        printf( esc_html__('Home Widget Areas', 'sellfie' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Add more home page content as Sellfie Pro comes with 4 additional home page widget areas and the ability to set parallax background images for widget areas.', 'sellfie' )); 
		echo '</p></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-image"></i><h4>';
        printf( esc_html__('More Theme Options', 'sellfie' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Sellfie Pro includes more theme options like additional hover effects, additional navigation, and a seconday header. The best looking websites give the best first impressions.', 'sellfie' ));
		echo '</p></div>'; 
		
		echo '<div class="col-1-4"><i class="fa fa-th"></i><h4>'; 
        printf( esc_html__('Footer Widget Areas', 'sellfie' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Want more content for your footer? Sellfie Pro has footer widget areas to populate with any content you want.', 'sellfie' ));
		echo '</p></div>';
		
            
        echo '<div class="grid grid-pad senswp"><div class="col-1-4"><i class="fa fa-shopping-cart"></i><h4>'; 
		printf( esc_html__( 'More Font Selections', 'sellfie' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Sellfie Pro offers 65 additional Google Fonts to select from.', 'sellfie' ));
		echo '</p></div>';
		
       	echo '<div class="col-1-4"><i class="fa fa-font"></i><h4>More Google Fonts</h4><p>';
		printf( esc_html__( 'Access an additional 65 Google fonts with sellfie Pro right in the WordPress customizer.', 'sellfie' ));
		echo '</p></div>'; 
		
       	echo '<div class="col-1-4"><i class="fa fa-file-image-o"></i><h4>';
		printf( esc_html__( 'PSD Files', 'sellfie' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Premium versions include PSD files. Preview your own content or showcase a customized version for your clients.', 'sellfie' ));
		echo '</p></div>';
            
        echo '<div class="col-1-4"><i class="fa fa-support"></i><h4>';
		printf( esc_html__( 'Free Support', 'sellfie' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Call on us to help you out. Pro themes come with free support that goes directly to our support staff.', 'sellfie' ));
		echo '</p></div></div>';
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="https://modernthemes.net/wordpress-themes/sellfie-pro/" target="_blank"><button class="pro">'; 
		printf( esc_html__( 'View Pro Version', 'sellfie' )); 
		echo '</button></a></div></div>';
		
		
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( esc_html__('Premium Membership. Premium Experience.', 'sellfie' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>'; 
		printf( esc_html__('Plugin Compatibility', 'sellfie' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Use our new free plugins with this theme to add functionality for things like projects, clients, team members and more. Compatible with all premium themes!', 'sellfie' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-desktop"></i><h4>'; 
        printf( esc_html__('Agency Designed Themes', 'sellfie' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Look as good as can be with our new premium themes. Each one is agency designed with modern styles and professional layouts.', 'sellfie' ));
		echo '</p></div>'; 
		
        echo '<div class="col-1-4"><i class="fa fa-users"></i><h4>';
        printf( esc_html__('Membership Options', 'sellfie' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('We have options to fit every budget. Choose between a single theme, or access to all current and future themes for a year, or forever!', 'sellfie' ));
		echo '</p></div>'; 
		
		echo '<div class="col-1-4"><i class="fa fa-calendar"></i><h4>'; 
		printf( esc_html__( 'Access to New Themes', 'sellfie' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'New themes added monthly! When you purchase a premium membership you get access to all premium themes, with new themes added monthly.', 'sellfie' ));   
		echo '</p></div>';
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="https://modernthemes.net/premium-wordpress-themes/" target="_blank"><button class="pro">'; 
		printf( esc_html__( 'Get Premium Membership', 'sellfie' ));
		echo '</button></a></div></div>';
		
		echo '<div class="grid grid-pad"><div class="col-1-1"><h2 style="text-align: center;">';
		printf( esc_html__( 'Changelog' , 'sellfie' ) ); 
        echo "</h2>"; 
		

		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.2 - Update: updated translation files', 'sellfie' )); 
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.1 - Update: updated WooCommerce templates', 'sellfie' )); 
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.0 - New Theme!', 'sellfie' )); 
		echo '</p></div></div>';
		
    }
?>