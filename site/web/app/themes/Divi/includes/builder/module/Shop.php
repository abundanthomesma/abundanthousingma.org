<?php

require_once 'helpers/Overlay.php';


class ET_Builder_Module_Shop extends ET_Builder_Module_Type_PostBased {

	function init() {
		$this->name       = esc_html__( 'Shop', 'et_builder' );
		$this->plural     = esc_html__( 'Shops', 'et_builder' );
		$this->slug       = 'et_pb_shop';
		$this->vb_support = 'on';

		$this->main_css_element = '%%order_class%%.et_pb_shop';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => et_builder_i18n( 'Content' ),
					'elements' => et_builder_i18n( 'Elements' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'overlay' => et_builder_i18n( 'Overlay' ),
					'image'   => et_builder_i18n( 'Image' ),
					'star'    => esc_html__( 'Star Rating', 'et_builder' ),
				),
			),
		);

		$this->advanced_fields = array(
			'fonts'                 => array(
				'title' => array(
					'label'    => et_builder_i18n( 'Title' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .woocommerce ul.products li.product h3, {$this->main_css_element} .woocommerce ul.products li.product h1, {$this->main_css_element} .woocommerce ul.products li.product h2, {$this->main_css_element} .woocommerce ul.products li.product h4, {$this->main_css_element} .woocommerce ul.products li.product h5, {$this->main_css_element} .woocommerce ul.products li.product h6",
						'hover' => "{$this->main_css_element} .woocommerce ul.products li.product h3:hover, {$this->main_css_element} .woocommerce ul.products li.product h1:hover, {$this->main_css_element} .woocommerce ul.products li.product h2:hover, {$this->main_css_element} .woocommerce ul.products li.product h4:hover, {$this->main_css_element} .woocommerce ul.products li.product h5:hover, {$this->main_css_element} .woocommerce ul.products li.product h6:hover, {$this->main_css_element} .woocommerce ul.products li.product h1.hover, {$this->main_css_element} .woocommerce ul.products li.product h2.hover, {$this->main_css_element} .woocommerce ul.products li.product h3.hover, {$this->main_css_element} .woocommerce ul.products li.product h4.hover, {$this->main_css_element} .woocommerce ul.products li.product h5.hover, {$this->main_css_element} .woocommerce ul.products li.product h6.hover",
						'important' => 'plugin_only',
					),
				),
				'price' => array(
					'label'    => esc_html__( 'Price', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .woocommerce ul.products li.product .price, {$this->main_css_element} .woocommerce ul.products li.product .price .amount",
						'hover' => "{$this->main_css_element} .woocommerce ul.products li.product .price:hover, {$this->main_css_element} .woocommerce ul.products li.product .price:hover .amount, {$this->main_css_element} .woocommerce ul.products li.product .price.hover, {$this->main_css_element} .woocommerce ul.products li.product .price.hover .amount",
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
				),
				'sale_badge' => array(
					'label'           => esc_html__( 'Sale Badge', 'et_builder' ),
					'css'             => array(
						'main'      => "{$this->main_css_element} .woocommerce ul.products li.product .onsale",
						'important' => array( 'line-height', 'font', 'text-shadow' ),
					),
					'hide_text_align' => true,
					'line_height'     => array(
						'default' => '1.3em',
					),
					'font_size'       => array(
						'default' => '20px',
					),
					'letter_spacing'  => array(
						'default' => '0px',
					),
				),
				'sale_price' => array(
					'label'           => esc_html__( 'Sale Price', 'et_builder' ),
					'css'             => array(
						'main' => "{$this->main_css_element} .woocommerce ul.products li.product .price ins .amount",
					),
					'hide_text_align' => true,
					'font'            => array(
						'default' => '|700|||||||',
					),
					'line_height'     => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
				),
				'rating'     => array(
					'label'            => esc_html__( 'Star Rating', 'et_builder' ),
					'css'              => array(
						'main'                 => '%%order_class%% .star-rating',
						'hover'                => '%%order_class%% li.product:hover .star-rating',
						'color'                => '%%order_class%% .star-rating > span:before',
						'color_hover'          => '%%order_class%% li.product:hover .star-rating > span:before',
						'letter_spacing_hover' => '%%order_class%% li.product:hover .star-rating',
						'important'            => array( 'size' ),
					),
					'font_size'        => array(
						'default' => '14px',
					),
					'hide_font'        => true,
					'hide_line_height' => true,
					'hide_text_shadow' => true,
					'text_align'       => array(
						'label' => esc_html__( 'Star Rating Alignment', 'et_builder' ),
					),
					'font_size'        => array(
						'label' => esc_html__( 'Star Rating Size', 'et_builder' ),
					),
					'text_color'       => array(
						'label' => esc_html__( 'Star Rating Color', 'et_builder' ),
					),
					'toggle_slug'      => 'star',
				),
			),
			'borders'               => array(
				'default' => array(),
				'image' => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .et_shop_image > img, {$this->main_css_element} .et_shop_image .et_overlay",
							'border_radii_hover'  => "{$this->main_css_element} .et_shop_image > img:hover, {$this->main_css_element} .et_shop_image .et_overlay",
							'border_styles' => "{$this->main_css_element} .et_shop_image > img",
						),
						'important' => 'all',
					),
					'label_prefix' => et_builder_i18n( 'Image' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'image',
				),
			),
			'box_shadow'            => array(
				'default' => array(),
				'image'   => array(
					'label'           => esc_html__( 'Image Box Shadow', 'et_builder' ),
					'option_category' => 'layout',
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'image',
					'css'             => array(
						'main'         => '%%order_class%%.et_pb_module .woocommerce .et_shop_image > img, %%order_class%%.et_pb_module .woocommerce .et_overlay',
						'overlay' => 'inset',
						'important' => true,
					),
					'default_on_fronts'  => array(
						'color'    => '',
						'position' => '',
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'main' => '%%order_class%%',
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'text'                  => array(
				'css' => array(
					'text_shadow' => implode(', ', array(
						// Title
						"{$this->main_css_element} .woocommerce ul.products h3",
						"{$this->main_css_element} .woocommerce ul.products  h1",
						"{$this->main_css_element} .woocommerce ul.products  h2",
						"{$this->main_css_element} .woocommerce ul.products  h4",
						"{$this->main_css_element} .woocommerce ul.products  h5",
						"{$this->main_css_element} .woocommerce ul.products  h6",
						// Price
						"{$this->main_css_element} .woocommerce ul.products .price",
						"{$this->main_css_element} .woocommerce ul.products .price .amount"

					) ),
				),
			),
			'filters'               => array(
				'child_filters_target' => array(
					'tab_slug' => 'advanced',
					'toggle_slug' => 'image',
				),
			),
			'image'                 => array(
				'css' => array(
					'main' => '%%order_class%% .et_shop_image',
				),
			),
			'scroll_effects'        => array(
				'grid_support' => 'yes',
			),
			'button'                => false,
		);

		$this->custom_css_fields = array(
			'product' => array(
				'label'    => esc_html__( 'Product', 'et_builder' ),
				'selector' => 'li.product',
			),
			'onsale' => array(
				'label'    => esc_html__( 'Onsale', 'et_builder' ),
				'selector' => 'li.product .onsale',
			),
			'image' => array(
				'label'    => et_builder_i18n( 'Image' ),
				'selector' => '.et_shop_image',
			),
			'overlay' => array(
				'label'    => et_builder_i18n( 'Overlay' ),
				'selector' => '.et_overlay',
			),
			'title' => array(
				'label'    => et_builder_i18n( 'Title' ),
				'selector' => $this->get_title_selector(),
			),
			'rating' => array(
				'label'    => esc_html__( 'Rating', 'et_builder' ),
				'selector' => '.star-rating',
			),
			'price' => array(
				'label'    => esc_html__( 'Price', 'et_builder' ),
				'selector' => 'li.product .price',
			),
			'price_old' => array(
				'label'    => esc_html__( 'Old Price', 'et_builder' ),
				'selector' => 'li.product .price del span.amount',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => 'O5RCEYP-qKI',
				'name' => esc_html__( 'An introduction to the Shop module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'type'                => array(
				'label'            => esc_html__( 'Product View Type', 'et_builder' ),
				'type'             => 'select',
				'option_category'  => 'basic_option',
				'options'          => array(
					'default'          => esc_html__( 'Default (Menu ordering + name)', 'et_builder' ),
					'latest'           => esc_html__( 'Latest Products', 'et_builder' ),
					'featured'         => esc_html__( 'Featured Products', 'et_builder' ),
					'sale'             => esc_html__( 'Sale Products', 'et_builder' ),
					'best_selling'     => esc_html__( 'Best Selling Products', 'et_builder' ),
					'top_rated'        => esc_html__( 'Top Rated Products', 'et_builder' ),
					'product_category' => esc_html__( 'Product Category', 'et_builder' ),
				),
				'default_on_front' => 'default',
				'affects'          => array(
					'include_categories',
				),
				'description'      => esc_html__( 'Choose which type of product view you would like to display.', 'et_builder' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__shop',
				),
			),
			'use_current_loop'    => array(
				'label'            => esc_html__( 'Use Current Page', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => esc_html__( 'Only include products for the current page. Useful on archive and index pages. For example let\'s say you used this module on a Theme Builder layout that is enabled for product categories. Selecting the "Sale Products" view type above and enabling this option would show only products that are on sale when viewing product categories.', 'et_builder' ),
				'toggle_slug'      => 'main_content',
				'default'          => 'off',
				'show_if'          => array(
					'function.isTBLayout' => 'on',
				),
				'show_if_not'      => array(
					'type' => 'product_category',
				),
				'computed_affects' => array(
					'__shop',
				),
			),
			'posts_number'        => array(
				'default'          => '12',
				'label'            => esc_html__( 'Product Count', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Define the number of products that should be displayed per page.', 'et_builder' ),
				'computed_affects' => array(
					'__shop',
				),
				'toggle_slug'      => 'main_content',
			),
			'show_pagination'     => array(
				'label'            => esc_html__( 'Show Pagination', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default'          => 'off',
				'description'      => esc_html__( 'Turn pagination on and off.', 'et_builder' ),
				'computed_affects' => array(
					'__shop',
				),
				'toggle_slug'      => 'elements',
				'mobile_options'   => true,
				'hover'            => 'tabs',
			),
			'include_categories'  => array(
				'label'            => esc_html__( 'Included Categories', 'et_builder' ),
				'type'             => 'categories',
				'meta_categories'  => array(
					'all'     => esc_html__( 'All Categories', 'et_builder' ),
					'current' => esc_html__( 'Current Category', 'et_builder' ),
				),
				'renderer_options' => array(
					'use_terms' => true,
					'term_name' => 'product_cat',
				),
				'depends_show_if'  => 'product_category',
				'description'      => esc_html__( 'Choose which categories you would like to include.', 'et_builder' ),
				'taxonomy_name'    => 'product_cat',
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__shop',
				),
			),
			'columns_number'      => array(
				'label'            => esc_html__( 'Column Layout', 'et_builder' ),
				'type'             => 'select',
				'option_category'  => 'layout',
				'options'          => array(
					'0' => esc_html__( 'default', 'et_builder' ),
					'6' => sprintf( esc_html__( '%1$s Columns', 'et_builder' ), esc_html( '6' ) ),
					'5' => sprintf( esc_html__( '%1$s Columns', 'et_builder' ), esc_html( '5' ) ),
					'4' => sprintf( esc_html__( '%1$s Columns', 'et_builder' ), esc_html( '4' ) ),
					'3' => sprintf( esc_html__( '%1$s Columns', 'et_builder' ), esc_html( '3' ) ),
					'2' => sprintf( esc_html__( '%1$s Columns', 'et_builder' ), esc_html( '2' ) ),
					'1' => esc_html__( '1 Column', 'et_builder' ),
				),
				'default_on_front' => '0',
				'description'      => esc_html__( 'Choose how many columns to display.', 'et_builder' ),
				'computed_affects' => array(
					'__shop',
				),
				'toggle_slug'      => 'main_content',
			),
			'orderby'             => array(
				'label'            => esc_html__( 'Order', 'et_builder' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'default'    => esc_html__( 'Default Sorting', 'et_builder' ),
					'menu_order' => esc_html__( 'Sort by Menu Order', 'et_builder' ),
					'popularity' => esc_html__( 'Sort By Popularity', 'et_builder' ),
					'rating'     => esc_html__( 'Sort By Rating', 'et_builder' ),
					'date'       => esc_html__( 'Sort By Date: Oldest To Newest', 'et_builder' ),
					'date-desc'  => esc_html__( 'Sort By Date: Newest To Oldest', 'et_builder' ),
					'price'      => esc_html__( 'Sort By Price: Low To High', 'et_builder' ),
					'price-desc' => esc_html__( 'Sort By Price: High To Low', 'et_builder' ),
				),
				'default_on_front' => 'default',
				'description'      => esc_html__( 'Choose how your products should be ordered.', 'et_builder' ),
				'computed_affects' => array(
					'__shop',
				),
				'toggle_slug'      => 'main_content',
				'show_if_not'      => array(
					'type' => 'latest',
				),
			),
			'sale_badge_color'    => array(
				'label'          => esc_html__( 'Sale Badge Color', 'et_builder' ),
				'description'    => esc_html__( 'Pick a color to use for the sales bade that appears on products that are on sale.', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'sale_badge',
				'hover'          => 'tabs',
				'mobile_options' => true,
			),
			'icon_hover_color'    => array(
				'label'          => esc_html__( 'Overlay Icon Color', 'et_builder' ),
				'description'    => esc_html__( 'Pick a color to use for the icon that appears when hovering over a product.', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'overlay',
				'mobile_options' => true,
			),
			'hover_overlay_color' => array(
				'label'          => esc_html__( 'Overlay Background Color', 'et_builder' ),
				'description'    => esc_html__( 'Here you can define a custom color for the overlay', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'overlay',
				'mobile_options' => true,
			),
			'hover_icon'          => array(
				'label'           => esc_html__( 'Overlay Icon', 'et_builder' ),
				'description'     => esc_html__( 'Here you can define a custom icon for the overlay', 'et_builder' ),
				'type'            => 'select_icon',
				'option_category' => 'configuration',
				'class'           => array( 'et-pb-font-icon' ),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'overlay',
				'mobile_options'  => true,
			),
			'__shop'              => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'ET_Builder_Module_Shop', 'get_shop_html' ),
				'computed_depends_on' => array(
					'type',
					'include_categories',
					'posts_number',
					'orderby',
					'columns_number',
					'show_pagination',
					'__page',
					'use_current_loop',
				),
				'computed_minimum'    => array(
					'posts_number',
					'show_pagination',
					'__page',
					'use_current_loop',
				),
			),
			'__page'              => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'ET_Builder_Module_Shop', 'get_shop_html' ),
				'computed_depends_on' => array(
					'type',
					'include_categories',
					'posts_number',
					'orderby',
					'columns_number',
					'show_pagination',
				),
				'computed_affects'    => array(
					'__shop',
				),
			),
		);

		return $fields;
	}

	/**
	 * @inheritdoc
	 *
	 * @since 4.0.6 Handle star rating letter spacing.
	 */
	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();

		$fields['sale_badge_color']      = array( 'background-color' => '%%order_class%% span.onsale' );
		$fields['rating_letter_spacing'] = array(
			'width'          => '%%order_class%% .star-rating',
			'letter-spacing' => '%%order_class%% .star-rating',
		);

		$is_hover_enabled = et_builder_is_hover_enabled( 'rating_letter_spacing', $this->props )
			|| et_builder_is_hover_enabled( 'rating_font_size', $this->props );

		if ( $is_hover_enabled && isset( $fields['rating_text_color'] ) ) {
			unset( $fields['rating_text_color'] );
		}

		return $fields;
	}

	function add_product_class_name( $classes ) {
		$classes[] = 'product';

		return $classes;
	}

	function get_shop( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		foreach ( $args as $arg => $value ) {
			$this->props[ $arg ] = $value;
		}

		$post_id            = isset( $current_page['id'] ) ? (int) $current_page['id'] : 0;
		$type               = $this->props['type'];
		$posts_number       = $this->props['posts_number'];
		$orderby            = 'default' === $type ? 'id' : $this->props['orderby'];
		$order              = 'default' === $type ? 'DESC' : 'ASC';
		$columns            = $this->props['columns_number'];
		$pagination         = 'on' === $this->prop( 'show_pagination', 'off' );
		$product_categories = array();
		$product_tags       = array();
		$use_current_loop   = 'on' === $this->prop( 'use_current_loop', 'off' );
		$use_current_loop   = $use_current_loop && ( is_post_type_archive( 'product' ) || is_search() || et_is_product_taxonomy() );
		$product_attribute  = '';
		$product_terms      = array();

		if ( $use_current_loop ) {
			$this->props['include_categories'] = 'all';

			if ( is_product_category() ) {
				$this->props['include_categories'] = (string) get_queried_object_id();
			} else if ( is_product_tag() ) {
				$product_tags = array( get_queried_object()->slug );
			} else if ( is_product_taxonomy() ) {
				$term = get_queried_object();

				// Product attribute taxonomy slugs start with pa_
				if ( et_()->starts_with( $term->taxonomy, 'pa_' ) ) {
					$product_attribute = $term->taxonomy;
					$product_terms[]   = $term->slug;
				}
			}
		}

		if ( 'product_category' === $type || ( $use_current_loop && ! empty( $this->props['include_categories'] ) ) ) {
			$all_shop_categories     = et_builder_get_shop_categories();
			$all_shop_categories_map = array();
			$raw_product_categories  = self::filter_include_categories( $this->props['include_categories'], $post_id, 'product_cat' );

			foreach ( $all_shop_categories as $term ) {
				if ( is_object( $term ) && is_a( $term, 'WP_Term' ) ) {
					$all_shop_categories_map[ $term->term_id ] = $term->slug;
				}
			}

			$product_categories = array_values( $all_shop_categories_map );

			if ( ! empty( $raw_product_categories ) ) {
				$product_categories = array_intersect_key(
					$all_shop_categories_map,
					array_flip( $raw_product_categories )
				);
			}
		}

		// Recent was the default option in Divi once, so it is added here for the websites created before the change
		if ( 'default' === $orderby && ( 'default' === $type || 'recent' === $type ) ) {
			// Leave the attribute empty to allow WooCommerce to take over and use the default sorting.
			$orderby = '';
		}

		if ( 'latest' === $type ) {
			$orderby = 'date-desc';
		}

		if ( in_array( $orderby, array( 'price-desc', 'date-desc' ) ) ) {
			// Supported orderby arguments (as defined by WC_Query->get_catalog_ordering_args() ):
			//   rand | date | price | popularity | rating | title
			$orderby = str_replace( '-desc', '', $orderby );
			// Switch to descending order if orderby is 'price-desc' or 'date-desc'
			$order = 'DESC';
		}

		$ids             = array();
		$wc_custom_view  = '';
		$wc_custom_views = array(
			'sale'         => array( 'on_sale', 'true' ),
			'best_selling' => array( 'best_selling', 'true' ),
			'top_rated'    => array( 'top_rated', 'true' ),
			'featured'     => array( 'visibility', 'featured' ),
		);

		if ( et_()->includes( array_keys( $wc_custom_views ), $type ) ) {
			$custom_view_data = $wc_custom_views[ $type ];
			$wc_custom_view   = sprintf( '%1$s="%2$s"', esc_attr( $custom_view_data[0] ), esc_attr( $custom_view_data[1] ) );
		}

		$shortcode = sprintf(
			'[products %1$s limit="%2$s" orderby="%3$s" columns="%4$s" %5$s order="%6$s" %7$s %8$s %9$s %10$s %11$s]',
			et_core_intentionally_unescaped( $wc_custom_view, 'fixed_string' ),
			esc_attr( $posts_number ),
			esc_attr( $orderby ),
			esc_attr( $columns ),
			$product_categories ? sprintf( 'category="%s"', esc_attr( implode( ',', $product_categories ) ) ) : '',
			esc_attr( $order ),
			$pagination ? 'paginate="true"' : '',
			$ids ? sprintf( 'ids="%s"', esc_attr( implode( ',', $ids ) ) ) : '',
			$product_tags ? sprintf( 'tag="%s"', esc_attr( implode( ',', $product_tags ) ) ) : '',
			$product_attribute ? sprintf( 'attribute="%s"', esc_attr( $product_attribute ) ) : '',
			$product_terms ? sprintf( 'terms="%s"', esc_attr( implode( ',', $product_terms ) ) ) : ''
		);

		do_action( 'et_pb_shop_before_print_shop' );

		global $wp_the_query;

		$query_backup = $wp_the_query;

		if ( $use_current_loop ) {
			add_filter( 'woocommerce_shortcode_products_query', array( $this, 'filter_products_query' ) );
			add_action( 'pre_get_posts', array( $this, 'apply_woo_widget_filters' ), 0 );
		}

		$shop = do_shortcode( $shortcode );

		if ( $use_current_loop ) {
			remove_action( 'pre_get_posts', array( $this, 'apply_woo_widget_filters' ), 0 );
			remove_filter( 'woocommerce_shortcode_products_query', array( $this, 'filter_products_query' ) );
		}

		$wp_the_query = $query_backup;

		do_action( 'et_pb_shop_after_print_shop' );

		if ( '<div class="woocommerce columns-0"></div>' === $shop || et_()->starts_with( $shop, $shortcode ) ) {
			$shop = self::get_no_results_template();
		}

		return $shop;
	}

	/**
	 * Get shop HTML for shop module
	 *
	 * @param array   arguments that affect shop output
	 * @param array   passed conditional tag for update process
	 * @param array   passed current page params
	 * @return string HTML markup for shop module
	 */
	static function get_shop_html( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		$shop = new self();

		do_action( 'et_pb_get_shop_html_before' );

		$shop->props = $args;

		// Force product loop to have 'product' class name. It appears that 'product' class disappears
		// when $this->get_shop() is being called for update / from admin-ajax.php
		add_filter( 'post_class', array( $shop, 'add_product_class_name' ) );

		// Get product HTML
		$output = $shop->get_shop( array(), array(), $current_page );

		// Remove 'product' class addition to product loop's post class
		remove_filter( 'post_class', array( $shop, 'add_product_class_name' ) );

		do_action( 'et_pb_get_shop_html_after' );

		return $output;
	}


	// WooCommerce changed the title tag from h3 to h2 in 3.0.0
	function get_title_selector() {
		$title_selector = 'li.product h3';

		if ( class_exists( 'WooCommerce' ) ) {
			global $woocommerce;

			if ( version_compare( $woocommerce->version, '3.0.0', '>=' ) ) {
				$title_selector = 'li.product h2';
			}
		}

		return $title_selector;
	}

	function render( $attrs, $content = null, $render_slug ) {
		$type                    = $this->props['type'];
		$include_categories      = $this->props['include_categories'];
		$posts_number            = $this->props['posts_number'];
		$orderby                 = $this->props['orderby'];
		$columns                 = $this->props['columns_number'];

		$video_background          = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$sale_badge_color_hover    = $this->get_hover_value( 'sale_badge_color' );
		$sale_badge_color_values   = et_pb_responsive_options()->get_property_values( $this->props, 'sale_badge_color' );
		$icon_hover_color_values   = et_pb_responsive_options()->get_property_values( $this->props, 'icon_hover_color' );
		$hover_overlay_color_value = et_pb_responsive_options()->get_property_values( $this->props, 'hover_overlay_color' );

		$hover_icon                = $this->props['hover_icon'];
		$hover_icon_values         = et_pb_responsive_options()->get_property_values( $this->props, 'hover_icon' );
		$hover_icon_tablet         = isset( $hover_icon_values['tablet'] ) ? $hover_icon_values['tablet'] : '';
		$hover_icon_phone          = isset( $hover_icon_values['phone'] ) ? $hover_icon_values['phone'] : '';

		// Sale Badge Color.
		et_pb_responsive_options()->generate_responsive_css( $sale_badge_color_values, '%%order_class%% span.onsale', 'background-color', $render_slug, ' !important;', 'color' );

		if ( et_builder_is_hover_enabled( 'sale_badge_color', $this->props ) ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%%:hover span.onsale',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $sale_badge_color_hover )
				),
			) );
		}

		// Icon Hover Color.
		et_pb_responsive_options()->generate_responsive_css( $icon_hover_color_values, '%%order_class%% .et_overlay:before', 'color', $render_slug, ' !important;', 'color' );

		// Hover Overlay Color.
		et_pb_responsive_options()->generate_responsive_css( $hover_overlay_color_value, '%%order_class%% .et_overlay', array( 'background-color', 'border-color' ), $render_slug, ' !important;', 'color' );

		// Images: Add CSS Filters and Mix Blend Mode rules (if set)
		if ( array_key_exists( 'image', $this->advanced_fields ) && array_key_exists( 'css', $this->advanced_fields['image'] ) ) {
			$this->add_classname( $this->generate_css_filters(
				$render_slug,
				'child_',
				self::$data_utils->array_get( $this->advanced_fields['image']['css'], 'main', '%%order_class%%' )
			) );
		}

		$overlay_attributes = ET_Builder_Module_Helper_Overlay::render_attributes( array(
			'icon'        => $hover_icon,
			'icon_tablet' => $hover_icon_tablet,
			'icon_phone'  => $hover_icon_phone,
		) );

		if ( class_exists( 'ET_Builder_Module_Helper_Woocommerce_Modules' ) ) {
			ET_Builder_Module_Helper_Woocommerce_Modules::add_star_rating_style(
				$render_slug,
				$this->props,
				'%%order_class%% ul.products li.product .star-rating',
				'%%order_class%% ul.products li.product:hover .star-rating'
			);
		}

		// Module classnames
		$this->add_classname( array(
			$this->get_text_orientation_classname(),
		) );

		if ( '0' === $columns ) {
			$this->add_classname( 'et_pb_shop_grid' );
		}

		$shop_order = self::_get_index( array( self::INDEX_MODULE_ORDER, $render_slug ) );

		$output = sprintf(
			'<div%2$s class="%3$s" %6$s data-shortcode_index="%7$s">
				%5$s
				%4$s
				%1$s
			</div>',
			$this->get_shop( array(), array(), array( 'id' => $this->get_the_ID() ) ),
			$this->module_id(),
			$this->module_classname( $render_slug ),
			$video_background,
			$parallax_image_background,
			et_core_esc_previously( $overlay_attributes ),
			esc_attr( $shop_order )
		);

		return $output;
	}

	/**
	 * Filter the products query arguments.
	 *
	 * @since 4.0.5
	 *
	 * @param array $query_args
	 *
	 * @return array
	 */
	public function filter_products_query( $query_args ) {
		if ( is_search() ) {
			$query_args['s'] = get_search_query();
		}

		if ( function_exists( 'WC' ) ) {
			$query_args['meta_query'] = WC()->query->get_meta_query( et_()->array_get( $query_args, 'meta_query', array() ), true );
			$query_args['tax_query'] = WC()->query->get_tax_query( et_()->array_get( $query_args, 'tax_query', array() ), true );

			// Add fake cache-busting arguments as the filtering is actually done in self::apply_woo_widget_filters().
			$query_args['et_builder_filter_min_price'] = sanitize_text_field( et_()->array_get( $_GET, 'min_price', '' ) );
			$query_args['et_builder_filter_max_price'] = sanitize_text_field( et_()->array_get( $_GET, 'max_price', '' ) );
		}

		return $query_args;
	}

	/**
	 * Filter the products shortcode query so Woo widget filters apply.
	 *
	 * @since 4.0.8
	 *
	 * @param WP_Query $query
	 */
	public function apply_woo_widget_filters( $query ) {
		global $wp_the_query;

		// Trick Woo filters into thinking the products shortcode query is the
		// main page query as some widget filters have is_main_query checks.
		$wp_the_query = $query;

		// Set a flag to track that the main query is falsified.
		$wp_the_query->et_pb_shop_query = true;

		if ( function_exists( 'WC' ) ) {
			add_filter( 'posts_clauses', array( WC()->query, 'price_filter_post_clauses' ), 10, 2 );
		}
	}
}

new ET_Builder_Module_Shop;
