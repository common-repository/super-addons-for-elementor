<?php
    use \Elementor\Widget_Base;
    use \Elementor\Controls_Manager;
    use \Elementor\Group_Control_Typography;
    use \Elementor\Group_Control_Border;
    use \Elementor\Group_Control_Background;
    use \Elementor\Group_Control_Box_Shadow;
    use \Elementor\Utils;
/**
*
* Section Title Widget .
* 
*/
class Super_Addons_Cta extends Widget_Base {

	public function get_name() {
		return 'safecta';
	}

	public function get_title() {
		return esc_html__( 'Call To Action', 'safe' );
	}

	public function get_icon() {
		return 'fas fa-directions';
    }

	public function get_categories() {
		return [ 'safe' ];
	}

	public function get_style_depends() {
		return [ 'safecalltoaction','safebutton' ];
	}
    
    public function get_keywords()
    {
        return [
            'call to action',
            'safe call to action',
            'cta',
            'safe cta',
            'button',
            'buy button',
            'action box',
            'safe',
            'super addons'
        ];
    }
    
    public function get_custom_help_url() {
        return 'https://superaddons.themehat.com/elementor/docs/call-to-action/';
    }
    
	protected function _register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label' 	=> esc_html__( 'Content Settings', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        
        $this->add_control(
            'safe_cta_type',
            [
                'label'         => esc_html__( 'Content Style', 'safe' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'cta-basic',
                'label_block'   => false,
                'options'   => [
                    'cta-basic'     => esc_html__( 'Basic', 'safe' ),
                    'cta-flex'      => esc_html__( 'Flex Grid', 'safe' ),
                    'cta-icon-flex' => esc_html__( 'Flex Grid with Icon', 'safe' ),
                ],
            ]
        );
        
        $this->add_control(
            'safe_cta_color_type',
            [
                'label'         => esc_html__( 'Color Style', 'safe' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'cta-bg-color',
                'label_block'   => false,
                'options'   => [
                    'cta-bg-color'      => esc_html__( 'Background Color', 'safe'),
                    'cta-bg-img'        => esc_html__( 'Background Image', 'safe'),
                    'cta-bg-img-fixed'  => esc_html__( 'Background Fixed Image', 'safe'),
                ],
            ]
        );
        
        $this->add_control(
			'cta_content_alignment',
			[
				'label' 		=> esc_html__( 'Alignment', 'safe' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'text-left' 	=> [
						'section_title' 		=> esc_html__( 'Left', 'safe' ),
						'icon' 			=> 'fa fa-align-left',
					],
					'text-center' 	=> [
						'section_title' 		=> esc_html__( 'Center', 'safe' ),
						'icon' 			=> 'fa fa-align-center',
					],
					'text-right' 	=> [
						'section_title' 		=> esc_html__( 'Right', 'safe' ),
						'icon' 			=> 'fa fa-align-right',
					],
				],
				'default' 		=> 'text-left',
				'toggle' 		=> true,
                'condition'     => [ 'safe_cta_type' => 'cta-basic' ]
			]
		);
        
        $this->add_control(
			'cta_icon',
			[
				'label' 		=> esc_html__( 'Cta Icon', 'safe' ),
				'type' 			=> Controls_Manager::ICONS,
                'default' => [
					'value'        => 'fas fa-bullhorn',
					'library'      => 'solid',
				],
				'condition'		=> [ 'safe_cta_type' => 'cta-icon-flex' ],
			]
		);
        
        $this->add_control(
			'section_subtitle',
			[
				'label' 	=> esc_html__( 'Subtitle', 'safe' ),
                'type' 		=> Controls_Manager::TEXTAREA,
			]
        );

        $this->add_control(
			'section_subtitle_tag',
			[
				'label' 		=> esc_html__( 'Subitle Tag', 'safe' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'h1' 	=> 'H1',
					'h2' 	=> 'H2',
					'h3' 	=> 'H3',
					'h4' 	=> 'H4',
					'h5' 	=> 'H5',
					'h6' 	=> 'H6',
				],
				'default' 	=> 'h4',
				'condition' => [ 'section_subtitle!' => '' ]
			]
		);
		
        $this->add_control(
			'section_title',
			[
				'label' 		=> esc_html__( 'Title', 'safe' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'default'  		=> esc_html__( 'Super Addons For Elementor', 'safe' )
			]
        );

        $this->add_control(
			'section_title_tag',
			[
				'label' 		=> esc_html__( 'Title Tag', 'safe' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'h1' 	=> 'H1',
					'h2' 	=> 'H2',
					'h3' 	=> 'H3',
					'h4' 	=> 'H4',
					'h5' 	=> 'H5',
					'h6' 	=> 'H6',
				],
				'default' 	=> 'h2',
				'condition' => [ 'section_title!' => '' ]
			]
        );

        $this->add_control(
			'section_short_desc',
			[
				'label' 		=> esc_html__( 'Content', 'safe' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'default'  		=> esc_html__( 'Add a strong one liner supporting the heading above and giving users a reason to click on the button below.', 'safe' ),
			]
        );

        $this->end_controls_section();
        
        // Button Start From Here
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
        $this->end_controls_section();
        // Button End Here
        
		$this->start_controls_section(
			'general_section',
			[
				'label' 	=> esc_html__( 'General', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'section_background',
			[
				'label' 	=> esc_html__( 'Choose Image', 'safe' ),
				'type' 		=> Controls_Manager::MEDIA,
				'default' 	=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
				'selectors' => [
                    '{{WRAPPER}} .safe-call-to-action.bg-img' 		=> 'background-image: url({{URL}});',
                    '{{WRAPPER}} .safe-call-to-action.bg-img-fixed' => 'background-image: url({{URL}});',
                ],
                'condition' => [ 'safe_cta_color_type!' => 'cta-bg-color' ]
			]
		);
		
		$this->add_control(
			'section_background_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .safe-call-to-action' => 'background-color: {{VALUE}}',
                ],
				'condition' => [ 'safe_cta_color_type' => 'cta-bg-color' ]
			]
        );

		$this->end_controls_section();

        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' 	=> esc_html__( 'Title Style', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'section_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .title-selector' => 'color: {{VALUE}}',
                ],
                'condition' 	=> [
                    'section_title!'    => ''
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .title-selector',
                'condition' 	=> [
                    'section_title!'    => ''
                ]
			]
		);

        $this->add_responsive_control(
			'section_title_margin',
			[
				'label' 		=> esc_html__( 'Section Title Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .title-selector' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' 	=> [
                    'section_title!'    => ''
                ]
			]
        );

        $this->add_responsive_control(
			'section_title_padding',
			[
				'label' 		=> esc_html__( 'Section Title Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .title-selector' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' 	=> [
                    'section_title!'    => ''
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'label' 		=> esc_html__( 'Border', 'safe' ),
				'selector' 		=> '{{WRAPPER}} .title-selector',
				'condition' 	=> [
                    'section_title!'    => ''
                ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_subtitle_style_section',
			[
				'label' 	=> esc_html__( 'Subtitle Style', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
                    'section_subtitle!'    => ''
                ],
			]
		);
		
		$this->add_control(
			'section_subtitle_color',
			[
				'label' 		=> esc_html__( 'Section Subtitle Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .subtitle-selector' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_subtitle_typography',
				'label' 		=> esc_html__( 'Section Subtitle Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .subtitle-selector',
			]
        );

        $this->add_responsive_control(
			'section_subtitle_margin',
			[
				'label' 		=> esc_html__( 'Section Subtitle Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .subtitle-selector' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'section_subtitle_padding',
			[
				'label' 		=> esc_html__( 'Section Subtitle Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .section_short_desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style_section',
			[
				'label' 	=> esc_html__( 'Description Style', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
                    'section_short_desc!'    => ''
                ],
			]
		);
		
        $this->add_control(
			'section_desc_color',
			[
				'label' 		=> esc_html__( 'Section Description Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .section_short_desc' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_desc_typography',
				'label' 		=> esc_html__( 'Section Description Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .section_short_desc',
			]
        );

        $this->add_responsive_control(
			'section_desc_margin',
			[
				'label' 		=> esc_html__( 'Section Description Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .section_short_desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'section_desc_padding',
			[
				'label' 		=> esc_html__( 'Section Description Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .section_short_desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style_section',
			[
				'label' 	=> esc_html__( 'Icon Style', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		
        $this->add_control(
			'section_icon_color',
			[
				'label' 		=> esc_html__( 'Section Icon Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .cta_icon i' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_icon_typography',
				'label' 		=> esc_html__( 'Section Icon Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .cta_icon i',
			]
        );

        $this->add_responsive_control(
			'section_icon_margin',
			[
				'label' 		=> esc_html__( 'Section Icon Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .cta_icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'section_icon_padding',
			[
				'label' 		=> esc_html__( 'Section Icon Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .cta_icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();
        
        // Button Style Start From Here
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
					'{{WRAPPER}} .btn-wrapper a,.btn-another-wrapper a' => 'color: {{VALUE}}',
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
				'name' 			=> 'button_border',
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
				'label' 		=> esc_html__( 'Box Shadow', 'traffil' ),
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
					'{{WRAPPER}} .btn-wrapper a:hover,{{WRAPPER}} .btn-another-wrapper a:hover' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .btn-another-wrapper a:hover' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .btn-another-wrapper a:hover' => 'color: {{VALUE}}',
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
				'label' 		=> esc_html__( 'Box Shadow', 'traffil' ),
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

        $this->add_render_attribute( 'wrapper', 'class', 'safe-call-to-action' );
        
        if( $settings['safe_cta_type'] == 'cta-basic' ){
            $this->add_render_attribute( 'wrapper', 'class', $settings['cta_content_alignment'] );
        }elseif( $settings['safe_cta_type'] == 'cta-flex' ){
            $this->add_render_attribute( 'wrapper', 'class', 'cta_flex' );
        }else{
            $this->add_render_attribute( 'wrapper', 'class', 'cta_icon_flex' );
        }
        
        if( $settings['safe_cta_color_type'] == 'cta-bg-img' ){
            $this->add_render_attribute( 'wrapper', 'class', 'bg-img' );
        }elseif( $settings['safe_cta_color_type'] == 'cta-bg-img-fixed' ){
            $this->add_render_attribute( 'wrapper', 'class', 'bg-img-fixed' );
        }else{
            $this->add_render_attribute( 'wrapper', 'class', 'bg-color' );
        }
        
        $this->add_render_attribute( 'section_title', 'class', 'title-selector' );
        $this->add_inline_editing_attributes( 'section_title', 'basic' );

        $this->add_inline_editing_attributes( 'section_subtitle', 'basic' );
        $this->add_render_attribute( 'section_subtitle', 'class', 'subtitle-selector' );

        $this->add_inline_editing_attributes( 'section_short_desc', 'advanced' );
        $this->add_render_attribute( 'section_short_desc', 'class', 'section_short_desc' );
        
        /**
         * The Freaking Button
         */ 
        if( $settings['button_style'] != '1' && $settings['button_style'] != '2' && $settings['button_style'] != '3' ){
			$this->add_render_attribute( 'cta_button_wrapper', 'class', 'btn-another-wrapper' );
		}else{
			$this->add_render_attribute( 'cta_button_wrapper','class', 'btn-wrapper' );
		}

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
        
        echo '<!-- Call To Action -->';
		echo '<div '.$this->get_render_attribute_string( 'wrapper' ).' >';
            if( !empty( $settings['cta_icon']['value'] ) && $settings['safe_cta_type'] == 'cta-icon-flex' ){
                echo '<div class="cta_icon">';
                    \Elementor\Icons_Manager::render_icon( $settings['cta_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</div>';
            }
            echo '<div class="content">';
    			if( !empty( $settings['section_subtitle'] ) ) {
                	echo '<'.esc_attr($settings['section_subtitle_tag']).' '.$this->get_render_attribute_string( 'section_subtitle' ).'>'.wp_kses_post( $settings['section_subtitle'] ).'</'.esc_attr($settings['section_subtitle_tag']).'>';
    			}
    			if( !empty( $settings['section_title'] ) ) {
    				echo '<'.esc_attr( $settings['section_title_tag'] ).' '.$this->get_render_attribute_string( 'section_title' ).'>'.wp_kses_post( $settings['section_title'] ).'</'.esc_attr( $settings['section_title_tag'] ).'>';
    			}
    			if( !empty( $settings['section_short_desc'] ) ) {
    				echo '<p '.$this->get_render_attribute_string( 'section_short_desc' ).'>'. wp_kses_post( $settings['section_short_desc'] ).'</p>';
    			}
            echo '</div>';
            /**
             * Button Start From Here
             */
            echo '<!-- Button -->';
            echo '<div '.$this->get_render_attribute_string('cta_button_wrapper').'>';
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
        echo '</div>';
        echo '<!-- End Section Title -->';
	}

    protected function _content_template() {
        ?>
        <#
            view.addRenderAttribute( 'wrapper', 'class', 'safe-call-to-action' );
            
            if( settings.safe_cta_type == 'cta-basic' ){
                view.addRenderAttribute( 'wrapper', 'class', settings.cta_content_alignment );
            }
            if( settings.safe_cta_type == 'cta-flex' ){
                view.addRenderAttribute( 'wrapper', 'class', 'cta_flex' );
            }
            if( settings.safe_cta_type == 'cta-icon-flex' ){
                view.addRenderAttribute( 'wrapper', 'class', 'cta_icon_flex' );
            }
            
            if( settings.safe_cta_color_type == 'cta-bg-img' ){
                view.addRenderAttribute( 'wrapper', 'class', 'bg-img' );
            }
            if( settings.safe_cta_color_type == 'cta-bg-img-fixed' ){
                view.addRenderAttribute( 'wrapper', 'class', 'bg-img-fixed' );
            }
            if( settings.safe_cta_color_type == 'cta-bg-color' ){
                view.addRenderAttribute( 'wrapper', 'class', 'bg-color' );
            }
            
            view.addInlineEditingAttributes( 'section_title', 'basic' );
            view.addRenderAttribute( 'section_title', 'class', 'title-selector' );

            view.addInlineEditingAttributes( 'section_subtitle', 'basic' );
            view.addRenderAttribute( 'section_subtitle', 'class', 'subtitle-selector' );

            view.addInlineEditingAttributes( 'section_short_desc', 'basic' );
            view.addRenderAttribute( 'section_short_desc', 'class', 'section_short_desc' );
            
            
            if( settings.button_style != '1' && settings.button_style != '2' && settings.button_style != '3' ){
                view.addRenderAttribute( 'cta_button_wrapper', 'class', 'btn-another-wrapper' );
            }else{
                view.addRenderAttribute( 'cta_button_wrapper', 'class', 'btn-wrapper' );
            }
    
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
            <# if( settings.safe_cta_type == 'cta-icon-flex' && settings.cta_icon.value ){ #>
            <div class="cta_icon">
                <i class="{{ settings.cta_icon.value }}"></i>
            </div>
            <# } #>
            <div class="content">
                <#
                    if( settings.section_subtitle ){
                #>
                <{{settings.section_subtitle_tag}} {{{ view.getRenderAttributeString( 'section_subtitle' ) }}}>{{{settings.section_subtitle}}}</{{settings.section_subtitle_tag}}>
                <#
                    }
                #>
                <#
                    if( settings.section_title ){
                #>
                <{{settings.section_title_tag}} {{{ view.getRenderAttributeString( 'section_title' ) }}}>{{{settings.section_title}}}</{{settings.section_title_tag}}>
                <#
                    }
                #>
                <#
                    if( settings.section_short_desc ){
                #>
                <p {{{ view.getRenderAttributeString( 'section_short_desc' ) }}}>{{{settings.section_short_desc}}}</p>
                <#
                    }
                #>
            </div>
            <div {{{ view.getRenderAttributeString( 'cta_button_wrapper' ) }}}>
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
        </div>
        <?php
    }

}