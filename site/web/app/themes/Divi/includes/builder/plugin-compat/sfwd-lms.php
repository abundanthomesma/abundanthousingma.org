<?php
if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

/**
 * Compatibility for the LearnDash plugin.
 *
 * @since 4.3.4
 *
 * @link https://www.learndash.com/
 */
class ET_Builder_Plugin_Compat_LearnDash extends ET_Builder_Plugin_Compat_Base {
	/**
	 * Constructor.
	 *
	 * @since 4.3.4
	 */
	public function __construct() {
		$this->plugin_id = 'sfwd-lms/sfwd_lms.php';
		$this->init_hooks();
	}

	/**
	 * Hook methods to WordPress.
	 *
	 * @since 4.3.4
	 *
	 * @return void
	 */
	public function init_hooks() {
		// Bail if there's no version found.
		if ( ! $this->get_plugin_version() ) {
			return;
		}

		add_action( 'learndash-focus-header-before', array( $this, 'fire_learndash_compatibility_action' ) );
		add_action( 'learndash-focus-template-start', array( $this, 'maybe_inject_theme_builder_header' ) );
		add_action( 'learndash-focus-template-end', array( $this, 'maybe_inject_theme_builder_footer' ) );
	}

	/**
	 * Disable TB hooks for Divi and Extra.
	 *
	 * @since 4.3.4
	 */
	public function fire_learndash_compatibility_action() {
		/**
		 * Fires when LearnDash Focus mode is enabled for the current request.
		 *
		 * @since 4.3.4
		 */
		do_action( 'et_theme_builder_compatibility_learndash_focus_mode' );
	}

	/**
	 * Maybe inject the TB header back in.
	 *
	 * @since 4.3.4
	 */
	public function maybe_inject_theme_builder_header() {
		$layouts = et_theme_builder_get_template_layouts();

		if ( empty( $layouts ) ) {
			return;
		}

		et_theme_builder_frontend_render_header(
			$layouts[ ET_THEME_BUILDER_HEADER_LAYOUT_POST_TYPE ]['id'],
			$layouts[ ET_THEME_BUILDER_HEADER_LAYOUT_POST_TYPE ]['enabled'],
			$layouts[ ET_THEME_BUILDER_TEMPLATE_POST_TYPE ]
		);
	}

	/**
	 * Maybe inject the TB footer back in.
	 *
	 * @since 4.3.4
	 */
	public function maybe_inject_theme_builder_footer() {
		$layouts = et_theme_builder_get_template_layouts();

		if ( empty( $layouts ) ) {
			return;
		}

		et_theme_builder_frontend_render_footer(
			$layouts[ ET_THEME_BUILDER_FOOTER_LAYOUT_POST_TYPE ]['id'],
			$layouts[ ET_THEME_BUILDER_FOOTER_LAYOUT_POST_TYPE ]['enabled'],
			$layouts[ ET_THEME_BUILDER_TEMPLATE_POST_TYPE ]
		);
	}
}

new ET_Builder_Plugin_Compat_LearnDash;
