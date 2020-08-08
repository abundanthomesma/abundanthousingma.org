<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}


/**
 * Background helper methods.
 * This is abstraction of `ET_Builder_Element->process_advanced_background_options()` method which is
 * intended for module that needs to extend module background mechanism with few modification
 * (eg. post slider which needs to apply module background on individual slide that has featured
 * image).
 *
 * @since 4.3.3
 *
 * @todo Use `ET_Builder_Module_Helper_Background->get_background_style()` for `ET_Builder_Element->process_advanced_background_options()`
 *
 * Class ET_Builder_Module_Helper_Background
 */
class ET_Builder_Module_Helper_Background {
	public static function instance() {
		static $instance;

		return $instance ? $instance : $instance = new self();
	}

	/**
	 * Get gradient properties based on given props
	 *
	 * @since 4.3.3
	 *
	 * @param array $props           Module's props
	 * @param string $base_prop_name Background base prop name
	 * @param string $suffix         Background base prop name's suffix
	 *
	 * @return array
	 */
	function get_gradient_properties( $props, $base_prop_name, $suffix ) {
		return array(
			'type'             => et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_type{$suffix}", '', true ),
			'direction'        => et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_direction{$suffix}", '', true ),
			'radial_direction' => et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_direction_radial{$suffix}", '', true ),
			'color_start'      => et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_start{$suffix}", '', true ),
			'color_end'        => et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_end{$suffix}", '', true ),
			'start_position'   => et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_start_position{$suffix}", '', true ),
			'end_position'     => et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_end_position{$suffix}", '', true ),
		);
	}

	/**
	 * Get gradient properties for hover mode
	 *
	 * @since 4.3.3
	 *
	 * @param array $props                       Module's props
	 * @param string $base_prop_name             Background base prop name
	 * @param array $gradient_properties_desktop {
	 *     @type string $type
	 *     @type string $direction
	 *     @type string $radial_direction
	 *     @type string $color_start
	 *     @type string $color_end
	 *     @type string $start_position
	 *     @type string $end_position
	 * }
	 *
	 * @return array
	 */
	function get_gradient_hover_properties( $props, $base_prop_name, $gradient_properties_desktop = array() ) {
		// Desktop value as default.
		$gradient_type_desktop             = et_()->array_get( $gradient_properties_desktop, 'type', '' );
		$gradient_direction_desktop        = et_()->array_get( $gradient_properties_desktop, 'direction', '' );
		$gradient_radial_direction_desktop = et_()->array_get( $gradient_properties_desktop, 'radial_direction', '' );
		$gradient_color_start_desktop      = et_()->array_get( $gradient_properties_desktop, 'color_start', '' );
		$gradient_color_end_desktop        = et_()->array_get( $gradient_properties_desktop, 'color_end', '' );
		$gradient_start_position_desktop   = et_()->array_get( $gradient_properties_desktop, 'start_position', '' );
		$gradient_end_position_desktop     = et_()->array_get( $gradient_properties_desktop, 'end_position', '' );
		$gradient_overlays_image_desktop   = et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_overlays_image", '', true );

		// Hover value.
		$gradient_type_hover             = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_color_gradient_type", $props, $gradient_type_desktop );
		$gradient_direction_hover        = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_color_gradient_direction", $props, $gradient_direction_desktop );
		$gradient_direction_radial_hover = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_color_gradient_direction_radial", $props, $gradient_radial_direction_desktop );
		$gradient_start_hover            = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_color_gradient_start", $props, $gradient_color_start_desktop );
		$gradient_end_hover              = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_color_gradient_end", $props, $gradient_color_end_desktop );
		$gradient_start_position_hover   = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_color_gradient_start_position", $props, $gradient_start_position_desktop );
		$gradient_end_position_hover     = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_color_gradient_end_position", $props, $gradient_end_position_desktop );
		$gradient_overlays_image_hover   = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_color_gradient_overlays_image", $props, $gradient_overlays_image_desktop );

		return array(
			'type'             => '' !== $gradient_type_hover             ? $gradient_type_hover : $gradient_type_desktop,
			'direction'        => '' !== $gradient_direction_hover        ? $gradient_direction_hover : $gradient_direction_desktop,
			'radial_direction' => '' !== $gradient_direction_radial_hover ? $gradient_direction_radial_hover : $gradient_radial_direction_desktop,
			'color_start'      => '' !== $gradient_start_hover            ? $gradient_start_hover : $gradient_color_start_desktop,
			'color_end'        => '' !== $gradient_end_hover              ? $gradient_end_hover : $gradient_color_end_desktop,
			'start_position'   => '' !== $gradient_start_position_hover   ? $gradient_start_position_hover : $gradient_start_position_desktop,
			'end_position'     => '' !== $gradient_end_position_hover     ? $gradient_end_position_hover : $gradient_end_position_desktop,
		);
	}

