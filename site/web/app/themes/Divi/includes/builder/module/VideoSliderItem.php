<?php

class ET_Builder_Module_Video_Slider_Item extends ET_Builder_Module {
	function init() {
		$this->name                        = esc_html__( 'Video', 'et_builder' );
		$this->plural                      = esc_html__( 'Videos', 'et_builder' );
		$this->slug                        = 'et_pb_video_slider_item';
		$this->vb_support 				   = 'on';
		$this->type                        = 'child';
		$this->custom_css_tab              = false;
		$this->child_title_var             = 'admin_title';
		$this->advanced_setting_title_text = esc_html__( 'New Video', 'et_builder' );
		$this->settings_text               = esc_html__( 'Video Settings', 'et_builder' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Video', 'et_builder' ),
					'overlay'      => et_builder_i18n( 'Overlay' ),
					'admin_label'  => et_builder_i18n( 'Admin Label' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'arrows_color' => esc_html__( 'Controls', 'et_builder' ),
				),
			),
		);

		$this->advanced_fields = array(
			'text'                  => array(
				'use_text_orientation'  => false,
				'use_background_layout' => true,
				'options' => array(
					'background_layout' => array(
						'label'            => esc_html__( 'Slider Arrows Color', 'et_builder' ),
						'option_category'  => 'color_option',
						'toggle_slug'      => 'arrows_color',
						'description'      => esc_html__( 'This setting will make your slider arrows either light or dark in color.', 'et_builder' ),
						'default'          => 'dark',
						'default_on_child' => true,
						'hover'            => 'tabs',
						'priority'         => 1,
					),
				),
			),
			'box_shadow'            => array(
				'default' => false,
			),
			'borders'               => array(
				'default' => false,
			),
			'text_shadow'           => array(
				'default' => false,
			),
			'background'            => false,
			'fonts'                 => false,
			'max_width'             => false,
			'height'                => false,
			'margin_padding' => false,
			'button'                => false,
			'link_options'          => false,
			'scroll_effects'        => false,
		);
	}

	function get_fields() {
		$fields = array(
			'admin_title' => array(
				'label'       => et_builder_i18n( 'Admin Label' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the video in the builder for easy identification.', 'et_builder' ),
				'toggle_slug' => 'admin_label',
			),
			'src' => array(
				'label'              => esc_html__( 'Video MP4/URL', 'et_builder' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'data_type'          => 'video',
				'upload_button_text' => esc_attr__( 'Upload a video', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose a Video MP4 File', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Video', 'et_builder' ),
				'description'        => esc_html__( 'Upload your desired video in .MP4 format, or type in the URL to the video you would like to display', 'et_builder' ),
				'toggle_slug'        => 'main_content',
				'computed_affects' => array(
					'__get_oembed',
					'__oembed_thumbnail',
					'__is_oembed',
				),
				'mobile_options' => true,
				'hover'          => 'tabs',
			),
			'src_webm' => array(
				'label'              => esc_html__( 'Video Webm', 'et_builder' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'data_type'          => 'video',
				'upload_button_text' => esc_attr__( 'Upload a video', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose a Video WEBM File', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Video', 'et_builder' ),
				'description'        => esc_html__( 'Upload the .WEBM version of your video here. All uploaded videos should be in both .MP4 .WEBM formats to ensure maximum compatibility in all browsers.', 'et_builder' ),
				'toggle_slug'        => 'main_content',
				'mobile_options'     => true,
				'hover'              => 'tabs',
			),
			'image_src' => array(
				'label'              => esc_html__( 'Image Overlay URL', 'et_builder' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => et_builder_i18n( 'Upload an image' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
				'additional_button'  => sprintf(
					'<input type="button" class="button et-pb-video-image-button" value="%1$s" />',
					esc_attr__( 'Generate From Video', 'et_builder' )
				),
				'additional_button_type' => 'generate_image_url_from_video',
				'additional_button_attrs' => array(
					'video_source' => 'src',
				),
				'classes'            => 'et_pb_video_overlay',
				'description'        => esc_html__( 'Upload your desired image, or type in the URL to the image you would like to display over your video. You can also generate a still image from your video.', 'et_builder' ),
				'toggle_slug'        => 'overlay',
				'dynamic_content'    => 'image',
				'mobile_options'     => true,
				'hover'              => 'tabs',
			),
			'__oembed_thumbnail' => array(
				'type' => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Video_Slider_Item', 'get_oembed_thumbnail' ),
				'computed_depends_on' => array(
					'src',
					'image_src',
				),
				'computed_minimum' => array(
					'src',
				),
			),
			'__is_oembed' => array(
				'type' => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Video_Slider_Item', 'is_oembed' ),
				'computed_depends_on' => array(
					'src',
				),
				'computed_minimum' => array(
					'src',
				),
			),
			'__get_oembed' => array(
				'type' => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Video_Slider_Item', 'get_oembed' ),
				'computed_depends_on' => array(
					'src',
				),
				'computed_minimum' => array(
					'src',
				),
			),
			'play_icon_color'         => array(
				'label'          => esc_html__( 'Play Icon Color', 'et_builder' ),
				'description'    => esc_html__( 'Here you can define a custom color for the play icon.', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'arrows_color',
				'hover'          => 'tabs',
				'mobile_options' => true,
				'priority' => 5,
			),
			'use_icon_font_size'      => array(
				'label'            => esc_html__( 'Use Play Icon Font Size', 'et_builder' ),
				'description'      => esc_html__( 'If you would like to control the size of the icon, you must first enable this option.', 'et_builder' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'off' => et_builder_i18n( 'No' ),
					'on'  => et_builder_i18n( 'Yes' ),
				),
				'default_on_front' => 'off',
				'affects'          => array(
					'icon_font_size',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'arrows_color',
				'option_category'  => 'font_option',
			),
			'icon_font_size'          => array(
				'label'            => esc_html__( 'Play Icon Font Size', 'et_builder' ),
				'description'      => esc_html__( 'Control the size of the icon by increasing or decreasing the font size.', 'et_builder' ),
				'type'             => 'range',
				'option_category'  => 'font_option',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'arrows_color',
				'allowed_units'    => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'default'          => '96px',
				'default_unit'     => 'px',
				'default_on_front' => '',
				'range_settings'   => array(
					'min'  => '1',
					'max'  => '120',
					'step' => '1',
				),
				'mobile_options'   => true,
				'depends_show_if'  => 'on',
				'responsive'       => true,
				'hover'            => 'tabs',
			),
		);
		return $fields;
	}

	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();

		$fields['background_layout'] = array( 'color' => '%%order_class%% .et-pb-arrow-prev, %%order_class%% .et-pb-arrow-next' );
		$fields['play_icon_color']   = array( 'color' => '%%order_class%%.et_pb_slide .et_pb_video_play' );
		$fields['icon_font_size']    = array(
			'font-size'   => '%%order_class%%.et_pb_slide .et_pb_video_play',
			'margin-left' => '%%order_class%%.et_pb_slide .et_pb_video_play',
			'margin-top'  => '%%order_class%%.et_pb_slide .et_pb_video_play',
			'line-height' => '%%order_class%%.et_pb_slide .et_pb_video_play',
		);

		return $fields;
	}

	protected static function resolve_oembed_thumbnail( $src, $post_id ) {
		$dynamic_value = et_builder_parse_dynamic_content( $src );
		if ( $dynamic_value->is_dynamic() && current_user_can( 'edit_post', $post_id ) ) {
			return $dynamic_value->resolve( $post_id );
		}

		return $src;
	}

	static function get_oembed_thumbnail( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		$post_id = isset( $current_page['id'] ) ? $current_page['id'] : self::get_current_post_id();
		$defaults = array(
			'image_src' => '',
			'src' => '',
		);

		$args = wp_parse_args( $args, $defaults );

		if ( '' !== $args['image_src'] ) {
			return et_pb_set_video_oembed_thumbnail_resolution(
				self::resolve_oembed_thumbnail( $args['image_src'], $post_id ),
				'high'
			);
		} else {
			if ( false !== et_pb_check_oembed_provider( esc_url( $args['src'] ) ) ) {
				add_filter( 'oembed_dataparse', 'et_pb_video_oembed_data_parse', 10, 3 );
				// Save thumbnail
				$thumbnail_track_output = wp_oembed_get( esc_url( $args['src'] ) );
				// Set back to normal
				remove_filter( 'oembed_dataparse', 'et_pb_video_oembed_data_parse', 10, 3 );
				return $thumbnail_track_output;
			} else {
				return '';
			}
		}
	}

	static function is_oembed( $args = array(), $conditional_tags = array(), $current_page = array() ){
		$defaults = array(
			'src'
		);

		$args = wp_parse_args( $args, $defaults );

		return et_pb_check_oembed_provider( esc_url( $args['src'] ) );
	}

 	static function get_oembed( $args = array(), $conditional_tags = array(), $current_page = array() ) {
 		$defaults = array(
 			'src' => '',
		);

		$args = wp_parse_args( $args, $defaults );

		// Save thumbnail
		$thumbnail_track_output = wp_oembed_get( esc_url( $args['src'] ) );

		return $thumbnail_track_output;
 	}

	 static function get_video( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		 $defaults = array(
			 'src' => '',
			 'src_webm' => '',
		 );
 
		 $args = wp_parse_args( $args, $defaults );
 
		 $video_src = '';
 
		 if ( false !== et_pb_check_oembed_provider( esc_url( $args['src'] ) ) ) {
			 $video_src = wp_oembed_get( esc_url( $args['src'] ) );
		 } else {
			 $video_src = sprintf( '
				 <video controls>
					 %1$s
					 %2$s
				 </video>',
				 ( '' !== $args['src'] ? sprintf( '<source type="video/mp4" src="%1$s" />', esc_url( $args['src'] ) ) : '' ),
				 ( '' !== $args['src_webm'] ? sprintf( '<source type="video/webm" src="%1$s" />', esc_url( $args['src_webm'] ) ) : '' )
			 );
 
			 wp_enqueue_style( 'wp-mediaelement' );
			 wp_enqueue_script( 'wp-mediaelement' );
		 }
 
		 return $video_src;
	 }

	function render( $attrs, $content = null, $render_slug ) {
		global $et_pb_slider_image_overlay;

		$multi_view = et_pb_multi_view_options( $this );
		$multi_view->set_custom_prop( 'show_image_overlay', $et_pb_slider_image_overlay );

		$src                             = $this->props['src'];
		$src_webm                        = $this->props['src_webm'];
		$image_src                       = $this->props['image_src'];
		$video_src                       = '';

		// Controls.
		$use_icon_font_size     = $this->props['use_icon_font_size'];
		$play_icon_color_values = et_pb_responsive_options()->get_property_values( $this->props, 'play_icon_color' );
		$play_icon_color_hover  = $this->get_hover_value( 'play_icon_color' );
		$icon_font_size_values  = et_pb_responsive_options()->get_property_values( $this->props, 'icon_font_size' );
		$icon_font_size_hover   = $this->get_hover_value( 'icon_font_size' );

		// Responsive background layout.
		$background_layout               = $this->props['background_layout'];
		$background_layout_hover         = et_pb_hover_options()->get_value( 'background_layout', $this->props, 'light' );
		$background_layout_hover_enabled = et_pb_hover_options()->is_enabled( 'background_layout', $this->props );
		$background_layout_values        = et_pb_responsive_options()->get_property_values( $this->props, 'background_layout' );
		$background_layout_tablet        = isset( $background_layout_values['tablet'] ) ? $background_layout_values['tablet'] : '';
		$background_layout_phone         = isset( $background_layout_values['phone'] ) ? $background_layout_values['phone'] : '';

		// Play Icon color.
		et_pb_responsive_options()->generate_responsive_css( $play_icon_color_values, '%%order_class%%.et_pb_slide .et_pb_video_play', 'color', $render_slug, ' !important;', 'color' );

		if ( et_builder_is_hover_enabled( 'play_icon_color', $this->props ) ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%%.et_pb_slide .et_pb_video_play:hover',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $play_icon_color_hover )
				),
			) );
		}

		// Icon Size.
		$icon_selector = '%%order_class%%.et_pb_slide .et_pb_video_play';
		if ( 'off' !== $use_icon_font_size ) {
			// Proccess for each devices.
			foreach ( $icon_font_size_values as $font_size_key => $font_size_value ) {
				if ( '' === $font_size_value ) {
					continue;
				}

				$media_query = 'general';
				if ( 'tablet' === $font_size_key ) {
					$media_query = ET_Builder_Element::get_media_query( 'max_width_980' );
				} elseif ( 'phone' === $font_size_key ) {
					$media_query = ET_Builder_Element::get_media_query( 'max_width_767' );
				}

				$font_size_value_int  = (int) $font_size_value;
				$font_size_value_unit = str_replace( $font_size_value_int, '', $font_size_value );
				$font_size_value_half = 0 < $font_size_value_int ? -1 * $font_size_value_int / 2 : 0;
				$font_size_value_half = (string) $font_size_value_half . $font_size_value_unit;

				ET_Builder_Element::set_style( $render_slug, array(
					'selector'    => '%%order_class%%.et_pb_slide .et_pb_video_play',
					'declaration' => sprintf(
						'font-size:%1$s; line-height:%1$s; margin-top:%2$s;',
						esc_html( $font_size_value ),
						esc_html( $font_size_value_half )
					),
					'media_query' => $media_query,
				) );

				ET_Builder_Element::set_style( $render_slug, array(
					'selector'    => '%%order_class%%.et_pb_slide .et_pb_video_wrap .et_pb_video_overlay .et_pb_video_play',
					'declaration' => sprintf(
						'margin-left:%1$s;',
						esc_html( $font_size_value_half )
					),
					'media_query' => $media_query,
				) );
			}

			// Icon hover styles.
			if ( et_builder_is_hover_enabled( 'icon_font_size', $this->props ) && '' !== $icon_font_size_hover ) {
				$icon_font_size_hover_int  = (int) $icon_font_size_hover;
				$icon_font_size_hover_unit = str_replace( $icon_font_size_hover_int, '', $icon_font_size_hover );
				$icon_font_size_hover_half = 0 < $icon_font_size_hover_int ? $icon_font_size_hover_int / 2 : 0;
				$icon_font_size_hover_half = (string) $icon_font_size_hover_half . $icon_font_size_hover_unit;
				ET_Builder_Element::set_style( $render_slug, array(
					'selector'    => $this->add_hover_to_selectors( $icon_selector ),
					'declaration' => sprintf(
						'font-size:%1$s; line-height:%1$s; margin-top:-%2$s; margin-left:-%2$s;',
						esc_html( $icon_font_size_hover ),
						esc_html( $icon_font_size_hover_half )
					),
				) );
			}
		}

		global $et_pb_slider_image_overlay;

		$video_srcs = array();
		$image_srcs = array();

		foreach ( $multi_view->get_modes() as $mode ) {
			$src       = $multi_view->get_value( 'src', $mode );
			$src_webm  = $multi_view->get_value( 'src_webm', $mode );
			$image_src = $multi_view->get_value( 'image_src', $mode );

			if ( $src || $src_webm ) {
				$video_srcs[ $mode ] = self::get_video( array(
					'src' => $src,
					'src_webm' =>$src_webm,
				) );
			}

			if ( $src || $image_src ) {
				$image_srcs[ $mode ] = self::get_oembed_thumbnail( array(
					'src' => $src,
					'image_src' => $image_src,
				) );
			}
		}

		if ( $video_srcs ) {
			$multi_view->set_custom_prop( 'video_srcs', $video_srcs );
		}

		if ( $image_srcs ) {
			$multi_view->set_custom_prop( 'image_srcs', $image_srcs );
		}

		$video_src = $multi_view->render_element( array(
			'tag'     => 'div',
			'content' => '{{video_srcs}}',
			'attrs' => array(
				'class' => 'et_pb_video_box',
			),
		) );

		$video_overlay = $multi_view->render_element( array(
			'tag'     => 'div',
			'content' => '<div class="et_pb_video_overlay_hover"><a href="#" class="et_pb_video_play"></a></div>',
			'attrs'   => array(
				'class' => 'et_pb_video_overlay',
			),
			'styles' => array(
				'background-image' => 'url({{image_srcs}})',
			),
			'visibility' => array(
				'show_image_overlay' => 'on',
			),
		) );

		$video_output = $multi_view->render_element( array(
			'tag'     => 'div',
			'content' => "{$video_src}{$video_overlay}",
			'attrs' => array(
				'class' => 'et_pb_video_wrap',
			),
			'required' => 'video_srcs'
		) );

		if ( '' !== $image_src ) {
			$image_overlay_output = et_pb_set_video_oembed_thumbnail_resolution( $image_src, 'high' );
			$thumbnail_track_output = $image_src;
		} else {
			$image_overlay_output = '';
			if ( false !== et_pb_check_oembed_provider( esc_url( $src ) ) ) {
				add_filter( 'oembed_dataparse', 'et_pb_video_oembed_data_parse', 10, 3 );
				// Save thumbnail
				$thumbnail_track_output = wp_oembed_get( esc_url( $src ) );
				$image_overlay_output = $thumbnail_track_output;
				// Set back to normal
				remove_filter( 'oembed_dataparse', 'et_pb_video_oembed_data_parse', 10, 3 );
			} else {
				$thumbnail_track_output = '';
			}
		}

		// Module classnames
		$this->add_classname( array(
			'et_pb_slide',
			"et_pb_bg_layout_{$background_layout}",
		) );

		if ( ! empty( $background_layout_tablet ) ) {
			$this->add_classname( "et_pb_bg_layout_{$background_layout_tablet}_tablet" );
		}

		if ( ! empty( $background_layout_phone ) ) {
			$this->add_classname( "et_pb_bg_layout_{$background_layout_phone}_phone" );
		}

		// Remove automatically added classnames
		$this->remove_classname( array(
			'et_pb_module',
			$render_slug,
		) );

		$data_background_layout       = '';
		$data_background_layout_hover = '';
		if ( $background_layout_hover_enabled ) {
			$data_background_layout = sprintf(
				' data-background-layout="%1$s"',
				esc_attr( $background_layout )
			);
			$data_background_layout_hover = sprintf(
				' data-background-layout-hover="%1$s"',
				esc_attr( $background_layout_hover )
			);
		}

		$multi_view_image_srcs_data_attr = $multi_view->render_attrs( array(
			'attrs' => array(
				'data-image' => '{{image_srcs}}',
			),
		) );

		$output = sprintf(
			'<div class="%1$s"%3$s%4$s%5$s%6$s>
				%2$s
			</div> <!-- .et_pb_slide -->
			',
			$this->module_classname( $render_slug ),
			( '' !== $video_output ? $video_output : '' ),
			( '' !== $multi_view->get_value('image_srcs') ? sprintf( ' data-image="%1$s"', esc_attr( $multi_view->get_value('image_srcs') ) ) : '' ),
			et_core_esc_previously( $data_background_layout ),
			et_core_esc_previously( $data_background_layout_hover ), // #5
			$multi_view_image_srcs_data_attr
		);

		return $output;
	}
}

new ET_Builder_Module_Video_Slider_Item;
