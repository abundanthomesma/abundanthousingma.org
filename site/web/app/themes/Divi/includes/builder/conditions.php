<?php
/**
 * Utility functions for checking conditions.
 *
 * To be included in this file a function must:
 *
 *   * Return a bool value
 *   * Have a name that asks a yes or no question (where the first word after
 *     the et_ prefix is a word like: is, can, has, should, was, had, must, or will)
 *
 * @since 4.0.7
 *
 */

/* Function Template

if ( ! function_exists( '' ) ):
function et_builder_() {

}
endif;

*/

// Note: Functions in this file are sorted alphabetically.

if ( ! function_exists( 'et_builder_is_loading_data' ) ):
function et_builder_is_loading_data( $type = 'vb' ) {
	if ( 'bb' === $type ) {
		return 'et_pb_get_backbone_templates' === et_()->array_get( $_POST, 'action' );
	}

	$data_actions = array(
		'et_fb_retrieve_builder_data',
		'et_fb_update_builder_assets',
	);

	return isset( $_POST['action'] ) && in_array( $_POST['action'], $data_actions );
}
endif;

if ( ! function_exists( 'et_builder_should_load_all_data' ) ):
function et_builder_should_load_all_data() {
	$needs_cached_definitions = et_core_is_fb_enabled() && ! et_fb_dynamic_asset_exists( 'definitions' );

	return $needs_cached_definitions || ( ET_Builder_ELement::is_saving_cache() || et_builder_is_loading_data() );
}
endif;

// Note: Functions in this file are sorted alphabetically.
