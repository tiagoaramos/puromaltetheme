<?php
/**
 * sellfie Theme Customizer.
 *
 * @package sellfie
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sellfie_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Move and Replace
//-------------------------------------------------------------------------------------------------------------------// 
	
	//Colors
	$wp_customize->add_panel( 'sellfie_colors_panel', array( 
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'General Colors', 'sellfie' ),
    'description'    => esc_html__( 'Edit your general color settings.', 'sellfie' ),
	));
	
	//Nav
	$wp_customize->add_panel( 'sellfie_nav_panel', array(
    'priority'       => 11,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Header | Navigation', 'sellfie' )
	));
	
	// nav 
	$wp_customize->add_section( 'nav', array( 
	'title' => esc_html__( 'Header | Navigation Settings', 'sellfie' ),
	'priority' => '10', 
	'panel' => 'sellfie_nav_panel'
	) );
	
	// colors
	$wp_customize->add_section( 'colors', array(
	'title' => esc_html__( 'Theme Colors', 'sellfie' ),   
	'priority' => '10', 
	'panel' => 'sellfie_colors_panel' 
	) );
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 8; 
	$wp_customize->get_section('title_tagline')->priority = 10;
	$wp_customize->remove_section('header_image'); 
	
	//premiums are better
    class sellfie_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() {
        ?>

        <?php
        }
    }	
	

//-------------------------------------------------------------------------------------------------------------------//
// Upgrade
//-------------------------------------------------------------------------------------------------------------------//

    $wp_customize->add_section(
        'sellfie_theme_info',
        array(
            'title' => esc_html__('Sellfie Pro', 'sellfie'),  
            'priority' => 5, 
            'description' => esc_html__('Want more ways to sell? If you want to see what additional features are included in Sellfie Pro, visit https://modernthemes.net/wordpress-themes/sellfie-pro/ for a closer look.', 'sellfie'),
    )); 
	 
    //show them what we have to offer 
    $wp_customize->add_setting('sellfie_help', array(
			'sanitize_callback' => 'sellfie_no_sanitize',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
    ));
	
    $wp_customize->add_control( new sellfie_Info( $wp_customize, 'sellfie_help', array( 
        'section' => 'sellfie_theme_info', 
        'settings' => 'sellfie_help',  
        'priority' => 10
    )));
	

//-------------------------------------------------------------------------------------------------------------------//
// Navigation
//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_setting( 'sellfie_site_title_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_site_title_color', array(
        'label'	   => esc_html__( 'Site Title', 'sellfie' ),
        'section'  => 'title_tagline',
        'settings' => 'sellfie_site_title_color',
		'priority' => 25,
    )));
	
	$wp_customize->add_setting( 'sellfie_menu_toggle', array(
		'default' => 'both', 
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'sellfie_sanitize_menu_toggle_display', 
  	));

  	$wp_customize->add_control( 'sellfie_menu_toggle_radio', array(
    	'settings' => 'sellfie_menu_toggle',
    	'label'    => esc_html__( 'Menu Toggle Display', 'sellfie' ), 
    	'section'  => 'nav',
    	'type'     => 'radio',
    	'choices'  => array(
      		'icon' => esc_html__( 'Icon', 'sellfie' ),
      		'label' => esc_html__( 'Menu', 'sellfie' ), 
			'both'  => esc_html__( 'Both', 'sellfie' ),  
    	),
	)); 
	
//-------------------------------------------------------------------------------------------------------------------//
// Navigation Colors
//-------------------------------------------------------------------------------------------------------------------//

	// Nav Colors
    $wp_customize->add_section( 'sellfie_nav_colors_section' , array(  
	    'title'       => esc_html__( 'Navigation Colors', 'sellfie' ),
	    'priority'    => 30, 
	    'description' => esc_html__( 'Set your theme navigation colors.', 'sellfie'),
		'panel' => 'sellfie_nav_panel', 
	));
	
	$wp_customize->add_setting( 'sellfie_mobile_button_text_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_mobile_button_text_color', array(
        'label'	   => esc_html__( 'Menu Button', 'sellfie' ),
        'section'  => 'sellfie_nav_colors_section',
        'settings' => 'sellfie_mobile_button_text_color',
		'priority' => 10, 
    ))); 
	
	$wp_customize->add_setting( 'sellfie_mobile_button_hover_color', array(
        'default'     => '#111111', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_mobile_button_hover_color', array(
        'label'	   => esc_html__( 'Menu Button Hover', 'sellfie' ),
        'section'  => 'sellfie_nav_colors_section',
        'settings' => 'sellfie_mobile_button_hover_color',
		'priority' => 20, 
    ))); 

	$wp_customize->add_setting( 'sellfie_mobile_menu_bg', array(
        'default'     => '#15171f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_mobile_menu_bg', array(
        'label'	   => esc_html__( 'Side Menu Background', 'sellfie' ),
        'section'  => 'sellfie_nav_colors_section',
        'settings' => 'sellfie_mobile_menu_bg',
		'priority' => 30,
    )));
	
	$wp_customize->add_setting( 'sellfie_mobile_menu_link', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_mobile_menu_link', array(
        'label'	   => esc_html__( 'Side Menu Link', 'sellfie' ),
        'section'  => 'sellfie_nav_colors_section',
        'settings' => 'sellfie_mobile_menu_link',
		'priority' => 40,
    )));
	
	$wp_customize->add_setting( 'sellfie_mobile_menu_hover', array(
        'default'     => '#fd3253',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_mobile_menu_hover', array(
        'label'	   => esc_html__( 'Side Menu Link Hover', 'sellfie' ),
        'section'  => 'sellfie_nav_colors_section',
        'settings' => 'sellfie_mobile_menu_hover',
		'priority' => 50, 
    )));
	
	
	// Header Colors
    $wp_customize->add_section( 'sellfie_header_colors_section' , array(  
	    'title'       => esc_html__( 'Header Colors', 'sellfie' ),
	    'priority'    => 30, 
	    'description' => esc_html__( 'Set your theme header colors.', 'sellfie'),
		'panel' => 'sellfie_nav_panel', 
	));
	
	$wp_customize->add_setting( 'sellfie_header_bg', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_header_bg', array(
        'label'	   => esc_html__( 'Header Background', 'sellfie' ),
        'section'  => 'sellfie_header_colors_section',
        'settings' => 'sellfie_header_bg', 
		'priority' => 10, 
    ))); 
	
	$wp_customize->add_setting( 'sellfie_header_border', array(
        'default'     => '#e1e1e1',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_header_border', array(
        'label'	   => esc_html__( 'Header Border', 'sellfie' ),
        'section'  => 'sellfie_header_colors_section',
        'settings' => 'sellfie_header_border', 
		'priority' => 15,
    )));
	
	$wp_customize->add_setting( 'sellfie_header_cart', array(
        'default'     => '#fd3253', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_header_cart', array(
        'label'	   => esc_html__( 'Cart Icon', 'sellfie' ),
        'section'  => 'sellfie_header_colors_section',
        'settings' => 'sellfie_header_cart', 
		'priority' => 20, 
    ))); 
	
	$wp_customize->add_setting( 'sellfie_cart_number', array(
        'default'     => '#111111', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_cart_number', array(
        'label'	   => esc_html__( 'Cart Background', 'sellfie' ),
        'section'  => 'sellfie_header_colors_section',
        'settings' => 'sellfie_cart_number', 
		'priority' => 25, 
    ))); 
	
	$wp_customize->add_setting( 'sellfie_cart_number_text', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_cart_number_text', array(
        'label'	   => esc_html__( 'Cart Text', 'sellfie' ),
        'section'  => 'sellfie_header_colors_section',
        'settings' => 'sellfie_cart_number_text',
		'priority' => 30,
    ))); 

	
//-------------------------------------------------------------------------------------------------------------------//
// Hero Section
//-------------------------------------------------------------------------------------------------------------------//
	
	//Home Hero Section
    $wp_customize->add_section( 'sellfie_home_hero_section' , array(  
	    'title'       => esc_html__( 'Home Hero Section', 'sellfie' ), 
	    'priority'    => 22, 
	    'description' => esc_html__( 'Edit the options for the Home Page Hero section.', 'sellfie'),
	));
	
	$wp_customize->add_setting( 'sellfie_home_bg_image', array( 
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sellfie_home_bg_image', array( 
		'label'    => esc_html__( 'Background Image', 'sellfie' ),
		'type'     => 'image', 
		'section'  => 'sellfie_home_hero_section', 
		'settings' => 'sellfie_home_bg_image', 
		'priority' => 10,
	)));
	
	// Page Drop Downs 
	$wp_customize->add_setting('sellfie_bg_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'sellfie_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sellfie_bg_url', array( 
    	'label' => esc_html__( 'Image URL', 'sellfie' ), 
    	'section'  => 'sellfie_home_hero_section', 
		'type' => 'dropdown-pages',
    	'settings' => 'sellfie_bg_url',
		'priority'   => 20  
	)));
	
//-------------------------------------------------------------------------------------------------------------------//
// Home Page
//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_panel( 'sellfie_home_page_panel', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Home Page Options', 'sellfie' ),
    'description'    => esc_html__( 'Edit your home page settings', 'sellfie' ),
	));

	//Products
    $wp_customize->add_section( 'sellfie_home_products_section' , array(  
	    'title'       => esc_html__( 'Home Products', 'sellfie' ),
	    'priority'    => 30, 
		'panel'		  => 'sellfie_home_page_panel',
	    'description' => esc_html__( 'Edit the options for the home page products area.', 'sellfie'),
	));
	
	//Hide Section 
	$wp_customize->add_setting('active_home_products',
	    array(
	        'sanitize_callback' => 'sellfie_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_home_products', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Products', 'sellfie' ),
        'section' => 'sellfie_home_products_section', 
		'priority'   => 5 
    ));  
	
	//Title
	$wp_customize->add_setting( 'sellfie_products_title',
	    array(
	        'sanitize_callback' => 'sellfie_sanitize_text',
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sellfie_products_title', array(
		'label'    => esc_html__( 'Home Products Title', 'sellfie' ), 
		'section'  => 'sellfie_home_products_section',  
		'settings' => 'sellfie_products_title',  
		'priority'   => 8
	)));
	
	//Number of Products
    $wp_customize->add_setting(
        'sellfie_products_length',
        array(
            'sanitize_callback' => 'absint',
			'default' => '12', 
    ));
	
    $wp_customize->add_control( 'sellfie_products_length', array(  
        'type'        => 'number',
        'priority'    => 10, 
        'section'  => 'sellfie_home_products_section',  
        'label'       => esc_html__('Number of Products', 'sellfie'),
        'description' => esc_html__('Choose the number of products to display. Default is set to 12. If you want to display all, set the number to 0.', 'sellfie'),  
        'input_attrs' => array( 
            'min'   => -1, 
            'max'   => 50,  
            
        ), 
	));
	
	$wp_customize->add_setting( 'sellfie_products_bg', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_products_bg', array(
        'label'	   => esc_html__( 'Background', 'sellfie' ),
        'section'  => 'sellfie_home_products_section',
        'settings' => 'sellfie_products_bg',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'sellfie_products_border', array(
        'default'     => '#e1e1e1',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_products_border', array(
        'label'	   => esc_html__( 'Border', 'sellfie' ),
        'section'  => 'sellfie_home_products_section',
        'settings' => 'sellfie_products_border',
		'priority' => 23
    )));
	
	$wp_customize->add_setting( 'sellfie_products_text', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_products_text', array(
        'label'	   => esc_html__( 'Text', 'sellfie' ),
        'section'  => 'sellfie_home_products_section',
        'settings' => 'sellfie_products_text',
		'priority' => 25
    )));
	
	$wp_customize->add_setting( 'sellfie_products_title_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_products_title_color', array(
        'label'	   => esc_html__( 'Title', 'sellfie' ),
        'section'  => 'sellfie_home_products_section',
        'settings' => 'sellfie_products_title_color',
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'sellfie_products_amount', array(
        'default'     => '#fd3253',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_products_amount', array(
        'label'	   => esc_html__( 'Product Details', 'sellfie' ),
        'section'  => 'sellfie_home_products_section',
        'settings' => 'sellfie_products_amount',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'sellfie_products_arrow', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_products_arrow', array(
        'label'	   => esc_html__( 'Arrows', 'sellfie' ),
        'section'  => 'sellfie_home_products_section',
        'settings' => 'sellfie_products_arrow',
		'priority' => 40 
    )));
	
	//First Widget Area
    $wp_customize->add_section( 'sellfie_home_widget_section_1' , array(  
	    'title'       => esc_html__( 'Home Widget Area', 'sellfie' ),
	    'priority'    => 50, 
	    'description' => esc_html__( 'Edit the options for the home page widget area.', 'sellfie'),
		'panel'		  => 'sellfie_home_page_panel',
	)); 
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'sellfie_widget_column_two', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'sellfie_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sellfie_widget_column_two', array(
		'label'    => esc_html__( 'Number of Widget Columns', 'sellfie' ),
		'description'    => esc_html__( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row. Recommended: Set to 1 Column if you are using ModernThemes plugin widgets.', 'sellfie' ),
		'section'  => 'sellfie_home_widget_section_1', 
		'settings' => 'sellfie_widget_column_two', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => esc_html__( '1 Column', 'sellfie' ),
			'option2' => esc_html__( '2 Columns', 'sellfie' ), 
			'option3' => esc_html__( '3 Columns', 'sellfie' ),
			'option4' => esc_html__( '4 Columns', 'sellfie' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px;',
        ),
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_1',
	    array(
	        'sanitize_callback' => 'sellfie_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_1', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Widget Area #1', 'sellfie' ),
        'section' => 'sellfie_home_widget_section_1', 
		'priority'   => 10
    ));
	
	// Main Background
	$wp_customize->add_setting( 'sellfie_widget_bg_one', array(
		'sanitize_callback' => 'esc_url_raw', 
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sellfie_widget_bg_one', array( 
		'type'    => 'image',
		'label'    => esc_html__( 'Background Image', 'sellfie' ), 
		'section' => 'sellfie_home_widget_section_1',
		'settings' => 'sellfie_widget_bg_one', 
		'priority'   => 15
	))); 
	
	$wp_customize->add_setting( 'sellfie_hw_area_1_bg_color', array(
        'default'     => '#f1f1f1',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hw_area_1_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'sellfie' ),
        'section'  => 'sellfie_home_widget_section_1',
        'settings' => 'sellfie_hw_area_1_bg_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'sellfie_hw_area_1_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hw_area_1_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'sellfie' ),
        'section'  => 'sellfie_home_widget_section_1',
        'settings' => 'sellfie_hw_area_1_text_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'sellfie_hw_area_1_heading_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hw_area_1_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'sellfie' ),
        'section'  => 'sellfie_home_widget_section_1',
        'settings' => 'sellfie_hw_area_1_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'sellfie_hw_area_1_link_color', array(
        'default'     => '#fd3253',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hw_area_1_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'sellfie' ),
        'section'  => 'sellfie_home_widget_section_1',
        'settings' => 'sellfie_hw_area_1_link_color', 
		'priority' => 38
    )));
	
	$wp_customize->add_setting( 'sellfie_hw_area_1_link_hover_color', array(
        'default'     => '#fd3253',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hw_area_1_link_hover_color', array(
        'label'	   => esc_html__( 'Link Hover Color', 'sellfie' ),
        'section'  => 'sellfie_home_widget_section_1',
        'settings' => 'sellfie_hw_area_1_link_hover_color', 
		'priority' => 39
    )));
	
	$wp_customize->add_setting( 'sellfie_hw_area_1_button_color', array(
        'default'     => '#fd3253',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hw_area_1_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'sellfie' ),
        'section'  => 'sellfie_home_widget_section_1',
        'settings' => 'sellfie_hw_area_1_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'sellfie_hw_area_1_button_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hw_area_1_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'sellfie' ),
        'section'  => 'sellfie_home_widget_section_1',
        'settings' => 'sellfie_hw_area_1_button_text_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'sellfie_hw_area_1_button_hover_color', array(
        'default'     => '#fd3253', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hw_area_1_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'sellfie' ),
        'section'  => 'sellfie_home_widget_section_1',
        'settings' => 'sellfie_hw_area_1_button_hover_color',
		'priority' => 50  
    ))); 
	
	$wp_customize->add_setting( 'sellfie_hw_area_1_button_hover_text_color', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hw_area_1_button_hover_text_color', array(
        'label'	   => esc_html__( 'Button Hover Text Color', 'sellfie' ),
        'section'  => 'sellfie_home_widget_section_1',
        'settings' => 'sellfie_hw_area_1_button_hover_text_color',
		'priority' => 50  
    ))); 
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Footer
//-------------------------------------------------------------------------------------------------------------------//
	 
	 
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => esc_html__( 'Footer', 'sellfie' ),
    	'priority' => 30,
    	'description' => esc_html__( 'Customize your footer area', 'sellfie' )
	)); 

	// Footer Byline Text 
	$wp_customize->add_setting( 'sellfie_footerid',
	    array(
	        'sanitize_callback' => 'sellfie_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sellfie_footerid', array(
    'label' => esc_html__( 'Footer Byline Text', 'sellfie' ),
    'section' => 'footer-custom', 
    'settings' => 'sellfie_footerid',
	'priority'   => 30
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_byline',
	    array(
	        'sanitize_callback' => 'sellfie_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_byline', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Footer Byline', 'sellfie' ),
        'section' => 'footer-custom',  
		'priority'   => 35
    ));
	
	$wp_customize->add_setting( 'sellfie_footer_color', array( 
        'default'     => '#f1f1f1',  
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_footer_color', array(
        'label'	   => esc_html__( 'Footer Background Color', 'sellfie'),
        'section'  => 'footer-custom',
        'settings' => 'sellfie_footer_color',
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'sellfie_footer_text_color', array( 
        'default'     => '#888888', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_footer_text_color', array(
        'label'	   => esc_html__( 'Footer Text Color', 'sellfie'),
        'section'  => 'footer-custom',
        'settings' => 'sellfie_footer_text_color', 
		'priority' => 50
    ))); 
	
	$wp_customize->add_setting( 'sellfie_footer_link_color', array(  
        'default'     => '#111111', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_footer_link_color', array(
        'label'	   => esc_html__( 'Footer Link Color', 'sellfie'),  
        'section'  => 'footer-custom',
        'settings' => 'sellfie_footer_link_color', 
		'priority' => 60 
    )));
	
	$wp_customize->add_setting( 'sellfie_footer_link_hover_color', array(  
        'default'     => '#111111',  
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_footer_link_hover_color', array(
        'label'	   => esc_html__( 'Footer Link Hover Color', 'sellfie'),  
        'section'  => 'footer-custom', 
        'settings' => 'sellfie_footer_link_hover_color', 
		'priority' => 70
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Social Icons
//-------------------------------------------------------------------------------------------------------------------//

	
	//Social Section
	$wp_customize->add_section( 'sellfie_settings', array(
            'title'          => esc_html__( 'Social Media Icons', 'sellfie' ),
			'description'    => esc_html__( 'Edit your social media icons', 'sellfie' ),
            'priority'       => 38,
    ) );
	
	//Hide Social Section 
	$wp_customize->add_setting('active_social',
	    array(
	        'sanitize_callback' => 'sellfie_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_social', 
    array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Social Media Icons', 'sellfie' ),
        'section' => 'sellfie_settings',  
		'priority'   => 10
    ));
	
	//social font size
    $wp_customize->add_setting( 
        'sellfie_social_text_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '24', 
        )
    );
	
    $wp_customize->add_control( 'sellfie_social_text_size', array(
        'type'        => 'number', 
        'priority'    => 15,
        'section'     => 'sellfie_settings', 
        'label'       => esc_html__('Social Icon Size', 'sellfie'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32, 
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
		
	//Social Icon Colors
	$wp_customize->add_setting( 'sellfie_social_color', array( 
        'default'     => '#111111',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_social_color', array(
        'label'	   => esc_html__( 'Social Icon', 'sellfie' ),
        'section'  => 'sellfie_settings',
        'settings' => 'sellfie_social_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'sellfie_social_color_hover', array( 
        'default'     => '#111111',   
		'sanitize_callback' => 'sanitize_hex_color',  
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_social_color_hover', array(
        'label'	   => esc_html__( 'Social Icon Hover', 'sellfie' ), 
        'section'  => 'sellfie_settings',
        'settings' => 'sellfie_social_color_hover', 
		'priority' => 30
    ))); 
	

//-------------------------------------------------------------------------------------------------------------------//
// General Colors
//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_setting( 'sellfie_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'sellfie' ),
        'section'  => 'colors',
        'settings' => 'sellfie_text_color',
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'sellfie_heading_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'sellfie' ),
        'section'  => 'colors',
        'settings' => 'sellfie_heading_color', 
		'priority' => 11
    ))); 
	
    $wp_customize->add_setting( 'sellfie_link_color', array( 
        'default'     => '#fd3253',   
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'sellfie'),
        'section'  => 'colors',
        'settings' => 'sellfie_link_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'sellfie_hover_color', array(
        'default'     => '#fd3253',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_hover_color', array(
        'label'	   => esc_html__( 'Hover Color', 'sellfie' ), 
        'section'  => 'colors',
        'settings' => 'sellfie_hover_color',
		'priority' => 35 
    ))); 
	
	
	//Page Colors
    $wp_customize->add_section( 'sellfie_page_colors_section' , array(  
	    'title'       => esc_html__( 'Page Colors', 'sellfie' ),
	    'priority'    => 20, 
	    'description' => esc_html__( 'Set your page colors.', 'sellfie'),
		'panel' => 'sellfie_colors_panel', 
	));
	
	$wp_customize->add_setting( 'sellfie_entry', array(
        'default'     => '#000000', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_entry', array(
        'label'	   => esc_html__( 'Page Title Color', 'sellfie' ), 
        'section'  => 'sellfie_page_colors_section',
        'settings' => 'sellfie_entry',  
		'priority' => 20
    )));

	$wp_customize->add_setting( 'sellfie_custom_color', array(
        'default'     => '#fd3253',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_custom_color', array(
        'label'	   => esc_html__( 'Button Color', 'sellfie' ),
        'section'  => 'sellfie_page_colors_section',
        'settings' => 'sellfie_custom_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'sellfie_button_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'sellfie' ),
         'section'  => 'sellfie_page_colors_section',
        'settings' => 'sellfie_button_text_color',
		'priority' => 45
    ))); 
	
	$wp_customize->add_setting( 'sellfie_custom_color_hover', array(
        'default'     => '#fd3253', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_custom_color_hover', array(
        'label'	   => esc_html__( 'Button Hover Color', 'sellfie' ),
        'section'  => 'sellfie_page_colors_section',
        'settings' => 'sellfie_custom_color_hover', 
		'priority' => 50  
    )));
	
	$wp_customize->add_setting( 'sellfie_button_text_hover_color', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_button_text_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Text Color', 'sellfie' ),
        'section'  => 'sellfie_page_colors_section',
        'settings' => 'sellfie_button_text_hover_color',
		'priority' => 55
    )));
	
	$wp_customize->add_setting( 'sellfie_page_border_color', array(
        'default'     => '#e1e1e1', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sellfie_page_border_color', array(
        'label'	   => esc_html__( 'Page Border', 'sellfie' ),
        'section'  => 'sellfie_page_colors_section',
        'settings' => 'sellfie_page_border_color',
		'priority' => 60
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Fonts
//-------------------------------------------------------------------------------------------------------------------//	
	
    $wp_customize->add_section(
        'sellfie_typography',
        array(
            'title' => esc_html__('Fonts', 'sellfie' ),   
            'priority' => 45, 
    ));
	
    $font_choices = 
        array(
			' ', 
			'Lato:400,700,400italic,700italic' => 'Lato',
			'Montserrat:400,700' => 'Montserrat',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald', 
			'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
	
	//body font size
    $wp_customize->add_setting(
        'sellfie_body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '16', 
        )
    );
	
    $wp_customize->add_control( 'sellfie_body_size', array(
        'type'        => 'number', 
        'priority'    => 10,
        'section'     => 'sellfie_typography',
        'label'       => esc_html__('Body Font Size', 'sellfie'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 28,
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'sellfie_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
			'default'           => '20', 
            'description' => esc_html__('Select your desired font for the headings. Montserrat is the default Heading font.', 'sellfie'),
            'section' => 'sellfie_typography',
            'choices' => $font_choices
    ));
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'sellfie_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
			'default'           => '30', 
            'description' => esc_html__( 'Select your desired font for the body. Montserrat is the default Body font.', 'sellfie' ), 
            'section' => 'sellfie_typography',   
            'choices' => $font_choices 
    ));
	

//-------------------------------------------------------------------------------------------------------------------//
// Blog Layout
//-------------------------------------------------------------------------------------------------------------------// 
	
	//Post Content
	$wp_customize->add_setting( 'sellfie_post_content', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'sellfie_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sellfie_post_content', array(
		'label'    => esc_html__( 'Post content', 'sellfie' ),
		'section'  => 'sellfie_layout_section',
		'settings' => 'sellfie_post_content', 
		'type'     => 'radio',
		'priority'   => 30, 
		'choices'  => array(
			'option1' => esc_html__( 'Excerpts', 'sellfie' ), 
			'option2' => esc_html__( 'Full content', 'sellfie' ), 
			),
	)));
	
	//Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '35',
    ));
	
    $wp_customize->add_control( 'exc_length', array( 
        'type'        => 'number',
        'priority'    => 2, 
        'section'     => 'sellfie_layout_section',
        'label'       => esc_html__( 'Excerpt length', 'sellfie' ),
		'priority'   => 40,
        'description' => esc_html__( 'Default: 35 words', 'sellfie' ),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5
        ), 
	));
	
	
}
add_action( 'customize_register', 'sellfie_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sellfie_customize_preview_js() {
	wp_enqueue_script( 'sellfie_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'sellfie_customize_preview_js' );
