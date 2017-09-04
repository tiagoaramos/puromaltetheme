<?php
/**
 * Delete WooCommerce Unit Of Measure data if plugin is deleted.
 *
 * @since 1.0
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) :
	exit;
endif;
delete_post_meta_by_key( '_mcmp_ppu_general_override' );
delete_post_meta_by_key( '_mcmp_ppu_single_page_override' );
delete_post_meta_by_key( '_mcmp_ppu_recalc_text_override' );