	/**
	 * Get background gradient style based on properties given
	 *
	 * @since 4.3.3
	 *
	 * @param array $args {
	 *     @type string $type
	 *     @type string $direction
	 *     @type string $radial_direction
	 *     @type string $color_start
	 *     @type string $color_end
	 *     @type string $start_position
	 *     @type string $end_position
	 * }
	 *
	 * @return string
	 */
	function get_gradient_style( $args ) {
		$defaults = apply_filters( 'et_pb_default_gradient', array(
			'type'             => ET_Global_Settings::get_value( 'all_background_gradient_type' ),
			'direction'        => ET_Global_Settings::get_value( 'all_background_gradient_direction' ),
			'radial_direction' => ET_Global_Settings::get_value( 'all_background_gradient_direction_radial' ),
			'color_start'      => ET_Global_Settings::get_value( 'all_background_gradient_start' ),
			'color_end'        => ET_Global_Settings::get_value( 'all_background_gradient_end' ),
			'start_position'   => ET_Global_Settings::get_value( 'all_background_gradient_start_position' ),
			'end_position'     => ET_Global_Settings::get_value( 'all_background_gradient_end_position' ),
		) );

		$args           = wp_parse_args( array_filter( $args ), $defaults );
		$direction      = 'linear' === $args['type'] ? $args['direction'] : "circle at {$args['radial_direction']}";
		$start_position = et_sanitize_input_unit( $args['start_position'], false, '%' );
		$end_Position   = et_sanitize_input_unit( $args['end_position'], false, '%');

		return esc_html( "{$args['type']}-gradient(
			{$direction},
			{$args['color_start']} ${start_position},
			{$args['color_end']} ${end_Position}
		)" );
	}

	/**
	 * Get individual background image style
	 *
	 * @since 4.3.3
	 *
	 * @param string $attr                 Background attribute name
	 * @param string $base_prop_name       Base background prop name
	 * @param string $suffix               Attribute name suffix
	 * @param array  $props                Module props
	 * @param array  $fields_definition    Module's fields definition
	 * @param bool   $is_prev_image_active Whether previous background image is active or not
	 *
	 * @return string
	 */
	function get_image_style( $attr, $base_prop_name, $suffix = '', $props = array(), $fields_definition = array(), $is_prev_image_active = true ) {
		// Get default style
		$default = et_()->array_get( $fields_definition, "{$base_prop_name}_{$attr}.default", '' );

		// Get style
		$style   = et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_{$attr}{$suffix}", $default, ! $is_prev_image_active );

		return $style;
	}

