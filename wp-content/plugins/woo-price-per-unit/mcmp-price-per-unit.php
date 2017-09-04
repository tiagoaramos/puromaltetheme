<?php
/*
Plugin Name: WooCommerce Price Per Unit
Plugin URI: https://wordpress.org/plugins/woo-price-per-unit/
Description: WooCommerce Price Per Unit allows the user to show prices recalculated per units(weight) and do some customization to the look of the prices
Version: 1.4
Author: Martin Mechura
Author URI: http://mechcomp.cz
Text Domain: mcmp-price-per-unit

@author		 Martin Mechura
@category    Admin

WooCommerce Price Per Unit. A Plugin that works with the WooCommerce plugin for WordPress.
Copyright (C) 2017 Martin Mechura

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.
*/
if ( ! defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;
class mcmp_PPU {
    private static $instance = null;
	private $single_pr_id = 0;
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	/**
	 * The Constructor!
	 * @since 1.0
	 */
    public function __construct() {
		global $woocommerce;
		//Loading translation
		add_action( 'init', array( $this, 'load_textdomain' ) );
		//Loading stylesheet
		add_action( 'wp_enqueue_scripts', array( $this, 'load_style' ) );
		////Adding single product options tab
		add_filter( 'woocommerce_product_data_tabs',array($this,'add_custom_product_options_tab'), 99 , 1 );
		//Adding single product options
		add_action( 'woocommerce_product_data_panels', array( $this, 'product_options' ) );
		//Saving single product options
        add_action( 'woocommerce_process_product_meta', array( $this, 'save_product_options' ) );
		//helper for getting single product ID
		add_action( 'woocommerce_before_single_product', array( $this, 'get_single_id' ) );
		//Adding general woo options
		add_filter( 'woocommerce_get_settings_products', array( $this, 'general_options' ), 10, 2 );
		add_filter( 'woocommerce_get_sections_products', array( $this, 'add_general_options_section' ) );
		//Extending plugin actions
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );
        // Render the ppu field output on the frontend
        add_filter( 'woocommerce_get_price_html', array( $this, 'custom_price' ) );
		add_filter( 'woocommerce_variable_price_html', array( $this, 'custom_price' ) );
		add_filter( 'woocommerce_variable_sale_price_html', array( $this, 'custom_price' ) );
    }
	/**
	* Load plugin's textdomain
	* @since 1.0
	*/
	public function load_textdomain() {
		load_plugin_textdomain( 'mcmp-price-per-unit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
	/**
	* Load plugin's CSS style
	* @since 1.3
	*/
	public function load_style() {
		if(get_option('_mcmp_ppu_add_row_css')=='yes'){
			wp_enqueue_style( 'mcmp_price_per_unit_style',plugins_url('/assets/CSS/mcmp-ppu.css', __FILE__));
		}
	}
	/**
	* Add settings link
	* @since 1.0
	*/
	public function plugin_action_links( $links ) {
		$plugin_links = array(
			'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=products&section=mcmp_price_pu' ) . '">' . __( 'Settings', 'mcmp-price-per-unit' ) . '</a>',
		);
		return array_merge( $plugin_links, $links );
	}
	/**
	 * Adds tab to product options
	 * @since 1.0
	 */
	public function add_custom_product_options_tab($product_opt_tabs) {
		$product_opt_tabs['price-per-unit'] = array(
			'label' => __( 'Price per unit', 'mcmp-price-per-unit' ), // translatable
			'target' => 'mcmp_ppu_options', // translatable
		);
		return $product_opt_tabs;
	}
	/**
	* Add the custom fields to the product general tab
	* @since 1.0
	*/
	public function product_options() {
		global $woocommerce, $product;
		
		echo '<div id="mcmp_ppu_options" class="panel woocommerce_options_panel">'; 
		echo '<p><span style="font-size: 1.5em;">'.__( 'Local overrides for price recalculation', 'mcmp-price-per-unit' ).'</span></br>';
		echo __( 'These settings will affect only this product despite global settings.', 'mcmp-price-per-unit' ).'</br>'; 
		echo __( 'Global settings can be found at ', 'mcmp-price-per-unit' );
		echo '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=products&section=mcmp_price_pu' ) . '" target="_blank">';
		echo __( '<i>WooCommerce -> Settings -> Products -> Price Per Unit</i>', 'mcmp-price-per-unit' ) . '</a>' . '</p>';
			// mcmp_ppu fields will be created here. 
			woocommerce_wp_select(
				array(
					'id'		=> '_mcmp_ppu_general_override',
					'label'		=> __( 'Shop page price behavior', 'mcmp-price-per-unit' ),
					'description'		=> __( 'Behaviour of recalculated price on shop page', 'mcmp-price-per-unit' ),
					'default'	=> '',
					'options'	=> array(
							''				=> __( 'Default - according to general settings', 'mcmp-price-per-unit' ),
							'not'			=> __( 'Do not recalculate', 'mcmp-price-per-unit' ),
							'add'			=> __( 'Show recalculated price as new row', 'mcmp-price-per-unit' ),
							'replace'		=> __( 'Replace price view with recalculated', 'mcmp-price-per-unit' ),
						),
					'desc_tip'	=> true,
				)
			);
			woocommerce_wp_select(
				array(
					'id'		=> '_mcmp_ppu_single_page_override',
					'label'		=> __( 'Single product page behavior', 'mcmp-price-per-unit' ),
					'description'		=> __( 'Behaviour of recalculated price on single product page', 'mcmp-price-per-unit' ),
					'default'	=> '',
					'options'	=> array(
							''				=> __( 'Default - according to general settings', 'mcmp-price-per-unit' ),
							'not'			=> __( 'Do not recalculate', 'mcmp-price-per-unit' ),
							'add'			=> __( 'Show recalculated price as new row', 'mcmp-price-per-unit' ),
							'replace'		=> __( 'Replace price view with recalculated', 'mcmp-price-per-unit' ),
						),
					'desc_tip'	=> true,
				)
			);
			woocommerce_wp_text_input( 
				array( 
					'id'          => '_mcmp_ppu_recalc_text_override', 
					'label'       => __( 'Recalculated price additional text', 'mcmp-price-per-unit' ), 
					'description' => __( 'Will be shown immediatelly after recalculated prices. Will be shown ONLY when recalculation takes place.', 'mcmp-price-per-unit' ),
					'placeholder' => __( 'Example "/Kg"', 'mcmp-price-per-unit' ),
					'default'	=> '',
					'desc_tip'    => 'true'
				)
			);
		echo '</div>';
	}

	/**
	* Update the database with the new options
	* @since 1.0
	*/
	public function save_product_options($post_id){
		// mcmp_ppu text field
		$option = $_POST['_mcmp_ppu_general_override'];
		update_post_meta( $post_id, '_mcmp_ppu_general_override', esc_attr( $option ) );
		$option = $_POST['_mcmp_ppu_single_page_override'];
		update_post_meta( $post_id, '_mcmp_ppu_single_page_override', esc_attr( $option ) );
		$option = $_POST['_mcmp_ppu_recalc_text_override'];
		update_post_meta( $post_id, '_mcmp_ppu_recalc_text_override', esc_attr( $option ) );
	}
	/**
	* Add Price per Unit settings section under the Products tab.
	* @since 1.0
	*/
	public function add_general_options_section( $sections ) {
		$sections['mcmp_price_pu'] = __( 'Price Per Unit', 'mcmp-price-per-unit' );
		return $sections;
	}
	public function general_options( $settings, $current_section ) {
		if ( $current_section == 'mcmp_price_pu' ) {
			$custom_settings = array(
				array(
					'id'	=> 'mcmp_general_options',
					'name'	=> __( 'General price options', 'mcmp-price-per-unit' ),
					'desc'	=> __( 'Settings which affects all products', 'mcmp-price-per-unit' ),
					'type'	=> 'title'
				),
				array(
					'id'		=> '_mcmp_ppu_additional_text',
					'name'		=> __( 'General price additional text', 'mcmp-price-per-unit' ),
					'desc'		=> __( "This text will be shown after every price text. You can modify it's appearance through CSS class mcmp-general-price-suffix.", 'mcmp-price-per-unit' ),
					'placeholder' => __( 'Example "Without Vat"', 'mcmp-price-per-unit' ),
					'type'		=> 'text',
					'default'	=> ''
				),
				array(
					'id'		=> '_mcmp_ppu_hide_sale_price',
					'name'		=> __( 'Sale price - hide regular price', 'mcmp-price-per-unit' ),
					'desc'		=> __( 'When product is on sale it shows regular price and sale price. This will hide the regular price for all products.', 'mcmp-price-per-unit' ),
					'type'		=> 'checkbox',
					'default'	=> 'no',
					'desc_tip'	=> false
				),
				array( 'type' => 'sectionend', 'id' => 'mcmp_general_options' ),
				array(
					'id'	=> 'mcmp_variable_options',
					'name'	=> __( 'Options for variable products', 'mcmp-price-per-unit' ),
					'desc'	=> __( 'These settings affect only variable products', 'mcmp-price-per-unit' ),
					'type'	=> 'title'
				),
				array(
					'id'		=> '_mcmp_ppu_var_prefix_text',
					'name'		=> __( 'Variations - prefix for variable price', 'mcmp-price-per-unit' ),
					'desc'		=> __( "If the product is variable this text will be shown before the price. You can modify it's appearance through CSS class mcmp-variable-price-prefix.", 'mcmp-price-per-unit' ),
					'placeholder' => __( 'Example "From:"', 'mcmp-price-per-unit' ),
					'type'		=> 'text',
					'default'	=> '',
					'disabled'	=> true
				),
				array(
					'id'		=> '_mcmp_ppu_var_hide_max_price',
					'name'		=> __( 'Variations - Display only lower price', 'mcmp-price-per-unit' ),
					'desc'		=> __( 'When displaying variation the price is displayed as "$10-$25". With this setting you will get just "$10"', 'mcmp-price-per-unit' ),
					'type'		=> 'checkbox',
					'default'	=> 'no',
					'desc_tip'	=> false
				),
				array( 'type' => 'sectionend', 'id' => 'mcmp_variable_options' ),
				array(
					'id'	=> 'mcmp_recalculation_options',
					'name'	=> __( 'Price recalculation', 'mcmp-price-per-unit' ),
					'desc'	=> __('General settings for price recalculation', 'mcmp-price-per-unit'),
					'type'	=> 'title'
				),
				array(
					'id'		=> '_mcmp_ppu_add_row_css',
					'name'		=> __( 'New row different styling', 'mcmp-price-per-unit' ),
					'desc'		=> __( 'When displaying price as new row, the new row will be displayed in italics with slightly smaller font size. For more styling you can use CSS class mcmp_recalc_price_row.', 'mcmp-price-per-unit' ),
					'type'		=> 'checkbox',
					'default'	=> 'no',
					'desc_tip'	=> false
				),
				array(
					'id'		=> '_mcmp_ppu_general_behaviour',
					'name'		=> __( 'Shop page price behavior', 'mcmp-price-per-unit' ),
					'desc'		=> __( 'Behaviour of recalculated price on shop page', 'mcmp-price-per-unit' ),
					'type'		=> 'select',
					'default'	=> '',
					'options'	=> array(
							''				=> __( 'Do not show recalculated price', 'mcmp-price-per-unit' ),
							'add'			=> __( 'Show recalculated price as new row', 'mcmp-price-per-unit' ),
							'replace'		=> __( 'Replace price view with recalculated', 'mcmp-price-per-unit' ),
						),
					'css'		=> '',
					'desc_tip'	=> false
				),	
				array(
					'id'		=> '_mcmp_ppu_single_page_behaviour',
					'name'		=> __( 'Single product page behavior', 'mcmp-price-per-unit' ),
					'desc'		=> __( 'Behaviour of recalculated price on single product page', 'mcmp-price-per-unit' ),
					'type'		=> 'select',
					'default'	=> '',
					'options'	=> array(
							''				=> __( 'Do not show recalculated price', 'mcmp-price-per-unit' ),
							'add'			=> __( 'Show recalculated price as new row', 'mcmp-price-per-unit' ),
							'replace'		=> __( 'Replace price view with recalculated', 'mcmp-price-per-unit' ),
						),
					'css'		=> '',
					'desc_tip'	=> false
				),
				array(
					'id'		=> '_mcmp_ppu_recalc_text',
					'name'		=> __( 'Recalculated price additional text', 'mcmp-price-per-unit' ),
					'desc'		=> __( "Will be shown immediatelly after recalculated prices. Can be overriden in product editor. Will be shown ONLY when recalculation takes place. You can modify it's appearance through CSS class mcmp-recalc-price-suffix.", 'mcmp-price-per-unit' ),
					'placeholder' => __( 'Example "/Kg"', 'mcmp-price-per-unit' ),
					'type'		=> 'text',
					'default'	=> ''
				),
				array( 'type' => 'sectionend', 'id' => 'mcmp_recalculation_options' ),
			);
			return $custom_settings;
			// If not, return the standard settings
		} else {
			return $settings;
		}
	}
	
	/**
	* Saves product id from single product view
	* needed for determining if not running from widget on single page
	* @since 1.0
	*/
	public function get_single_id(){
		global $product;
		$this->single_pr_id=$product->id;
	}

	/**
	* Render the output
	* @since 1.0
	* @return recalculated $price + custom string
	*/
	public function custom_price( $price ) {
		global $woocommerce, $product, $page;
		$product_type=$product->get_type();
		//Workaround for WooCommerce 3 variable should pass through 
		if($product_type=='variable'){
			if (current_filter()=='woocommerce_get_price_html'){
				return $price;
			}
		}
		// Formatting additional text
		$add_text=get_option('_mcmp_ppu_additional_text');
		$add_text=(empty($add_text)) ? '' : '<span class="woocommerce-Price-currencySymbol amount mcmp-general-price-suffix">'.' '.__($add_text, 'mcmp-price-per-unit' ).'</span>';
		$hide_sale=get_option('_mcmp_ppu_hide_sale_price')=='yes' ? true : false;
		switch ($product_type){
			case 'variable':
				//hide variable max price?
				$hide_max=get_option('_mcmp_ppu_var_hide_max_price')=='yes' ? true : false;
				if ($hide_max==true){
					//needles to remake the price?
					$variable_price_min=floatval($product->get_variation_price('min'));
					$price=wc_price($variable_price_min);
					}
				//fill prefix text for variables
				$var_prefix_text=get_option('_mcmp_ppu_var_prefix_text');
				$var_prefix_text=(empty($var_prefix_text)) ? '' : '<span class="woocommerce-Price-currencySymbol amount mcmp-variable-price-prefix">'.__($var_prefix_text, 'mcmp-price-per-unit' ).' '.'</span>';
			break;
			case 'simple':	
				if ($hide_sale==true && $product->is_on_sale()){
					$normal_price=floatval($product->get_price());
					$price=wc_price($normal_price);
				}
				$var_prefix_text='';
			break;
		}

		$prod_id=$product->id;
		//Determine whether to recalculate or not - depending also on override
		if (is_product() && $prod_id===$this->single_pr_id){
			//Single product page + is it That product or some widget product?
			$override=get_post_meta( $prod_id, '_mcmp_ppu_single_page_override', true );
			if (empty($override)){
				$behav=get_option( '_mcmp_ppu_single_page_behaviour' );
				$process_recalc=(!empty($behav)) ? true : false;
			}else{
				if ($override=='not'){
					$process_recalc=false;
				}else {
					$process_recalc=true;
					$behav=$override;
				}
			}
		} else {
			//Other pages
			$override=get_post_meta( $prod_id, '_mcmp_ppu_general_override', true );
			if (empty($override)){
				$behav=get_option( '_mcmp_ppu_general_behaviour' );
				$process_recalc=(!empty($behav)) ? true : false;
			}else{
				if ($override=='not'){
					$process_recalc=false;
				}else {
					$process_recalc=true;
					$behav=$override;
				}
			}
		}
		// Recalculate price
		if ($process_recalc==true){
			//Price recalculation
			$recalc_happened=false;
			$recalc_price=$price;
			switch ($product_type){
				case 'simple':
					if($product->has_weight()){
						$units=$product->get_weight();
						if ($units>0) {
							$normal_price=!empty($normal_price) ? $normal_price : floatval($product->get_price());
							$normal_price=wc_get_price_to_display($product,array('price'=> $normal_price));
							$normal_price=$normal_price/$units;
							$recalc_happened=true;
							if ($product->is_on_sale() && $hide_sale==false){
								$regular_price=floatval($product->get_regular_price());
								$regular_price=wc_get_price_to_display($product,array('price'=> $regular_price));
								$regular_price=$regular_price/$units;
								$recalc_price='<del>'.wc_price($regular_price).'</del><ins>'.wc_price($normal_price).'</ins>';
							}else{
								$recalc_price=wc_price($normal_price);
							}
						}
					}
					break;
				case 'variable':
					$variations= $product->get_available_variations();
					$weights=array_column($variations,'weight');
					$prices=array_column($variations,'display_price');
					$var_recalc_prices=array_filter(array_map(function($a,$b){ 
						$arr_weight=floatval($a);
						if ($arr_weight!= false and $arr_weight!=0) return $b/$arr_weight;},$weights,$prices));
					if(!empty($var_recalc_prices)){
						asort($var_recalc_prices);
						$recalc_happened=true;
						$variable_price_min=reset($var_recalc_prices);
						$recalc_price=wc_price($variable_price_min);
						if ($hide_max==false){
							$variable_price_max=end($var_recalc_prices);
							if ($variable_price_min!==$variable_price_max){
								$recalc_price.='–'.wc_price($variable_price_max);
							}
						}
					}
					break;
			}
			if ($behav=='replace'){
				$price=$recalc_price;
			} elseif($behav=='add'){
				if ($recalc_happened){
					$price.='</br>'.'<span class="mcmp_recalc_price_row">'.$recalc_price;
				} else {
					$price=$recalc_price; //Don't make double row if nothing happened
				}
			}
			//Additional text for recalculated price
			if($recalc_happened){
				$option_text = get_post_meta( $prod_id, '_mcmp_ppu_recalc_text_override', true );
				if (empty($option_text)){
					$option_text=get_option('_mcmp_ppu_recalc_text');
				}
				if (!empty($option_text)){
					$add_text='&nbsp;'.'<span class="woocommerce-Price-currencySymbol amount mcmp-recalc-price-suffix">'.__($option_text, 'mcmp-price-per-unit' ).'</span>'.$add_text;
				}
				if($behav=='add'){
					$add_text.='</span>';
				}
			} 
		}	
		return $var_prefix_text . $price . $add_text;
	}
} // END class mcmp_ppu
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // Instantiate the class
	$mcmp_ppu_obj = mcmp_PPU::get_instance();

}