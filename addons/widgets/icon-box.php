<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Text_Shadow;
/**
 *
 * Section Title Widget .
 *
 */
class Super_Addons_Icon_Box extends Widget_Base {

	public function get_name() {
		return 'safeiconbox';
	}

	public function get_title() {
		return esc_html__( 'Icon Box', 'safe' );
	}

	public function get_icon() {
		return 'fas fa-icons';
    }

	public function get_categories() {
		return [ 'safe' ];
	}

    public function get_style_depends() {
		return [ 'safeiconboxcss' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'icon_box_section',
			[
				'label' 	=> esc_html__( 'Icon Box', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'icon_box_url',
			[
				'label'         => esc_html__( 'Icon Box Url', 'safe' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'safe' ),
				'show_external' => true,
				'default'       => [
					'url'          => '',
					'is_external'  => true,
					'nofollow'     => true,
				],
			]
		);

		$this->add_control(
			'box_image_or_icon',
			[
				'label' 		=> esc_html__( 'Icon Type', 'safe' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'icon',
				'options' 		=> [
					'image'  		  => esc_html__( 'Image', 'safe' ),
					'icon' 		      => esc_html__( 'Icon', 'safe' ),
				],
			]
		);

		$this->add_control(
			'box_image',
			[
				'label' 		=> esc_html__( 'Box Image', 'safe' ),
                'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' 	=> Utils::get_placeholder_image_src(),
				],
                'condition'     => [ 'box_image_or_icon' => 'image' ]
			]
        );

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'thumbnail',
				'include' 		=> [],
				'default' 		=> 'large',
                'condition'     => [ 'box_image_or_icon' => 'image' ]
			]
		);

		$this->add_control(
			'icon_box_icon', [
				'label'         => esc_html__( 'Icon', 'safe' ),
				'type'          => Controls_Manager::ICONS,
                'default' 		=> [
					'value' 		=> 'fas fa-meh-rolling-eyes',
					'library' 		=> 'solid',
				],
                'condition'     => [ 'box_image_or_icon' => 'icon' ]
			]
		);

        $this->add_control(
			'safe_box_title',
			[
				'label' 		=> esc_html__( 'Box Title', 'safe' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'default'  		=> esc_html__( 'Safe Icon Box', 'safe' )
			]
        );

        $this->add_control(
			'box_title_tag',
			[
				'label' 		=> esc_html__( 'Box Title Tag', 'safe' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'h1' 	=> 'H1',
					'h2' 	=> 'H2',
					'h3' 	=> 'H3',
					'h4' 	=> 'H4',
					'h5' 	=> 'H5',
					'h6' 	=> 'H6',
					'span' 	=> 'span',
					'p' 	=> 'p',
					'div' 	=> 'div',
				],
				'default' 	=> 'h2',
                'condition' => [ 'safe_box_title!' => '' ]
			]
        );


        $this->add_control(
			'text_alignment',
			[
				'label' 		=> esc_html__( 'Alignment', 'safe' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'text-left' 	=> [
						'title' 		=> esc_html__( 'Left', 'safe' ),
						'icon' 			=> 'fa fa-align-left',
					],
					'text-center' 	=> [
						'title' 		=> esc_html__( 'Center', 'safe' ),
						'icon' 			=> 'fa fa-align-center',
					],
					'text-right' 	=> [
						'title' 		=> esc_html__( 'Right', 'safe' ),
						'icon' 			=> 'fa fa-align-right',
					],
				],
				'default' 		=> 'text-center',
				'toggle' 		=> true,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'safe_icon_box_icon',
			[
				'label' 	=> esc_html__( 'Icon', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
                'condition' => [ 'box_image_or_icon' => 'icon' ]
			]
		);

        $this->start_controls_tabs(
			'style_tabs_icon'
		);

		$this->start_controls_tab(
			'style_normal_tab_icon',
			[
				'label' => esc_html__( 'Normal', 'safe' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__( 'Icon Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .safe_box_icon i' => 'color: {{VALUE}}',
                ],

			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background',
				'label'     => esc_html__( 'Background', 'safe' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .safe_box_icon i',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'border',
                'label'     => esc_html__( 'Border', 'safe' ),
                'selector'  => '{{WRAPPER}} .safe_box_icon i',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' 		=> esc_html__( 'Icon Border Radius', 'safe' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .safe_box_icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'box_shadow',
                'label'     => esc_html__( 'Box Shadow', 'safe' ),
                'selector'  => '{{WRAPPER}} .safe_box_icon i',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'icon_typography',
                'label' 		=> esc_html__( 'Icon Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .safe_box_icon i',
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' 		=> esc_html__( 'Icon Margin', 'safe' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .safe_box_icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' 		=> esc_html__( 'Icon Padding', 'safe' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .safe_box_icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();


		$this->start_controls_tab(
			'style_hover_tab_icon',
			[
				'label' => esc_html__( 'Hover', 'safe' ),
			]
		);

        $this->add_control(
			'transition_icon',
			[
				'label'         => esc_html__( 'Transition Duration', 'safe' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range'         => [
					'px'           => [
						'min'             => 0,
						'max'             => 5,
						'step'            => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .safe_box_icon i' => 'transition:all {{SIZE}}s;',
				],
			]
		);

        $this->add_control(
			'icon_color_hover',
			[
				'label' 		=> esc_html__( 'Icon Color On Hover', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}}:hover .safe_box_icon i' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background_icon_hover',
				'label'     => esc_html__( 'Background', 'safe' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}}:hover .safe_box_icon i',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'border_hover',
                'label'     => esc_html__( 'Border', 'safe' ),
                'selector'  => '{{WRAPPER}}:hover .safe_box_icon i',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius_hover',
            [
                'label' 		=> esc_html__( 'Icon Border Radius', 'safe' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}}:hover .safe_box_icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'box_shadow_hover',
                'label'     => esc_html__( 'Box Shadow', 'safe' ),
                'selector'  => '{{WRAPPER}}:hover .safe_box_icon i',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'icon_typography_hover',
                'label' 		=> esc_html__( 'Icon Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}}:hover .safe_box_icon i',
            ]
        );

        $this->add_responsive_control(
            'icon_margin_hover',
            [
                'label' 		=> esc_html__( 'Icon Margin', 'safe' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}}:hover .safe_box_icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding_hover',
            [
                'label' 		=> esc_html__( 'Icon Padding', 'safe' ),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', '%', 'em' ],
                'selectors' 	=> [
                    '{{WRAPPER}}:hover .safe_box_icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
			'safe_box_image_style',
			[
				'label' 	=> esc_html__( 'Image Style', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
                'condition' => [ 'box_image_or_icon' => 'image' ]
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'image_background',
				'label'     => esc_html__( 'Background', 'safe' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .safe_box_image img',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'image_border',
				'label'     => esc_html__( 'Border', 'safe' ),
				'selector'  => '{{WRAPPER}} .safe_box_image img',
			]
		);

        $this->add_responsive_control(
			'image_opacity',
			[
				'label'         => esc_html__( 'Opacity', 'safe' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range'         => [
					'px'           => [
						'min'             => 0,
						'max'             => 1,
						'step'            => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .safe_box_image img' => 'opacity: {{SIZE}};',
				],
			]
		);

        $this->add_responsive_control(
			'image_grayscale',
			[
				'label'         => esc_html__( 'Image Filter', 'safe' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ '%' ],
				'range'         => [
					'px'           => [
						'min'             => 0,
						'max'             => 100,
						'step'            => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .safe_box_image img' => 'filter:grayscale({{SIZE}}%);',
				],
			]
		);

        $this->add_responsive_control(
			'image_border_radius',
			[
				'label' 		=> esc_html__( 'Image Border Radius', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .safe_box_image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'image_box_shadow',
				'label'     => esc_html__( 'Box Shadow', 'safe' ),
				'selector'  => '{{WRAPPER}} .safe_box_image img',
			]
		);

        $this->add_responsive_control(
			'image_margin',
			[
				'label' 		=> esc_html__( 'Image Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .safe_box_image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'image_padding',
			[
				'label' 		=> esc_html__( 'Image Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .safe_box_image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'safe_box_title_style',
			[
				'label' 	=> esc_html__( 'Title Style', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
                'condition' 	=> [
                    'safe_box_title!'    => ''
                ]
			]
		);
        $this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'safe' ),
			]
		);

        $this->add_control(
			'safe_box_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .safe_icon_box_wrapper .box_title' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'      => 'box_title_text_shadow',
				'label'     => esc_html__( 'Title Text Shadow', 'safe' ),
				'selector'  => '{{WRAPPER}} .safe_icon_box_wrapper .box_title',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'safe_box_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .safe_icon_box_wrapper .box_title',
			]
		);

        $this->add_responsive_control(
			'safe_box_title_margin',
			[
				'label' 		=> esc_html__( 'Title Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .safe_icon_box_wrapper .box_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'safe_box_title_padding',
			[
				'label' 		=> esc_html__( 'Title Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .safe_icon_box_wrapper .box_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'safe' ),
			]
		);

        $this->add_control(
			'transition_title',
			[
				'label'         => esc_html__( 'Transition Duration', 'safe' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range'         => [
					'px'           => [
						'min'             => 0,
						'max'             => 5,
						'step'            => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .safe_icon_box_wrapper.box_title' => 'transition:all {{SIZE}}s;',
				],
			]
		);

        $this->add_control(
			'title_color_on_box_hover',
			[
				'name'      => 'title_color_on_box_hover',
				'label'     => esc_html__( 'Title Color On Box Hover', 'safe' ),
				'type' 		=> Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}}:hover .safe_icon_box_wrapper .box_title' => 'color: {{VALUE}}',
                ],
			]
		);

        $this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'      => 'box_title_text_shadow_hover',
				'label'     => esc_html__( 'Title Text Shadow', 'safe' ),
				'selector'  => '{{WRAPPER}}:hover .safe_icon_box_wrapper .box_title',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'safe_box_title_typography_hover',
				'label' 		=> esc_html__( 'Title Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}}:hover .safe_icon_box_wrapper .box_title',
			]
		);

        $this->add_responsive_control(
			'safe_box_title_margin_hover',
			[
				'label' 		=> esc_html__( 'Title Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}:hover .safe_icon_box_wrapper .box_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'safe_box_title_padding_hover',
			[
				'label' 		=> esc_html__( 'Title Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}:hover .safe_icon_box_wrapper .box_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

        $this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


	}

    public function render_content() {
        /**
         * Before widget render content.
         *
         * Fires before Elementor widget is being rendered.
         *
         * @since 1.0.0
         *
         * @param Widget_Base $this The current widget.
         */
        do_action( 'elementor/widget/before_render_content', $this );

        ob_start();

        $skin = $this->get_current_skin();
        if ( $skin ) {
            $skin->set_parent( $this );
            $skin->render();
        } else {
            $this->render();
        }

        $widget_content = ob_get_clean();

        if ( empty( $widget_content ) ) {
            return;
        }

        $tag = 'div';
        $link = $this->get_settings_for_display( 'icon_box_url' );
        $this->add_render_attribute( 'icon_box', 'class', 'elementor-widget-container' );

        if ( ! empty( $link['url'] ) ) {
            $tag = 'a';
            $this->add_render_attribute( 'icon_box', 'class', 'safe_icon_box_link' );
			$this->add_link_attributes( 'icon_box', $link );
        }
        ?>
        <<?php echo $tag; ?> <?php echo $this->get_render_attribute_string( 'icon_box' ); ?>>
            <?php

            /**
             * Render widget content.
             *
             * Filters the widget content before it's rendered.
             *
             * @since 1.0.0
             *
             * @param string      $widget_content The content of the widget.
             * @param Widget_Base $this           The widget.
             */
            $widget_content = apply_filters( 'elementor/widget/render_content', $widget_content, $this );

            echo $widget_content; // XSS ok.
            ?>
        </<?php echo $tag; ?>>
        <?php
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        // Add Inline Editing
        $this->add_inline_editing_attributes( 'safe_box_title', 'basic' );
        $this->add_render_attribute( 'safe_box_title', 'class', 'box_title' );

        // Wrapper Class
		$this->add_render_attribute( 'wrapper', 'class', 'safe_icon_box_wrapper' );
		$this->add_render_attribute( 'wrapper', 'class', $settings['text_alignment'] );

        // Add Different Class On Image Or Icon
        if( $settings['box_image_or_icon'] == 'image' ){
            $this->add_render_attribute( 'icon_image_class', 'class', 'safe_box_image' );
        }else{
            $this->add_render_attribute( 'icon_image_class', 'class', 'safe_box_icon' );
        }

        $target       = $settings['icon_box_url']['is_external'] ? ' target="_blank"' : '';
		$nofollow     = $settings['icon_box_url']['nofollow'] ? ' rel="nofollow"' : '';

		echo '<div '.$this->get_render_attribute_string( 'wrapper' ).' >';
		    echo '<div '.$this->get_render_attribute_string( 'icon_image_class' ).' >';
                if( $settings['box_image_or_icon'] == 'image' ){
                    echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'box_image' );
                }else{
                    echo '<i class="'.esc_attr( $settings['icon_box_icon']['value'] ).'"></i>';
                }
            echo '</div>';
            if( !empty( $settings['safe_box_title'] ) ){
                echo '<'.esc_attr( $settings['box_title_tag'] ).' '.$this->get_render_attribute_string( 'safe_box_title' ).'>'.wp_kses_post( $settings['safe_box_title'] ).'</'.esc_attr( $settings['box_title_tag'] ).'>';
            }
        echo '</div>';

	}

    protected function _content_template() {
		?>
        <#
            view.addInlineEditingAttributes( 'safe_box_title', 'basic' );
            view.addRenderAttribute( 'safe_box_title', 'class', 'box_title' );
    		var target = settings.icon_box_url.is_external ? ' target="_blank"' : '';
    		var nofollow = settings.icon_box_url.nofollow ? ' rel="nofollow"' : '';

            if( settings.icon_box_url.url ){
		#>
        <a href="{{ settings.icon_box_url.url }}"{{ target }}{{ nofollow }}>
		<#
            }
        view.addRenderAttribute( 'wrapper', 'class', 'safe_icon_box_wrapper' );
        view.addRenderAttribute( 'wrapper', 'class', settings.text_alignment );

        if( settings.box_image_or_icon == 'image' ){
            view.addRenderAttribute( 'icon_image_class', 'class', 'safe_box_image' );
        }else{
            view.addRenderAttribute( 'icon_image_class', 'class', 'safe_box_icon' );
        }
        #>
        <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
            <div {{{ view.getRenderAttributeString( 'icon_image_class' ) }}}>
                <# if( settings.box_image_or_icon == 'image' ){
            		var image = {
            			id: settings.box_image.id,
            			url: settings.box_image.url,
            			size: settings.thumbnail_size,
            			dimension: settings.thumbnail_custom_dimension,
            			model: view.getEditModel()
            		};
            		var image_url = elementor.imagesManager.getImageUrl( image );
        		#>
        		<img src="{{{ image_url }}}" />
                <# }else{ #>
                    <i class="{{ settings.icon_box_icon.value }}"></i>
                <# } #>
            </div>
            <# if( settings.safe_box_title ){ #>
            <{{settings.box_title_tag}} {{{ view.getRenderAttributeString( 'safe_box_title' ) }}}>{{{settings.safe_box_title}}}</{{settings.box_title_tag}}>
            <# } #>
        </div>
        <# if( settings.icon_box_url.url ){ #>
        </a>
        <# } #>
		<?php
	}

}