	/**
	 * Get background UI option's style based on given props and prop name
	 *
	 * @since 4.3.3
	 *
	 * @todo Further simplify this method; Break it down into more encapsulated methods
	 *
	 * @param array $args {
	 *     @type string $base_prop_name
	 *     @type array  $props
	 *     @type string $important
	 *     @type array  $fields_Definition
	 *     @type string $selector
	 *     @type string $selector_hover
	 *     @type number $priority
	 *     @type string $function_name
	 *     @type bool   $has_background_color_toggle
	 *     @type bool   $use_background_color
	 *     @type bool   $use_background_color_gradient
	 *     @type bool   $use_background_image
	 *     @type bool   $use_background_video
	 *     @type bool   $use_background_color_reset
	 * }
	 */
	function get_background_style( $args = array() ) {
		// Default settings
		$defaults = array(
			'base_prop_name'                => 'background',
			'props'                         => array(),
			'important'                     => '',
			'fields_definition'             => array(),
			'selector'                      => '',
			'selector_hover'                => '',
			'priority'                      => '',
			'function_name'                 => '',
			'has_background_color_toggle'   => false,
			'use_background_color'          => true,
			'use_background_color_gradient' => true,
			'use_background_image'          => true,
			'use_background_video'          => true,
			'use_background_color_reset'    => true,
		);

		// Parse arguments
		$args = wp_parse_args( $args, $defaults );

		// Break argument into variables
		$base_prop_name    = $args['base_prop_name'];
		$props             = $args['props'];
		$important         = $args['important'];
		$fields_definition = $args['fields_definition'];
		$selector          = $args['selector'];
		$selector_hover    = $args['selector_hover'];
		$priority          = $args['priority'];
		$function_name     = $args['function_name'];

		// Possible values for use_background_* variables are true, false, or 'fields_only'
		$has_color_toggle_options = $args['has_background_color_toggle'];
		$use_gradient_options     = $args['use_background_color_gradient'];
		$use_image_options        = $args['use_background_image'];
		$use_color_options        = $args['use_background_color'];
		$use_color_reset_options  = $args['use_background_color_reset'];

		// Save processed background. These will be compared with the smaller device background
		// processed value to avoid rendering the same styles.
		$processed_color                 = '';
		$processed_image                 = '';
		$gradient_properties_desktop     = array();
		$processed_image_blend           = '';
		$gradient_overlays_image_desktop = 'off';

		// Store background images status because the process is extensive.
		$image_status = array(
			'desktop' => false,
			'tablet'  => false,
			'phone'   => false,
		);

		// Background Desktop, Tablet, and Phone.
		foreach ( et_pb_responsive_options()->get_modes() as $device ) {
			$is_desktop = 'desktop' === $device;
			$suffix     = ! $is_desktop ? "_{$device}" : '';
			$style      = '';

			// Conditionals
			$has_gradient           = false;
			$has_image              = false;
			$has_gradient_and_image = false;
			$is_gradient_disabled   = false;
			$is_image_disabled      = false;

			// Ensure responsive settings is enabled on mobile.
			if ( ! $is_desktop && ! et_pb_responsive_options()->is_responsive_enabled( $props, $base_prop_name ) ) {
				continue;
			}

			// Styles output
			$image_style             = '';
			$color_style             = '';
			$images                  = array();
			$gradient_overlays_image = 'off';

			// A. Background Gradient.
			if ( $use_gradient_options && 'fields_only' !== $use_gradient_options ) {
				$use_gradient = et_pb_responsive_options()->get_inheritance_background_value( $props, "use_{$base_prop_name}_color_gradient", $device, $base_prop_name, $fields_definition );

				// 1. Ensure gradient color is active.
				if ( 'on' === $use_gradient ) {
					$gradient_overlays_image = et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_overlays_image{$suffix}", '', true );
					$gradient_properties     = $this->get_gradient_properties( $props, $base_prop_name, $suffix );

					// Will be used as default of Gradient hover.
					if ( $is_desktop ) {
						$gradient_properties_desktop     = $gradient_properties;
						$gradient_overlays_image_desktop = $gradient_overlays_image;
					}

					// Save background gradient into background images list.
					$background_gradient = $this->get_gradient_style( $gradient_properties );
					$images[] = $background_gradient;

					// Flag to inform Background Color if current module has Gradient.
					$has_gradient = true;
				} else if ( 'off' === $use_gradient ) {
					$is_gradient_disabled = true;
				}
			}

			// B. Background Image.
			if ( $use_image_options && 'fields_only' !== $use_image_options ) {
				$image    = et_pb_responsive_options()->get_inheritance_background_value( $props, "{$base_prop_name}_image", $device, $base_prop_name, $fields_definition );
				$parallax = et_pb_responsive_options()->get_any_value( $props, "parallax{$suffix}", 'off' );

				// Background image and parallax status.
				$is_image_active         = '' !== $image && 'on' !== $parallax;
				$image_status[ $device ] = $is_image_active;

				// 1. Ensure image exists and parallax is off.
				if ( $is_image_active ) {
					// Flag to inform Background Color if current module has Image.
					$has_image = true;

					// Check previous Background image status. Needed to get the correct value.
					$is_prev_image_active = true;

					if ( ! $is_desktop ) {
						$is_prev_image_active = 'tablet' === $device ?
							$image_status['desktop'] :
							$image_status['tablet'];
					}

					// Size.
					$image_size = $this->get_image_style( 'size', $base_prop_name, $suffix, $props, $fields_definition, $is_prev_image_active );

					if ( '' !== $image_size ) {
						$style .= sprintf( 'background-size: %1$s; ', esc_html( $image_size ) );
					}

					// Position.
					$image_position = $this->get_image_style( 'position', $base_prop_name, $suffix, $props, $fields_definition, $is_prev_image_active );

					if ( '' !== $image_position ) {
						$style .= sprintf(
							'background-position: %1$s; ',
							esc_html( str_replace( '_', ' ', $image_position ) )
						);
					}

					// Repeat.
					$image_repeat = $this->get_image_style( 'repeat', $base_prop_name, $suffix, $props, $fields_definition, $is_prev_image_active );

					if ( '' !== $image_repeat ) {
						$style .= sprintf( 'background-repeat: %1$s; ', esc_html( $image_repeat ) );
					}

					// Blend.
					$image_blend         = $this->get_image_style( 'blend', $base_prop_name, $suffix, $props, $fields_definition, $is_prev_image_active );
					$image_blend_inherit = et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_blend{$suffix}", '', true );
					$image_blend_default = et_()->array_get( $fields_definition, "{$base_prop_name}_blend.default", '' );

					if ( '' !== $image_blend_inherit ) {
						// Don't print the same image blend style.
						if ( '' !== $image_blend ) {
							$style .= sprintf( 'background-blend-mode: %1$s; ', esc_html( $image_blend ) );
						}

						// Reset - If background has image and gradient, force background-color: initial.
						if ( $has_gradient && $has_image && $use_color_reset_options !== 'fields_only' && $image_blend_inherit !== $image_blend_default ) {
							$has_gradient_and_image = true;
							$color_style            = 'initial';

							$style                 .= sprintf( 'background-color: initial%1$s; ', esc_html( $important ) );
						}

						$processed_image_blend = $image_blend;
					}

					// Only append background image when the image is exist.
					$images[] = sprintf( 'url(%1$s)', esc_html( $image ) );
				} else if ( '' === $image ) {
					// Reset - If background image is disabled, ensure we reset prev background blend mode.
					if ( '' !== $processed_image_blend ) {
						$style .= 'background-blend-mode: normal; ';
						$processed_image_blend = '';
					}

					$is_image_disabled = true;
				}
			}

			if ( ! empty( $images ) ) {
				// The browsers stack the images in the opposite order to what you'd expect.
				if ( 'on' !== $gradient_overlays_image ) {
					$images = array_reverse( $images );
				}

				// Set background image styles only it's different compared to the larger device.
				$image_style = join( ', ', $images );
				if ( $processed_image !== $image_style ) {
					$style .= sprintf(
						'background-image: %1$s%2$s;',
						esc_html( $image_style ),
						$important
					);
				}
			} else if ( ! $is_desktop && $is_gradient_disabled && $is_image_disabled ) {
				// Reset - If background image and gradient are disabled, reset current background image.
				$image_style = 'initial';

				$style .= sprintf(
					'background-image: %1$s%2$s;',
					esc_html( $image_style ),
					$important
				);
			}

			// Save processed background images.
			$processed_image = $image_style;

			// C. Background Color.
			if ( $use_color_options && 'fields_only' !== $use_color_options ) {

				$use_color_value = et_pb_responsive_options()->get_any_value( $props, "use_{$base_prop_name}_color{$suffix}", 'on', true );

				if ( ! $has_gradient_and_image && 'off' !== $use_color_value ) {
					$color       = et_pb_responsive_options()->get_inheritance_background_value( $props, "{$base_prop_name}_color", $device, $base_prop_name, $fields_definition );
					$color       = ! $is_desktop && '' === $color ? 'initial' : $color;
					$color_style = $color;

					if ( '' !== $color && $processed_color !== $color ) {
						$style .= sprintf(
							'background-color: %1$s%2$s; ',
							esc_html( $color ),
							esc_html( $important )
						);
					}
				} else if ( $has_color_toggle_options && 'off' === $use_color_value && ! $is_desktop ) {
					// Reset - If current module has background color toggle, it's off, and current mode
					// it's not desktop, we should reset the background color.
					$style .= sprintf(
						'background-color: initial %1$s; ',
						esc_html( $important )
					);
				}
			}

			// Save processed background color.
			$processed_color = $color_style;

			// Render background styles.
			if ( '' !== $style ) {
				// Add media query parameter.
				$background_args = array();
				if ( ! $is_desktop ) {
					$current_media_query = 'tablet' === $device ? 'max_width_980' : 'max_width_767';
					$background_args['media_query'] = ET_Builder_Element::get_media_query( $current_media_query );
				}

				ET_Builder_Element::set_style(
					$function_name,
					wp_parse_args( $background_args, array(
						'selector'    => $selector,
						'declaration' => rtrim( $style ),
						'priority'    => $priority,
					) )
				);
			}
		}

		// Background Hover.
		if ( et_builder_is_hover_enabled( $base_prop_name, $props ) ) {
			$images_hover = array();
			$style_hover  = '';

			$has_gradient_hover           = false;
			$has_image_hover              = false;
			$has_gradient_and_image_hover = false;
			$is_gradient_hover_disabled   = false;
			$is_image_hover_disabled      = false;

			$gradient_overlays_image_hover = 'off';

			// Background Gradient Hover.
			// This part is little bit different compared to other hover implementation. In this case,
			// hover is enabled on the background field, not on the each of those fields. So, built
			// in function get_value() doesn't work in this case. Temporarily, we need to fetch the
			// the value from get_raw_value().
			if ( $use_gradient_options && 'fields_only' !== $use_gradient_options ) {
				$use_gradient_hover = et_pb_responsive_options()->get_inheritance_background_value( $props, "use_{$base_prop_name}_color_gradient", 'hover', $base_prop_name, $fields_definition );

				// 1. Ensure gradient color is active and values are not null.
				if ( 'on' === $use_gradient_hover ) {
					// Flag to inform BG Color if current module has Gradient.
					$has_gradient_hover    = true;
					$gradient_values_hover = $this->get_gradient_hover_properties( $props, $base_prop_name, $gradient_properties_desktop );
					$gradient_hover        = $this->get_gradient_style( $gradient_values_hover );
					$images_hover[]        = $gradient_hover;

					$gradient_overlays_image_desktop   = et_pb_responsive_options()->get_any_value( $props, "{$base_prop_name}_color_gradient_overlays_image", '', true );
					$gradient_overlays_image_hover     = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_color_gradient_overlays_image", $props, $gradient_overlays_image_desktop );
				} else if ( 'off' === $use_gradient_hover ) {
					$is_gradient_hover_disabled = true;
				}
			}

			// Background Image Hover.
			// This part is little bit different compared to other hover implementation. In this case,
			// hover is enabled on the background field, not on the each of those fields. So, built
			// in function get_value() doesn't work in this case. Temporarily, we need to fetch the
			// the value from get_raw_value().
			if ( $use_image_options && 'fields_only' !== $use_image_options ) {
				$image_hover    = et_pb_responsive_options()->get_inheritance_background_value( $props, "{$base_prop_name}_image", 'hover', $base_prop_name, $fields_definition );
				$parallax_hover = et_pb_hover_options()->get_raw_value( 'parallax', $props );

				if ( '' !== $image_hover && null !== $image_hover && 'on' !== $parallax_hover ) {
					// Flag to inform BG Color if current module has Image.
					$has_image_hover = true;

					// Size.
					$image_size_hover   = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_size", $props );
					$image_size_desktop = et_()->array_get( $props, "{$base_prop_name}_size", '' );
					$is_same_image_size = $image_size_hover === $image_size_desktop;

					if ( empty( $image_size_hover ) && ! empty( $image_size_desktop ) ) {
						$image_size_hover = $image_size_desktop;
					}

					if ( ! empty( $image_size_hover ) && ! $is_same_image_size ) {
						$style_hover .= sprintf(
							'background-size: %1$s; ',
							esc_html( $image_size_hover )
						);
					}

					// Position.
					$image_position_hover   = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_position", $props );
					$image_position_desktop = et_()->array_get( $props, "{$base_prop_name}_position", '' );
					$is_same_image_position = $image_position_hover === $image_position_desktop;

					if ( empty( $image_position_hover ) && ! empty( $image_position_desktop ) ) {
						$image_position_hover = $image_position_desktop;
					}

					if ( ! empty( $image_position_hover ) && ! $is_same_image_position  ) {
						$style_hover .= sprintf(
							'background-position: %1$s; ',
							esc_html( str_replace( '_', ' ', $image_position_hover ) )
						);
					}

					// Repeat.
					$image_repeat_hover   = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_repeat", $props );
					$image_repeat_desktop = et_()->array_get( $props, "{$base_prop_name}_repeat", '' );
					$is_same_image_repeat = $image_repeat_hover === $image_repeat_desktop;

					if ( empty( $image_repeat_hover ) && ! empty( $image_repeat_desktop ) ) {
						$image_repeat_hover = $image_repeat_desktop;
					}

					if ( ! empty( $image_repeat_hover ) && ! $is_same_image_repeat ) {
						$style_hover .= sprintf(
							'background-repeat: %1$s; ',
							esc_html( $image_repeat_hover )
						);
					}

					// Blend.
					$image_blend_hover   = et_pb_hover_options()->get_raw_value( "{$base_prop_name}_blend", $props );
					$image_blend_default = et_()->array_get( $fields_definition, "{$base_prop_name}_blend.default", '' );
					$image_blend_desktop = et_()->array_get( $props, "{$base_prop_name}_blend", '' );
					$is_same_image_blend = $image_blend_hover === $image_blend_desktop;

					if ( empty( $image_blend_hover ) && ! empty( $image_blend_desktop ) ) {
						$image_blend_hover = $image_blend_desktop;
					}

					if ( ! empty( $image_blend_hover ) ) {
						// Don't print the same background blend.
						if ( ! $is_same_image_blend ) {
							$style_hover .= sprintf(
								'background-blend-mode: %1$s; ',
								esc_html( $image_blend_hover )
							);
						}

						// Force background-color: initial;
						if ( $has_gradient_hover && $has_image_hover && $image_blend_hover !== $image_blend_default ) {
							$has_gradient_and_image_hover = true;
							$style_hover .= sprintf( 'background-color: initial%1$s; ', esc_html( $important ) );
						}
					}

					// Only append background image when the image is exist.
					$images_hover[] = sprintf( 'url(%1$s)', esc_html( $image_hover ) );
				} else if ( '' === $image_hover ) {
					$is_image_hover_disabled = true;
				}
			}

			if ( ! empty( $images_hover ) ) {
				// The browsers stack the images in the opposite order to what you'd expect.
				if ( 'on' !== $gradient_overlays_image_hover ) {
					$images_hover = array_reverse( $images_hover );
				}

				$style_hover .= sprintf(
					'background-image: %1$s%2$s;',
					esc_html( join( ', ', $images_hover ) ),
					$important
				);
			} else if ( $is_gradient_hover_disabled && $is_image_hover_disabled ) {
				$style_hover .= sprintf(
					'background-image: initial %1$s;',
					$important
				);
			}

			// Background Color Hover.
			if ( $use_color_options && 'fields_only' !== $use_color_options ) {

				$use_color_hover_value = et_()->array_get( $props, "use_{$base_prop_name}_color__hover", '' );
				$use_color_hover_value = ! empty( $use_color_hover_value ) ?
					$use_color_hover_value :
					et_()->array_get( $props, "use_{$base_prop_name}_color", 'on' );

				if ( ! $has_gradient_and_image_hover && 'off' !== $use_color_hover_value ) {
					$color_hover = et_pb_responsive_options()->get_inheritance_background_value( $props, "{$base_prop_name}_color", 'hover', $base_prop_name, $fields_definition );
					$color_hover = '' !== $color_hover ? $color_hover : 'transparent';

					if ( '' !== $color_hover ) {
						$style_hover .= sprintf(
							'background-color: %1$s%2$s; ',
							esc_html( $color_hover ),
							esc_html( $important )
						);
					}
				} else if ( $has_color_toggle_options && 'off' === $use_color_hover_value ) {
					// Reset - If current module has background color toggle, it's off, and current mode
					// it's not desktop, we should reset the background color.
					$style .= sprintf(
						'background-color: initial %1$s; ',
						esc_html( $important )
					);
				}
			}

			// Render background hover styles.
			if ( '' !== $style_hover ) {
				ET_Builder_Element::set_style(
					$function_name,
					array(
						'selector'    => $selector_hover,
						'declaration' => rtrim( $style_hover ),
						'priority'    => $priority,
					)
				);
			}
		}
	}
}
