<?php
/**
 * sellfie functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sellfie
 */
 
 
/**
 * register the theme update
 */ 
require 'theme-updates/theme-update-checker.php';
$MyThemeUpdateChecker = new ThemeUpdateChecker(
'sellfie', //Theme slug. Usually the same as the name of its directory.
'http://modernthemes.net/updates/?action=get_metadata&slug=sellfie' //Metadata URL.
);  

if ( ! function_exists( 'sellfie_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sellfie_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sellfie, use a find and replace
	 * to change 'sellfie' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sellfie', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location. 
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'sellfie' ),
		'social'  => esc_html__( 'Social', 'sellfie' ), 
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set logo support
    add_theme_support( 'custom-logo' );
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sellfie_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '', 
	) ) );
	
}
endif;
add_action( 'after_setup_theme', 'sellfie_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sellfie_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sellfie_content_width', 640 );
}
add_action( 'after_setup_theme', 'sellfie_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sellfie_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sellfie' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sellfie' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'sellfie' ),
		'id'            => 'sidebar-shop',
		'description'   => esc_html__( 'Add widgets here.', 'sellfie' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area #1', 'sellfie' ),
		'id'            => 'home-widget-area-one',
		'description'   => esc_html__( 'Use this widget area to display home page content', 'sellfie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	//Register the sidebar widgets   
	register_widget( 'sellfie_Video_Widget' ); 
	register_widget( 'sellfie_Contact_Info' );
	register_widget( 'sellfie_action' );
	register_widget( 'sellfie_home_news' );
	
}
add_action( 'widgets_init', 'sellfie_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sellfie_scripts() {
	wp_enqueue_style( 'sellfie-style', get_stylesheet_uri() );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts'));
	
	if( $headings_font ) {
		wp_enqueue_style( 'sellfie-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );
	} else {
		wp_enqueue_style( 'sellfie-open-headings', '//fonts.googleapis.com/css?family=Montserrat:400,700');   
	}	
	if( $body_font ) {
		wp_enqueue_style( 'sellfie-body-fonts', '//fonts.googleapis.com/css?family='. $body_font ); 	
	} else {
		wp_enqueue_style( 'sellfie-open-body', '//fonts.googleapis.com/css?family=Montserrat:400,700'); 
	}
	
	wp_enqueue_style( 'sellfie-menu', get_template_directory_uri() . '/css/jPushMenu.css' );
	
	wp_enqueue_style( 'sellfie-slick', get_template_directory_uri() . '/css/slick.css' ); 
	
	wp_enqueue_style( 'sellfie-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.css' );
	
	wp_enqueue_style( 'sellfie-woocommerce', get_template_directory_uri() . '/css/woocommerce-styles.css' );

	wp_enqueue_script( 'sellfie-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'sellfie-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'sellfie-menu', get_template_directory_uri() . '/js/jPushMenu.js', array('jquery'), false, true );

	wp_enqueue_script( 'sellfie-menu-script', get_template_directory_uri() . '/js/menu.script.js', array(), false, true );

	wp_enqueue_script( 'sellfie-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), false, true );

	wp_enqueue_script( 'sellfie-slick-script', get_template_directory_uri() . '/js/slick.script.js', array(), false, true );

	wp_enqueue_script( 'sellfie-parallax', get_template_directory_uri() . '/js/parallax.min.js', array('jquery'), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sellfie_scripts' );

/*-----------------------------------------------------------------------------------------------------//
	HTML5 Shiv
-------------------------------------------------------------------------------------------------------*/

function sellfie_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'sellfie_html5shiv' );

/*-----------------------------------------------------------------------------------------------------//
	Excerpt Length
-------------------------------------------------------------------------------------------------------*/

function sellfie_excerpt_length( $length ) {
	
	$excerpt = get_theme_mod('exc_length', '35');
	return $excerpt; 

}

add_filter( 'excerpt_length', 'sellfie_excerpt_length', 999 ); 

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/sellfie-sanitize.php'; 
require get_template_directory() . '/inc/sellfie-styles.php';
require get_template_directory() . '/inc/sellfie-active-options.php';

/**
 * Sidebar widget columns
 */
require get_template_directory() . '/inc/sellfie-sidebar-columns.php'; 

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';
require get_template_directory() . '/panel/sellfie-theme-admin-page.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * register your custom widgets
 */  
include( get_template_directory() . '/inc/widgets.php' ); 

/**
 * Activate for a child theme.  Always use a child theme to make edits.
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/use-child-theme.php' ); 

// allow skype names in social menu
function sellfie_allow_skype_protocol( $protocols ){
    $protocols[] = 'skype';
    return $protocols;
}
add_filter( 'kses_allowed_protocols' , 'sellfie_allow_skype_protocol' ); 

/**
 * Let WooCommerce know we support it.
 */
add_action( 'after_setup_theme', 'woocommerce_support' ); 
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Change Products to 3 per row.
 */
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

function categories_postcount_filter ($sellfie_counter) {
   $sellfie_counter = str_replace('(', '<span class="post_count"> ', $sellfie_counter);
   $sellfie_counter = str_replace(')', ' </span>', $sellfie_counter); 
   return $sellfie_counter;
}
add_filter('wp_list_categories','categories_postcount_filter');
