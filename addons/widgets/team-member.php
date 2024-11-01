<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
/**
 *
 * Section Title Widget .
 *
 */
class Super_Addons_Team_Member extends Widget_Base {

	public function get_name() {
		return 'safeteammember';
	}

	public function get_title() {
		return esc_html__( 'Team Member', 'safe' );
	}

	public function get_icon() {
		return 'fas fa-user';
    }

	public function get_categories() {
		return [ 'safe' ];
	}

	public function get_style_depends() {
		return [ 'safeteammember' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'team_member_section',
			[
				'label' 	=> esc_html__( 'Team', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'team_style',
			[
				'label' 		=> esc_html__( 'Team Style', 'safe' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'one',
				'options' 		=> [
					'one'  		=> esc_html__( 'Style One', 'safe' ),
					'two' 		=> esc_html__( 'Style Two', 'safe' ),
					'three' 	=> esc_html__( 'Style Three', 'safe' ),
				],
			]
		);

		$this->add_control(
			'important_note',
			[
				'type' 				=> Controls_Manager::RAW_HTML,
				'raw' 				=> esc_html__( 'Set Custom Size Of Image. Like 150*150', 'safe' ),
				'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
				'condition'			=> [ 'team_style' => 'two' ],
			]
		);

        $this->add_control(
			'rotate_effect',
			[
				'label'         => esc_html__( 'Enable Rotate Image Style?', 'mfolio' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__( 'Yes', 'mfolio' ),
				'label_off'     => esc_html__( 'No', 'mfolio' ),
				'return_value'  => 'yes',
				'default'       => 'yes',
                'condition'		=> [ 'team_style' => 'three' ],
			]
		);

		$this->add_control(
			'team_member_image',
			[
				'label' 		=> esc_html__( 'Team Member Image', 'safe' ),
                'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' 	=> Utils::get_placeholder_image_src(),
				],
			]
        );
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'team_member_image_size',
				'include' 		=> [],
				'default' 		=> 'large',
			]
		);
        $this->add_control(
			'team_member_name',
			[
				'label' 		=> esc_html__( 'Team Member Name', 'safe' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'default'  		=> esc_html__( 'John Doe', 'safe' )
			]
        );

        $this->add_control(
			'team_member_position',
			[
				'label' 	=> esc_html__( 'Member Designation', 'safe' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'CEO', 'safe' ),
			]
        );

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon', [
				'label'         => esc_html__( 'Social Icon', 'safe' ),
				'type'          => Controls_Manager::ICONS,
                'default' 		=> [
					'value' 		=> 'fab fa-twitter',
					'library' 		=> 'solid',
				],
			]
		);

		$repeater->add_control(
			'social_icon_link',
			[
				'label' 		=> esc_html__( 'Social Icon Link', 'safe' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'safe' ),
				'show_external' => true,
				'default'       => [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);

		$this->add_control(
			'icons',
			[
				'label'     	=> esc_html__( 'Icons', 'safe' ),
				'type'      	=> Controls_Manager::REPEATER,
				'fields'    	=> $repeater->get_controls(),
				'title_field' 	=> '{{{ social_icon.value }}}',
                'condition'     => [ 'team_style!' => 'one' ]
			]
		);

        $this->add_control(
			'text_alignment',
			[
				'label' 		=> esc_html__( 'Text Alignment', 'safe' ),
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
			'general_section',
			[
				'label' 	=> esc_html__( 'General', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'team_background_color',
			[
				'label' 		=> esc_html__( 'Team Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_one,{{WRAPPER}} .team_two' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> ['team_style'	=>  [ 'one','two'] ]
			]
        );
		$this->add_control(
			'team_second_card_bg',
			[
				'label' 		=> esc_html__( 'Team Hover Second Card Background', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_one:after' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> ['team_style'	=>  'one'],
				'label_block'   => true,
			]
        );
		$this->add_control(
			'team_third_card_bg',
			[
				'label' 		=> esc_html__( 'Team Hover Third Card Background', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_one:before' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> ['team_style'	=>  'one'],
				'label_block'   => true,
			]
        );
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'box_shadow',
				'label' 		=> esc_html__( 'Box Shadow', 'safe' ),
				'selector' 		=> '{{WRAPPER}} .team_one,{{WRAPPER}} .team_two,{{WRAPPER}} .team_three',
				'condition'		=> ['team_style'	=>  [ 'one','two','three'] ]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'second_box_shadow',
				'label' 		=> esc_html__( 'Second Card Box Shadow', 'safe' ),
				'selector' 		=> '{{WRAPPER}} .team_one:after',
				'condition'		=> ['team_style'	=>  'one']
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'third_box_shadow',
				'label' 		=> esc_html__( 'Third Card Box Shadow', 'safe' ),
				'selector' 		=> '{{WRAPPER}} .team_one:before',
				'condition'		=> ['team_style'	=>  'one']
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' 		=> esc_html__( 'Border Radius', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .team_one,{{WRAPPER}} .team_two,{{WRAPPER}} .team_three' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'		=> ['team_style'	=>  ['one','two','three'] ]
			]
		);

		$this->add_control(
			'second_border_radius',
			[
				'label' 		=> esc_html__( 'Second Box Border Radius', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .team_one:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'		=> ['team_style'	=>  'one']
			]
		);

		$this->add_control(
			'third_border_radius',
			[
				'label' 		=> esc_html__( 'Third Box Border Radius', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .team_one:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'		=> ['team_style'	=>  'one']
			]
		);
		$this->add_control(
			'team_second_hover_top_shape_bg',
			[
				'label' 		=> esc_html__( 'Hover Top Shape Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_two .imgBx::before' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> ['team_style'	=>  'two'],
			]
        );
		$this->add_control(
			'team_second_hover_bottom_shape_bg',
			[
				'label' 		=> esc_html__( 'Hover Bottom Shape Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_two .social' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> ['team_style'	=>  'two'],
			]
        );
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'team_second_image_box_shadow',
				'label' 		=> esc_html__( 'Image Box Shadow On Hover', 'safe' ),
				'selector' 		=> '{{WRAPPER}} .team_two:hover .imgBx img',
				'condition'		=> ['team_style'	=>  'two'],
			]
        );
		$this->add_control(
			'team_second_image_bg',
			[
				'label' 		=> esc_html__( 'Team Hover Image Background', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_two .imgBx::after' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> ['team_style'	=>  'two'],
			]
        );
		$this->add_control(
			'team_overlay_color',
			[
				'label' 		=> esc_html__( 'Team Hover Overlay Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_three .imgBx' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> ['team_style'	=>  'three' ],
			]
        );

		$this->end_controls_section();

        $this->start_controls_section(
			'team_name_section',
			[
				'label' 	=> esc_html__( 'Team Style', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'team_color',
			[
				'label' 		=> esc_html__( 'Name Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_one .content_one h2,{{WRAPPER}} .team_two .content_two h3,{{WRAPPER}} .team_three .content_three h2' => 'color: {{VALUE}}',
                ],
                'condition' 	=> [
                    'team_member_name!'    => ''
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'team_typography',
				'label' 		=> esc_html__( 'Name Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .team_one .content_one h2,{{WRAPPER}} .team_two .content_two h3,{{WRAPPER}} .team_three .content_three h2',
                'condition' 	=> [
                    'team_member_name!'    => ''
                ]
			]
		);

        $this->add_responsive_control(
			'name_margin',
			[
				'label' 		=> esc_html__( 'Name Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .team_one .content_one h2,{{WRAPPER}} .team_two .content_two h3,{{WRAPPER}} .team_three .content_three h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' 	=> [
                    'team_member_name!'    => ''
                ]
			]
        );

        $this->add_responsive_control(
			'name_padding',
			[
				'label' 		=> esc_html__( 'Name Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .team_one .content_one h2,{{WRAPPER}} .team_two .content_two h3,{{WRAPPER}} .team_three .content_three h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' 	=> [
                    'team_member_name!'    => ''
                ],
				'separator'		=> 'after',
			]
		);
        $this->add_control(
			'designation_color',
			[
				'label' 		=> esc_html__( 'Designation Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_one .content_one span,{{WRAPPER}} .team_two .content_two h4,{{WRAPPER}} .team_three .content_three .job-title' => 'color: {{VALUE}}',
                ],
                'condition' 	=> [
                    'team_member_position!'    => ''
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'designation_typography',
				'label' 		=> esc_html__( 'Designation Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .team_one .content_one span,{{WRAPPER}} .team_two .content_two h4,{{WRAPPER}} .team_three .content_three .job-title',
                'condition' 	=> [
                    'team_member_position!'    => ''
                ]
			]
		);

        $this->add_responsive_control(
			'designation_margin',
			[
				'label' 		=> esc_html__( 'Designation Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .team_one .content_one span,{{WRAPPER}} .team_two .content_two h4,{{WRAPPER}} .team_three .content_three .job-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' 	=> [
                    'team_member_position!'    => ''
                ]
			]
        );

        $this->add_responsive_control(
			'designation_padding',
			[
				'label' 		=> esc_html__( 'Designation Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .team_one .content_one span,{{WRAPPER}} .team_two .content_two h4,{{WRAPPER}} .team_three .content_three .job-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' 	=> [
                    'team_member_position!'    => ''
                ]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_icon',
			[
				'label' 	=> esc_html__( 'Social Icon', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
                    'team_style'    => [ 'two','three' ],
                ]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__( 'Icon Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_two .social li a,{{WRAPPER}} .team_three .social-icons li a' => 'color: {{VALUE}}',
                ],

			]
        );

		$this->add_control(
			'icon_hover_color',
			[
				'label' 		=> esc_html__( 'Icon Hover Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_two .social li a:hover i,{{WRAPPER}} .team_three .social-icons li a:hover i' => 'color: {{VALUE}}',
                ],

			]
        );

		$this->add_control(
			'icon_background_hover_color',
			[
				'label' 		=> esc_html__( 'Icon Hover Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .team_two .social li a:hover,{{WRAPPER}} .team_three .social-icons li a:hover' => 'background-color: {{VALUE}}',
                ],

			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'icon_typography',
				'label' 		=> esc_html__( 'Icon Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .team_two .social li a i,{{WRAPPER}} .team_three .social-icons li a i',
			]
		);

        $this->add_responsive_control(
			'icon_margin',
			[
				'label' 		=> esc_html__( 'Icon Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .team_two .social li a,{{WRAPPER}} .team_three .social-icons li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .team_two .social li a,{{WRAPPER}} .team_three .social-icons li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        // Content Alignment
		$this->add_render_attribute( 'content_style', 'class', $settings['text_alignment'] );

        // Different Class On Team Member
		if( $settings['team_style'] == 'one' ){
        	$this->add_render_attribute('wrapper','class','team_one');
        	$this->add_render_attribute('content_style','class','content_one');
		}elseif( $settings['team_style'] == 'two' ){
			$this->add_render_attribute( 'wrapper','class','team_two' );
			$this->add_render_attribute('content_style','class','content_two');
		}elseif( $settings['team_style'] == 'three' ){
			$this->add_render_attribute( 'wrapper','class','team_three' );
			$this->add_render_attribute( 'content_style','class','content_three' );
            if( $settings['rotate_effect'] == 'yes' ){
                $this->add_render_attribute( 'content_style','class','jane' );
                $this->add_render_attribute( 'wrapper','class','profile-two' );
            }
		}

		// Text Alignment
		$this->add_render_attribute( 'wrapper', 'class', $settings['text_alignment'] );

		if( $settings['team_style'] == 'three' ){
			echo '<div class="style_three_wrapper">';
		}

		echo '<div '.$this->get_render_attribute_string('wrapper').' >';
			if( !empty( $settings['team_member_image'] ) ){
                if( $settings['team_style'] == 'three' && $settings['rotate_effect'] == 'yes' ){
                    $three_rotate_div_class = 'profile-img--two';
                }else{
                    $three_rotate_div_class = '';
                }
				echo '<div class="imgBx '.esc_attr( $three_rotate_div_class ).'">';
					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'team_member_image_size', 'team_member_image' );
				echo '</div>';
			}
			echo '<div '.$this->get_render_attribute_string('content_style').' >';
				if( ( $settings['team_style'] == 'one' ) || ( $settings['team_style'] == 'three' ) ){
					if( !empty( $settings['team_member_name'] ) ){
						echo '<h2>'.esc_html( $settings['team_member_name'] ).'</h2>';
					}
					if( !empty( $settings['team_member_position'] ) ){
						echo '<span class="job-title">'.esc_html( $settings['team_member_position'] ).'</span>';
					}
				}elseif( $settings['team_style'] == 'two' ){
					if( !empty( $settings['team_member_name'] ) ){
						echo '<h3 class="name">'.esc_html( $settings['team_member_name'] ).'</h3>';
					}
					if( !empty( $settings['team_member_position'] ) ){
						echo '<h4 class="title">'.esc_html( $settings['team_member_position'] ).'</h4>';
					}
				}
			echo '</div>';
			if( $settings['team_style'] == 'two' ){
				if( !empty( $settings['icons'] ) ){
					echo '<ul class="social">';
						foreach( $settings['icons'] as $social_icon ){
							$target_one 	= $social_icon['social_icon_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow_one 	= $social_icon['social_icon_link']['nofollow'] ? ' rel="nofollow"' : '';
							echo '<li><a '.wp_kses_post( $target_one.$nofollow_one ).' href="'.esc_url( $social_icon['social_icon_link']['url'] ).'" aria-hidden="true"><i class="'.esc_attr( $social_icon['social_icon']['value'] ).'"></i></a></li>';
						}
					echo '</ul>';
				}
			}elseif( $settings['team_style'] == 'three' ){
				if( !empty( $settings['icons'] ) ){
					echo '<ul class="social-icons">';
						foreach( $settings['icons'] as $social_icon ){
							$target_two 	= $social_icon['social_icon_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow_two 	= $social_icon['social_icon_link']['nofollow'] ? ' rel="nofollow"' : '';
							echo '<li><a '.wp_kses_post( $target_two.$nofollow_two ).' href="'.esc_url( $social_icon['social_icon_link']['url'] ).'" aria-hidden="true"><i class="'.esc_attr( $social_icon['social_icon']['value'] ).'"></i></a></li>';
						}
					echo '</ul>';
				}
			}
		echo '</div>';
		if( $settings['team_style'] == 'three' ){
			echo '</div>';
		}
	}

}
