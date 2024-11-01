<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Repeater;
use \Elementor\Utils;
/**
 *
 * Section Title Widget .
 *
 */
class Super_Addons_Owl_Carousel extends Widget_Base {

	public function get_name() {
		return 'safeowlcarousel';
	}

	public function get_title() {
		return esc_html__( 'Slider', 'safe' );
	}

	public function get_icon() {
		return 'fa fa-sliders';
    }

	public function get_categories() {
		return [ 'safe' ];
	}

	public function get_style_depends() {
		return [ 'owl-carousel' ];
	}

	public function get_script_depends() {
		return [ 'owlcarousel' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'slider_section',
			[
				'label'     => esc_html__( 'Slider Option', 'safe' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'slider_image',
			[
				'label'         => esc_html__( 'Slider Image', 'safe' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url'       => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'slider_title', [
				'label'         => esc_html__( 'Slider Title', 'safe' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => esc_html__( 'Slider Title' , 'safe' ),
				'label_block'   => true,
			]
		);

		$repeater->add_control(
			'title_link',
			[
				'label' 		=> esc_html__( 'Title Link', 'safe' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'safe' ),
				'show_external' => true,
				'default' => [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);

		$this->add_control(
			'slides',
			[
				'label'     => esc_html__( 'Slider', 'safe' ),
				'type'      => Controls_Manager::REPEATER,
				'fields'    => $repeater->get_controls(),
				'default' 	=> [
					[
						'slider_title' => esc_html__( 'Slider Title', 'safe' ),
						'slider_image' => Utils::get_placeholder_image_src(),
						'title_link'   => '#',
					],
					[
						'slider_title' => esc_html__( 'Slider Title', 'safe' ),
						'slider_image' => Utils::get_placeholder_image_src(),
						'title_link'   => '#',
					],
				],
				'title_field' => '{{{ slider_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_control_section',
			[
				'label'     => esc_html__( 'Slider Control', 'safe' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'slider_autoplay',
			[
				'label' 				=> esc_html__( 'Autoplay', 'safe' ),
				'type' 					=> Controls_Manager::SWITCHER,
				'label_on' 				=> esc_html__( 'Yes', 'safe' ),
				'label_off' 			=> esc_html__( 'No', 'safe' ),
				'return_value' 			=> 'yes',
				'default' 				=> 'yes',
			]
		);

		$this->add_control(
			'slider_nav',
			[
				'label' 			=> esc_html__( 'Navigation', 'safe' ),
				'type' 				=> Controls_Manager::SWITCHER,
				'label_on' 			=> esc_html__( 'Yes', 'safe' ),
				'label_off' 		=> esc_html__( 'No', 'safe' ),
				'return_value' 		=> 'yes',
				'default' 			=> 'yes',
			]
		);
		$this->add_control(
			'slider_dots',
			[
				'label' 			=> esc_html__( 'Dots', 'safe' ),
				'type' 				=> Controls_Manager::SWITCHER,
				'label_on' 			=> esc_html__( 'Yes', 'safe' ),
				'label_off' 		=> esc_html__( 'No', 'safe' ),
				'return_value' 		=> 'yes',
				'default' 			=> 'yes',
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label' 			=> esc_html__( 'Loop', 'safe' ),
				'type' 				=> Controls_Manager::SWITCHER,
				'label_on' 			=> esc_html__( 'Yes', 'safe' ),
				'label_off' 		=> esc_html__( 'No', 'safe' ),
				'return_value' 		=> 'yes',
				'default' 			=> 'yes',
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'slider_general',
			[
				'label'     => esc_html__( 'General', 'safe' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'image_overlay',
			[
				'label' 			=> esc_html__( 'Image Overlay?', 'safe' ),
				'type' 				=> Controls_Manager::SWITCHER,
				'label_on' 			=> esc_html__( 'Yes', 'safe' ),
				'label_off' 		=> esc_html__( 'No', 'safe' ),
				'return_value' 		=> 'yes',
				'default' 			=> 'yes',
			]
		);
		$this->add_control(
            'image_overlay_color',
            [
                'label' 			=> esc_html__( 'Overlay Color', 'safe' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .image_overlay .owl-item.active .item:after' => 'background-color: {{VALUE}}',
                ],
				'default'			=> '#000000',
				'condition'			=> [ 'image_overlay' => 'yes' ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'slider_nav_dots',
			[
				'label'     => esc_html__( 'Slider Nav And Dots', 'safe' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'slider_nav_color',
            [
                'label' 			=> esc_html__( 'Navigation Background Color', 'safe' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .custom_nav button.owl-prev:before,{{WRAPPER}} .custom_nav button.owl-next:before' => 'background-color: {{VALUE}}',
                ],
				'condition'			=> [ 'slider_nav' => 'yes' ],
            ]
        );
        $this->add_control(
            'slider_nav_color_on_hover',
            [
                'label' 			=> esc_html__( 'Navigation Background Color On Hover', 'safe' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .custom_nav button.owl-prev:hover:before,{{WRAPPER}} .custom_nav button.owl-next:hover:before' => 'background-color: {{VALUE}}',
                ],
				'condition'			=> [ 'slider_nav' => 'yes' ],
            ]
        );

        $this->add_control(
            'slider_nav_icon_color',
            [
                'label' 			=> esc_html__( 'Navigation Icon Color', 'safe' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .custom_nav button.owl-prev:before,{{WRAPPER}} .custom_nav button.owl-next:before' => 'color: {{VALUE}}',
                ],
				'condition'			=> [ 'slider_nav' => 'yes' ],
            ]
        );
		$this->add_control(
            'slider_icon_color_on_hover',
            [
                'label' 			=> esc_html__( 'Navigation Icon Color On Hover', 'safe' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .custom_nav button.owl-prev:hover:before,{{WRAPPER}} .custom_nav button.owl-next:hover:before' => 'color: {{VALUE}}',
                ],
				'condition'			=> [ 'slider_nav' => 'yes' ],
            ]
        );
		$this->add_control(
			'top_position',
			[
				'label' 			=> __( 'Nav Position From Top', 'safe' ),
				'type' 				=> Controls_Manager::SLIDER,
				'size_units' 		=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 50,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .custom_nav button.owl-prev:before,{{WRAPPER}} .custom_nav button.owl-next:before' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'			=> [ 'slider_nav' => 'yes' ],
			]
		);
		$this->add_control(
			'left_nav_position',
			[
				'label' 			=> __( 'Left Nav Position From Left', 'safe' ),
				'type' 				=> Controls_Manager::SLIDER,
				'size_units' 		=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 0,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .custom_nav button.owl-prev:before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'			=> [ 'slider_nav' => 'yes' ],
			]
		);
		$this->add_control(
			'right_nav_position',
			[
				'label' 			=> __( 'Right Nav Position From Right', 'safe' ),
				'type' 				=> Controls_Manager::SLIDER,
				'size_units' 		=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 0,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .custom_nav button.owl-next:before' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'			=> [ 'slider_nav' => 'yes' ],
				'separator'			=> 'after',
			]
		);

        $this->add_control(
            'slider_dots_color',
            [
                'label' 			=> esc_html__( 'Slider Dots Color', 'safe' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .custom-dots .owl-dots button.owl-dot' => 'background-color: {{VALUE}}!important',
                ],
				'condition'			=> [ 'slider_dots' => 'yes' ],
            ]
        );

        $this->add_control(
            'slider_active_dots_color',
            [
                'label' 			=> esc_html__( 'Slider Active Dots Color', 'safe' ),
                'type' 				=> Controls_Manager::COLOR,
                'selectors' 		=> [
                    '{{WRAPPER}} .custom-dots .owl-dots button.owl-dot.active' => 'background-color: {{VALUE}}!important',
                ],
				'condition'			=> [ 'slider_dots' => 'yes' ],
            ]
        );
		$this->add_control(
			'slider_dots_position',
			[
				'label' 			=> __( 'Slider Dots Position From Bottom', 'safe' ),
				'type' 				=> Controls_Manager::SLIDER,
				'size_units' 		=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 10,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .custom-dots .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'			=> [ 'slider_dots' => 'yes' ],
			]
		);
		$this->add_control(
			'slider_dots_position_form_left',
			[
				'label' 			=> __( 'Slider Dots Position From Left', 'safe' ),
				'type' 				=> Controls_Manager::SLIDER,
				'size_units' 		=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 50,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .custom-dots .owl-dots' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'			=> [ 'slider_dots' => 'yes' ],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'slider_title_style_section',
			[
				'label' 		=> esc_html__( 'Title', 'safe' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'slider_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .inner a,{{WRAPPER}} .inner h2' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'slider_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'safe' ),
				'selector' 		=> '{{WRAPPER}} .inner a,{{WRAPPER}} .inner h2',
			]
        );

        $this->add_responsive_control(
			'slider_title_margin',
			[
				'label' 		=> esc_html__( 'Title Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .inner a,{{WRAPPER}} .inner h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'slider_title_padding',
			[
				'label' 		=> esc_html__( 'Title Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .inner a,{{WRAPPER}} .inner h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_control(
			'slider_title_position_form_left',
			[
				'label' 			=> __( 'Slider Title Position From Left', 'safe' ),
				'type' 				=> Controls_Manager::SLIDER,
				'size_units' 		=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 0,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .inner' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'slider_title_position_form_bottom',
			[
				'label' 			=> __( 'Slider Title Position From Bottom', 'safe' ),
				'type' 				=> Controls_Manager::SLIDER,
				'size_units' 		=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 20,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .inner' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper','class','default');
		if( count( $settings['slides'] ) > 1 ) {
			$this->add_render_attribute( 'wrapper','class','owl-carousel' );
		}

		$this->add_render_attribute( 'wrapper','data-owl-animate-in','fadeIn');
		$this->add_render_attribute( 'wrapper','data-owlanimate-out','fadeOut');
		$this->add_render_attribute( 'wrapper','data-owl-items','1');

		if( $settings['slider_loop'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper','data-owl-loop','true');
		} else {
			$this->add_render_attribute( 'wrapper','data-owl-loop','false');
		}

		if( $settings['slider_autoplay'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper','data-owl-autoplay','true');
		} else {
			$this->add_render_attribute( 'wrapper','data-owl-autoplay','false');
		}

		if( $settings['slider_nav'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper','data-owl-nav','true' );
			$this->add_render_attribute( 'wrapper','class','custom_nav' );
		} else {
			$this->add_render_attribute( 'wrapper','data-owl-nav','false' );
		}

		if( $settings['slider_dots'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper','data-owl-dot','true' );
			$this->add_render_attribute( 'wrapper','class','custom-dots' );
		} else {
			$this->add_render_attribute( 'wrapper','data-owl-dot','false' );
		}

		if( $settings['image_overlay'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper','class','image_overlay' );
		}

		if( !empty( $settings['slides'] ) ){
			echo '<div '.$this->get_render_attribute_string( 'wrapper' ).' >';
				foreach( $settings['slides'] as $slider ){
					echo '<div class="slider-one">';
					    echo '<div class="item">';
							echo super_addons_img_tag( array(
								'url'	=> esc_url( $slider['slider_image']['url'] ),
							) );
					  	echo '</div>';
						$target 	= $slider['title_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow 	= $slider['title_link']['nofollow'] ? ' rel="nofollow"' : '';
						if( !empty( $slider['slider_title'] ) ){
							echo '<div class="inner">';
								echo '<h2>';
									if( !empty( $slider['title_link']['url'] ) ){
										echo '<a href="'.esc_url( $slider['title_link']['url'] ).'" '.wp_kses_post( $target.$nofollow ).'>';
									}
									echo wp_kses_post( $slider['slider_title'] );

									if( !empty( $slider['title_link']['url'] ) ){
										echo '</a>';
									}
								echo '</h2>';
							echo '</div>';
						}
					echo '</div>';
				}
			echo '</div>';
		}
	}

}