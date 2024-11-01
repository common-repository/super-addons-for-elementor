<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Button Widget .
 *
 */
class Super_Addons_Button extends Widget_Base {

	public function get_name() {
		return 'safebutton';
	}

	public function get_title() {
		return esc_html__( 'Button', 'safe' );
	}

	public function get_icon() {
		return 'fab fa-bootstrap';
    }

	public function get_categories() {
		return [ 'safe' ];
	}

	public function get_style_depends() {
		return [ 'safebutton' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'button_section',
			[
				'label' 	=> esc_html__( 'Button', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
            'button_style',
            [
                'label' 	=> esc_html__( 'Button Style', 'safe' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
                    '1'  => esc_html__( 'Default Button', 'safe' ),
                    '2'  => esc_html__( 'Bubble Hover', 'safe' ),
                    '3'  => esc_html__( 'Classic Hover', 'safe' ),
                    '4'  => esc_html__( 'Fill Button', 'safe' ),
                    '5'  => esc_html__( 'Pulse Effect', 'safe' ),
                    '6'  => esc_html__( 'Close Effect', 'safe' ),
                    '7'  => esc_html__( 'Raise Effect', 'safe' ),
                    '8'  => esc_html__( 'Fill Up', 'safe' ),
                    '9'  => esc_html__( 'Slide', 'safe' ),
                    '10' => esc_html__( 'Offset', 'safe' ),
                ],
                'default' => '1',
            ]
        );

        $this->add_control(
			'button_text',
			[
				'label' 	=> esc_html__( 'Button Text', 'safe' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'Button Text', 'safe' )
			]
        );

        $this->add_control(
			'button_link',
			[
				'label' 		=> esc_html__( 'Link', 'safe' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'safe' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> esc_html__( '#','safe' ),
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$this->add_control(
			'button_icon_option',
			[
				'label' 		=> esc_html__( 'Button Icon?', 'safe' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Show', 'safe' ),
				'label_off' 	=> esc_html__( 'Hide', 'safe' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' 		=> esc_html__( 'Icon', 'safe' ),
				'type' 			=> Controls_Manager::ICONS,
				'condition'		=> [ 'button_icon_option' => 'yes' ],
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' 	=> esc_html__( 'Icon Position', 'safe' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 		=> [
						'title' 	=> esc_html__( 'Before Text', 'safe' ),
						'icon' 		=> 'fa fa-align-left',
					],
					'right' 	=> [
						'title' 	=> esc_html__( 'After Text', 'safe' ),
						'icon' 		=> 'fa fa-align-right',
					],
				],
				'default' 	=> 'right',
				'toggle' 	=> true,
				'condition' => [ 'button_icon_option' => 'yes' ],
			]
		);

        $this->add_control(
			'button_align',
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
						'icon'	 		=> 'fa fa-align-right',
					],
				],
				'default' 	=> 'text-left',
				'toggle' 	=> true,
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> esc_html__( 'Button Style', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
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
			'button_color',
			[
				'label' 		=> esc_html__( 'Button Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a' => 'color: {{VALUE}}',
                ],
				'default'		=> '#000',
				'condition'		=> [ 'button_style' => ['1','2','3'] ],
			]
        );
		$this->add_control(
			'button_color_another',
			[
				'label' 		=> esc_html__( 'Button Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a,.btn-another-wrapper a' => 'color: {{VALUE}}!important',
                ],
				'condition'		=> [ 'button_style!' => ['1','2','3'] ],
			]
        );

        $this->add_control(
			'button_bg_color',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a' => 'background-color: {{VALUE}}',
                ],
				'default'   	=> '#0274be',
				'condition'		=> [ 'button_style' => ['1','2'] ],
			]
        );
        $this->add_control(
			'button_bg_color_another',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> [ 'button_style!' => ['1','2','3'] ],
			]
        );

        $this->add_control(
			'button_classic_bg',
			[
				'label' 		=> esc_html__( 'Button Shape Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a.button_cta:before' => 'background-color: {{VALUE}}',
                ],
				'default'   	=> '#0274be',
				'condition'		=> [ 'button_style' => '3' ],
			]
        );

		$this->add_control(
			'button_box_shadow_color',
			[
				'label' 		=> esc_html__( 'Button Box Shadow Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a.button_offset' => 'box-shadow: 0.3em 0.3em 0 0 {{VALUE}}, inset 0.3em 0.3em 0 0 {{VALUE}}',
                ],
				'condition'		=> [ 'button_style' => '10' ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'label' 		=> esc_html__( 'Border', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .btn-wrapper a,{{WRAPPER}} .btn-another-wrapper a',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'label' 		=> esc_html__( 'Button Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .btn-wrapper a,{{WRAPPER}} .btn-another-wrapper a',
			]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'label' 		=> esc_html__( 'Box Shadow', 'safe' ),
				'selector' 		=> '{{WRAPPER}} .btn-wrapper a,{{WRAPPER}} .btn-another-wrapper a',
			]
		);

        $this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> esc_html__( 'Button Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a,{{WRAPPER}} .btn-another-wrapper a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> esc_html__( 'Button Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a,{{WRAPPER}} .btn-another-wrapper a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> esc_html__( 'Button Border Radius', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a,{{WRAPPER}} .btn-another-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_control(
			'button_icon_color',
			[
				'label' 		=> esc_html__( 'Button Icon Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a i,{{WRAPPER}} .btn-another-wrapper a i' => 'color: {{VALUE}}',
                ],
				'default'		=> '#000',
				'condition'		=> [ 'button_icon_option' => 'yes' ],
			]
        );

		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label' 		=> esc_html__( 'Button Icon Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a i,{{WRAPPER}} .btn-another-wrapper a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition'		=> [ 'button_icon_option' => 'yes' ],
			]
        );

        $this->add_responsive_control(
			'button_icon_padding',
			[
				'label' 		=> esc_html__( 'Button Icon Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a i,{{WRAPPER}} .btn-another-wrapper a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition'		=> [ 'button_icon_option' => 'yes' ],
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
			'button_color_hover',
			[
				'label' 		=> esc_html__( 'Button Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a:hover,{{WRAPPER}} .btn-another-wrapper a:hover' => 'color: {{VALUE}}!important',
                ],
				'default'		=> '#fff',
				'condition'		=> [ 'button_style!' => ['5','7'] ]
			]
        );

		$this->add_control(
			'button_color_hover_pulse',
			[
				'label' 		=> esc_html__( 'Button Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a:hover' => 'color: {{VALUE}}!important',
                ],
				'default'		=> '#ef8f6e',
				'condition'		=> [ 'button_style' => '5' ]
			]
        );

		$this->add_control(
			'button_color_hover_raise',
			[
				'label' 		=> esc_html__( 'Button Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a:hover' => 'color: {{VALUE}}!important',
                ],
				'default'		=> '#e5ff60',
				'condition'		=> [ 'button_style' => '7' ]
			]
        );

        $this->add_control(
			'button_bg_color_hover',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a:hover' => 'background-color: {{VALUE}}',
                ],
				'default'   	=> '#000',
				'condition'		=> [ 'button_style' => [ '1' ] ]
			]
        );

        $this->add_control(
			'button_bg_bubble_color_hover',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a.button_bubble .two_style' => 'background-color: {{VALUE}}',
                ],
				'default'   	=> '#f4d258',
				'condition'		=> [ 'button_style' => '2' ]
			]
        );

        $this->add_control(
			'button_fill_hover_bg',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a.button_fill:hover,{{WRAPPER}} .btn-another-wrapper a.button_fill:focus' => 'box-shadow: inset 0 0 0 2em {{VALUE}}',
                ],
				'condition'		=> [ 'button_style' => '4' ],
			]
        );

        $this->add_control(
			'button_another_hover',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a:hover' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> [ 'button_style' => ['5','7'] ],
			]
        );

        $this->add_control(
			'button_close_bg_hover',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a.button_close:hover,{{WRAPPER}} .btn-another-wrapper a.button_close:focus' => 'box-shadow: inset -4.6em 0 0 0 {{VALUE}}, inset 4.6em 0 0 0 {{VALUE}}',
                ],
				'condition'		=> [ 'button_style' => '6' ]
			]
        );

        $this->add_control(
			'button_fill_up_hover',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a.button_up:hover,{{WRAPPER}} .btn-another-wrapper a.button_up:focus' => 'box-shadow: inset 0 -3.25em 0 0 {{VALUE}}',
                ],
				'condition'		=> [ 'button_style' => '8' ]
			]
        );

        $this->add_control(
			'button_slide_hover',
			[
				'label' 		=> esc_html__( 'Button Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a.button_slide:hover,{{WRAPPER}} .btn-another-wrapper a.button_slide:focus' => 'box-shadow: inset 9.5em 0 0 0 {{VALUE}}',
                ],
				'condition'		=> [ 'button_style' => '9' ]
			]
        );

		$this->add_control(
			'button_box_shadow_color_hover',
			[
				'label' 		=> esc_html__( 'Button Box Shadow Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-another-wrapper a.button_offset:hover,{{WRAPPER}} .btn-another-wrapper a.button_offset:focus' => 'box-shadow: 0 0 0 0 {{VALUE}}, inset 6em 3.5em 0 0 {{VALUE}}',
                ],
				'condition'		=> [ 'button_style' => '10' ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border_hover',
				'label' 		=> esc_html__( 'Border', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .btn-wrapper a:hover,{{WRAPPER}} .btn-another-wrapper a:hover',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography_hover',
				'label' 		=> esc_html__( 'Button Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .btn-wrapper a:hover,{{WRAPPER}} .btn-another-wrapper a:hover',
			]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow_hover',
				'label' 		=> esc_html__( 'Box Shadow', 'safe' ),
				'selector' 		=> '{{WRAPPER}} .btn-wrapper a:hover,{{WRAPPER}} .btn-another-wrapper a:hover',
			]
		);

        $this->add_responsive_control(
			'button_hover_margin',
			[
				'label' 		=> esc_html__( 'Button Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a:hover,{{WRAPPER}} .btn-another-wrapper a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'button_hover_padding',
			[
				'label' 		=> esc_html__( 'Button Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a:hover,{{WRAPPER}} .btn-another-wrapper a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);

        $this->add_responsive_control(
			'button_hover_border_radius',
			[
				'label' 		=> esc_html__( 'Button Border Radius', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a:hover,{{WRAPPER}} .btn-another-wrapper a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);

		$this->add_control(
			'button_icon_hover_color',
			[
				'label' 		=> esc_html__( 'Button Icon Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a:hover i,{{WRAPPER}} .btn-another-wrapper a:hover i' => 'color: {{VALUE}}',
                ],
				'default'		=> '#fff',
				'condition'		=> [ 'button_icon_option' => 'yes' ],
			]
        );

		$this->add_responsive_control(
			'button_icon_hover_margin',
			[
				'label' 		=> esc_html__( 'Button Icon Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a:hover i,{{WRAPPER}} .btn-another-wrapper a:hover i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition'		=> [ 'button_icon_option' => 'yes' ],
			]
        );

        $this->add_responsive_control(
			'button_icon_hover_padding',
			[
				'label' 		=> esc_html__( 'Button Icon Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper a:hover i,{{WRAPPER}} .btn-another-wrapper a:hover i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition'		=> [ 'button_icon_option' => 'yes' ],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['button_style'] != '1' && $settings['button_style'] != '2' && $settings['button_style'] != '3' ){
			$this->add_render_attribute( 'wrapper', 'class', 'btn-another-wrapper' );
		}else{
			$this->add_render_attribute( 'wrapper','class', 'btn-wrapper' );
		}
        $this->add_render_attribute( 'wrapper', 'class', esc_attr(  $settings['button_align'] ) );

        if( $settings['button_style'] == '1' ) {
            $this->add_render_attribute( 'button', 'class', 'button');
        }elseif( $settings['button_style'] == '2' ) {
            $this->add_render_attribute( 'button', 'class', 'button_bubble');
        }elseif( $settings['button_style'] == '3' ) {
            $this->add_render_attribute( 'button', 'class', 'button_cta');
        }elseif( $settings['button_style'] == '4' ) {
            $this->add_render_attribute( 'button', 'class', 'button_fill');
        }elseif( $settings['button_style'] == '5' ) {
            $this->add_render_attribute( 'button', 'class', 'button_pulse');
        }elseif( $settings['button_style'] == '6' ) {
            $this->add_render_attribute( 'button', 'class', 'button_close');
        }elseif( $settings['button_style'] == '7' ) {
            $this->add_render_attribute( 'button', 'class', 'button_raise');
        }elseif( $settings['button_style'] == '8' ) {
            $this->add_render_attribute( 'button', 'class', 'button_up');
        }elseif( $settings['button_style'] == '9' ) {
            $this->add_render_attribute( 'button', 'class', 'button_slide');
        }else{
			$this->add_render_attribute( 'button', 'class', 'button_offset');
		}

		if( $settings['button_icon_option'] == 'yes' ){
			$this->add_render_attribute( 'button','class','btn_icon');
		}

        if( !empty( $settings['button_link']['url'] ) ) {
            $this->add_render_attribute( 'button','href',esc_url( $settings['button_link']['url'] ));
        }

        if( !empty( $settings['button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'button','rel','nofollow');
        }

        if( !empty( $settings['button_link']['is_external'] ) ) {
            $this->add_render_attribute( 'button','target','_blank');
        }

        $this->add_inline_editing_attributes( 'button_text', 'none' );

        echo '<!-- Button -->';
        echo '<div '.$this->get_render_attribute_string('wrapper').'>';
            if( !empty( $settings['button_text'] ) ) {

                echo '<a '.$this->get_render_attribute_string( 'button' ).'>';

				if( !empty( $settings['button_icon']['value'] ) && $settings['button_icon_option'] == 'yes' && $settings['icon_position'] == 'left' ){
					\Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
				}
				if( $settings['button_style'] == '3' ){
					echo '<span class="three_number">';
				}
                echo '<span '.$this->get_render_attribute_string( 'button_text' ).'>';
				echo esc_html( $settings['button_text'] );
                echo '</span>';
				if( $settings['button_style'] == '3' ){
					echo '</span>';
				}

				if( $settings['button_style'] == '2' ){
					echo '<span class="two_style one"></span><span class="two_style two"></span><span class="two_style three"></span><span class="two_style four"></span>';
				}
				if( !empty( $settings['button_icon']['value'] ) && $settings['button_icon_option'] == 'yes' && $settings['icon_position'] == 'right' ){
					\Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
				}

				echo '</a>';
            }
        echo '</div>';
        echo '<!-- End Button -->';
	}
    protected function _content_template() {
        ?>
        <#
        if( settings.button_style != '1' && settings.button_style != '2' && settings.button_style != '3' ){
            view.addRenderAttribute( 'wrapper', 'class', 'btn-another-wrapper' );
        }else{
            view.addRenderAttribute( 'wrapper', 'class', 'btn-wrapper' );
        }

        view.addRenderAttribute( 'wrapper', 'class', settings.button_align );

        if( settings.button_style == '1' ) {
            view.addRenderAttribute( 'button', 'class', 'button');
        }
        if( settings.button_style == '2' ) {
            view.addRenderAttribute( 'button', 'class', 'button_bubble');
        }
        if( settings.button_style == '3' ) {
            view.addRenderAttribute( 'button', 'class', 'button_cta');
        }
        if( settings.button_style == '4' ) {
            view.addRenderAttribute( 'button', 'class', 'button_fill');
        }
        if( settings.button_style == '5' ) {
            view.addRenderAttribute( 'button', 'class', 'button_pulse');
        }
        if( settings.button_style == '6' ) {
            view.addRenderAttribute( 'button', 'class', 'button_close');
        }
        if( settings.button_style == '7' ) {
            view.addRenderAttribute( 'button', 'class', 'button_raise');
        }
        if( settings.button_style == '8' ) {
            view.addRenderAttribute( 'button', 'class', 'button_up');
        }
        if( settings.button_style == '9' ) {
            view.addRenderAttribute( 'button', 'class', 'button_slide');
        }
        if( settings.button_style == '10' ){
            view.addRenderAttribute( 'button', 'class', 'button_offset');
        }

        if( settings.button_icon_option == 'yes' ){
            view.addRenderAttribute( 'button', 'class', 'btn_icon' );
        }

        if( settings.button_link.url ) {
            view.addRenderAttribute( 'button', 'href', settings.button_link.url );
        }

        if( settings.button_link.nofollow ) {
            view.addRenderAttribute( 'button','rel','nofollow' );
        }

        if( settings.button_link.is_external ) {
            view.addRenderAttribute( 'button', 'target', '_blank' );
        }

        view.addInlineEditingAttributes( 'button_text', 'none' );

        #>
        <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
            <# if( settings.button_text ) { #>
            <a {{{ view.getRenderAttributeString( 'button' ) }}}>
                <# if( settings.button_icon.value && settings.button_icon_option == 'yes' && settings.icon_position == 'left' ){ #>
                    <i class="{{ settings.button_icon.value }}"></i>
                <# }
                    if( settings.button_style == '3' ){
                #>
                    <span class="three_number">
                    <#
                }
                #>
                <span {{{ view.getRenderAttributeString( 'button_text' ) }}}>{{{settings.button_text}}}</span>
                <#
                if( settings.button_style == '3' ){
                    #>
                        </span>
                    <#
                }

                if( settings.button_style == '2' ){
                    #>
                    <span class="two_style one"></span><span class="two_style two"></span><span class="two_style three"></span><span class="two_style four"></span>
                    <#
                }
                if( settings.button_icon.value && settings.button_icon_option == 'yes' && settings.icon_position == 'right' ){
                    #>
                    <i class="{{ settings.button_icon.value }}"></i>
                    <#
                }
                #>
                </a>
            <#
                }
            #>
        </div>
        <?php
    }
}