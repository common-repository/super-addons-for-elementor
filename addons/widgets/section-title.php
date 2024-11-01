<?php
    use \Elementor\Widget_Base;
    use \Elementor\Controls_Manager;
    use \Elementor\Group_Control_Typography;
    use \Elementor\Group_Control_Border;
    use \Elementor\Group_Control_Background;
    use \Elementor\Group_Control_Box_Shadow;
/**
*
* Section Title Widget .
*
*/
class Super_Addons_Section_Title_Widget extends Widget_Base {

	public function get_name() {
		return 'safesectiontitle';
	}

	public function get_title() {
		return esc_html__( 'Section Title', 'safe' );
	}

	public function get_icon() {
		return 'fas fa-heading';
    }

	public function get_categories() {
		return [ 'safe' ];
	}

	public function get_style_depends() {
		return [ 'safesectiontitle' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label' 	=> esc_html__( 'Section Title', 'safe' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'title_style',
			[
				'label' 		=> esc_html__( 'Title Style', 'safe' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'one' 		     => 'Default Style',
					'two' 		     => 'Text Image Bg',
					'three' 	     => 'Video Bg',
				],
				'default' 	=> 'one',
			]
        );
		$this->add_control(
			'important_note',
			[
				'type' 				=> Controls_Manager::RAW_HTML,
				'raw' 				=> esc_html__( 'Please Set Background Image Or Color From The Style Tab.', 'safe' ),
				'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
				'condition'			=> ['title_style' => 'two']
			]
		);
		$this->add_control(
			'important_note_two',
			[
				'type' 				=> Controls_Manager::RAW_HTML,
				'raw' 				=> esc_html__( 'Please Set Background Video From Style Tab And Make Sure Your Video Is Mp4 Format', 'safe' ),
				'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
				'condition'			=> ['title_style' => 'three']
			]
		);
        $this->add_control(
			'section_title',
			[
				'label' 		=> esc_html__( 'Section Title', 'safe' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'default'  		=> esc_html__( 'Section Title', 'safe' )
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
			]
        );



        $this->add_control(
			'section_subtitle',
			[
				'label' 	=> esc_html__( 'Section Subtitle', 'safe' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'Section Subtitle', 'safe' ),
				'condition'	=> [
					'title_style!'  => 'three'
				]
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
				'default' 	=> 'h3',
				'condition'	=> [
					'title_style!'  => 'three'
				]
			]
		);

        $this->add_control(
			'section_short_desc',
			[
				'label' 		=> esc_html__( 'Section Short Description', 'safe' ),
                'type' 			=> Controls_Manager::TEXTAREA,
                'default'  		=> esc_html__( 'Section Short Description', 'safe' ),
				'condition'	=> [
					'title_style!'  => 'three'
				]
			]
        );

        $this->add_control(
			'section_title_align',
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
			'section_background_color',
			[
				'label' 		=> esc_html__( 'Section Background Color', 'safe' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .section-title' => 'background-color: {{VALUE}}',
                ],
				'condition'		=> ['title_style!'	=>  'three']
			]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'box_shadow',
				'label' 		=> esc_html__( 'Box Shadow', 'safe' ),
				'selector' 		=> '{{WRAPPER}} .section-title',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' 		=> esc_html__( 'Border Radius', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .section-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'video_background',
			[
				'label' 		=> esc_html__( 'Set The Video Url', 'safe' ),
                'type' 			=> Controls_Manager::TEXT,
                'default'  		=> esc_html__( 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4', 'safe' ),
				'condition'	    => ['title_style'	=>  'three'],
			]
        );

		$this->add_control(
			'height',
			[
				'label' 		=> esc_html__( 'Height', 'safe' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' 		=> [
					'px' 	=> [
						'min' 	=> 0,
						'max' 	=> 1000,
						'step' 	=> 5,
					],
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> 'px',
					'size' 		=> 155,
				],
				'selectors' => [
					'{{WRAPPER}} .banner' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'	=> ['title_style'	=>  'three'],
			]
		);

		$this->add_responsive_control(
			'section_wrapper_margin',
			[
				'label' 		=> esc_html__( 'Section Wrapper Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'section_wrapper_padding',
			[
				'label' 		=> esc_html__( 'Section Wrapper Padding', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' 	=> 'after'
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
				'label' 		=> esc_html__( 'Section Title Color', 'safe' ),
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
            Group_Control_Background::get_type(),
            [
                'name' 		=> 'background',
                'label' 	=> esc_html__( 'Background', 'safe' ),
                'types' 	=> [ 'classic', 'gradient' ],
                'selector' 	=> '{{WRAPPER}} .section-title .style-two',
                'condition'	=> ['title_style'	=>  'two']
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_title_typography',
				'label' 		=> esc_html__( 'Section Title Typography', 'safe' ),
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
					'{{WRAPPER}} .section-title p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .section-title p' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_desc_typography',
				'label' 		=> esc_html__( 'Section Description Typography', 'safe' ),
                'selector' 		=> '{{WRAPPER}} .section-title p',
			]
        );

        $this->add_responsive_control(
			'section_desc_margin',
			[
				'label' 		=> esc_html__( 'Section Description Margin', 'safe' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .section-title p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .section-title p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'wrapper', 'class', 'section-title' );

		if( $settings['title_style'] == 'three' ){
			$this->add_render_attribute( 'wrapper', 'class', 'banner' );
            $this->add_render_attribute( 'section_title', 'class', 'style-three');
		}

        $this->add_render_attribute( 'wrapper', 'class', $settings['section_title_align'] );

        $this->add_render_attribute( 'section_title', 'class', 'title-selector' );
        $this->add_inline_editing_attributes( 'section_title', 'basic' );

		if( $settings['title_style'] == 'two' ){
			$this->add_render_attribute( 'section_title', 'class', 'style-two');
			$this->add_render_attribute( 'section_title', 'data-text', wp_kses_post( $settings['section_title'] ) );
		}

        $this->add_inline_editing_attributes( 'section_subtitle', 'basic' );
        $this->add_render_attribute( 'section_subtitle', 'class', 'subtitle-selector' );

        $this->add_inline_editing_attributes( 'section_short_desc', 'advanced' );
        $this->add_render_attribute( 'section_short_desc', 'class', 'section_short_desc' );

        echo '<!-- Section Title -->';
		echo '<div '.$this->get_render_attribute_string( 'wrapper' ).' >';
			if( !empty( $settings['section_subtitle'] ) ) {
            	echo '<'.esc_attr($settings['section_subtitle_tag']).' '.$this->get_render_attribute_string( 'section_subtitle' ).'>'.wp_kses_post( $settings['section_subtitle'] ).'</'.esc_attr($settings['section_subtitle_tag']).'>';
			}
			if( $settings['title_style'] == 'three' ){
				echo '<video autoplay muted loop>';
					echo '<source src="'.esc_url( $settings['video_background'] ).'" type="video/mp4">';
				echo '</video>';
			}
			if( !empty( $settings['section_title'] ) ) {
				echo '<'.esc_attr( $settings['section_title_tag'] ).' '.$this->get_render_attribute_string( 'section_title' ).'>'.wp_kses_post( $settings['section_title'] ).'</'.esc_attr( $settings['section_title_tag'] ).'>';
			}
			if( !empty( $settings['section_short_desc'] ) ) {
				echo '<p '.$this->get_render_attribute_string( 'section_short_desc' ).'>'. wp_kses_post( $settings['section_short_desc'] ).'</p>';
			}
        echo '</div>';
        echo '<!-- End Section Title -->';
	}

    protected function _content_template() {
        ?>
        <#
            view.addRenderAttribute( 'wrapper', 'class', 'section-title' );
            view.addRenderAttribute( 'wrapper', 'class', settings.section_title_align );

    		if( settings.title_style == 'three' ){
                view.addRenderAttribute( 'wrapper', 'class', 'banner' );
                view.addRenderAttribute( 'section_title', 'class', 'style-three' );
            }

            view.addInlineEditingAttributes( 'section_title', 'basic' );
            view.addRenderAttribute( 'section_title', 'class', 'title-selector' );

            view.addInlineEditingAttributes( 'section_subtitle', 'basic' );
            view.addRenderAttribute( 'section_subtitle', 'class', 'subtitle-selector' );

            view.addInlineEditingAttributes( 'section_short_desc', 'basic' );
            view.addRenderAttribute( 'section_short_desc', 'class', 'section_short_desc' );

            if( settings.title_style == 'two' ){
                view.addRenderAttribute( 'section_title', 'class', 'style-two' );
                view.addRenderAttribute( 'section_title', 'data-text', settings.section_title );
            }

		#>
        <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
            <#
                if( settings.section_subtitle ){
            #>
            <{{settings.section_subtitle_tag}} {{{ view.getRenderAttributeString( 'section_subtitle' ) }}}>{{{settings.section_subtitle}}}</{{settings.section_subtitle_tag}}>
            <#
                }
            #>
            <#
                if( settings.title_style == 'three' ){
            #>
            <video autoplay muted loop>
                <source src="{{settings.video_background}}" type="video/mp4">';
            </video>
            <#
                }
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
        <?php
    }

}