<?php


//Google Fonts 

function sellfie_custom_styles($custom) {  


	//Fonts 

	$sellfie_headings_font = esc_html( get_theme_mod('headings_fonts' )); 

	$sellfie_body_font = esc_html( get_theme_mod('body_fonts' )); 	

	

	if ( $sellfie_headings_font ) {

		$font_pieces = explode(":", $sellfie_headings_font); 

		$custom .= "h1, h2, h3, h4, h5, h6, .page-entry-header .entry-title { font-family: {$font_pieces[0]}; }"."\n";

	}

	if ( $sellfie_body_font ) {

		$font_pieces = explode(":", $sellfie_body_font);

		$custom .= "body, button, input, select, textarea { font-family: {$font_pieces[0]}; }"."\n";

	}

	//Output all the styles

	wp_add_inline_style( 'sellfie-style', $custom ); 	

}

add_action( 'wp_enqueue_scripts', 'sellfie_custom_styles' );