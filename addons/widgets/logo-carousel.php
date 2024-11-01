<?php
	use \Elementor\Widget_Base;
	use \Elementor\Controls_Manager;
	use \Elementor\Utils;
	use \Elementor\Repeater;
	/**
	* Logo Carousel.
	*
	* @since 1.0.0
	*/
class Super_Addons_Logo_Carousel extends Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Banner widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'safelogocarousel';
	}

	/**
	* Get widget title.
	*
	* Retrieve Banner widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Logo Carousel', 'safe' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Banner widget icon.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget icon.
	*/
	public function get_icon() {
		return 'fa fa-code';
	}

	/**
	* Get widget categories.
	*
	* Retrieve the list of categories the Banner widget belongs to.
	*
	* @since 1.0.0
	* @access public
	*
	* @return array Widget categories.
	*/
	public function get_categories() {
		return [ 'safe' ];
	}

	public function get_style_depends() {
		return [ 'owl-carousel' ];
	}

	public function get_script_depends() {
		return [ 'owlcarousel' ];
	}
	// Add The Input For User
	protected function _register_controls(){

		$this->start_controls_section(
			'brand_content',
			[
				'label'		=> esc_html__( 'Logo Carousel', 'safe' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
            'logo_image',
            [
                'label' 	=> esc_html__( 'Logo Image', 'safe' ),
                'type' 		=> Controls_Manager::MEDIA,
                'default' 	=> [
                    'url' 	=> Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
			'website_link',
			[
				'label'         => esc_html__( 'Link', 'safe' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'safe' ),
				'show_external' => true,
				'default'   => [
					'url'          => '',
					'is_external'  => true,
					'nofollow'     => true,
				],
			]
		);

		$this->add_control(
			'image_list',
			[
				'label'         => esc_html__( 'Repeater List', 'safe' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'default'       => [
					[
						'logo_image'      => esc_html__( 'Image #1', 'safe' ),
					],
					[
						'logo_image'      => esc_html__( 'Image #2', 'safe' ),
					],
				],
				'title_field' => esc_html__( 'Add Logo Image', 'safe' ),
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'slider_control',
            [
                'label' 	=> esc_html__( 'Slider Control', 'safe' ),
                'tab' 		=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'data_owl_item',
            [
                'label'         => esc_html__( 'Owl Item', 'safe' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px' ],
                'range'         => [
                    'px'           => [
                        'min'             => 0,
                        'max'             => 1000,
                        'step'            => 1,
                    ],
                ],
                'default'   => [
                    'unit'         => 'px',
                    'size'         => 2,
                ],
            ]
        );

        $this->add_control(
            'data_owl_item_for_tablet',
            [
                'label'         => esc_html__( 'Owl Item For Tablet', 'safe' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px' ],
                'range'         => [
                    'px'           => [
                        'min'             => 0,
                        'max'             => 1000,
                        'step'            => 1,
                    ],
                ],
                'default'   => [
                    'unit'         => 'px',
                    'size'         => 2,
                ],
            ]
        );

        $this->add_control(
            'data_owl_item_for_mobile',
            [
                'label'         => esc_html__( 'Owl Item For Mobile', 'safe' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px' ],
                'range'         => [
                    'px'           => [
                        'min'             => 0,
                        'max'             => 1000,
                        'step'            => 1,
                    ],
                ],
                'default'   => [
                    'unit'         => 'px',
                    'size'         => 1,
                ],
            ]
        );

        $this->add_control(
            'data_owl_margin',
            [
                'label'         => esc_html__( 'Owl Margin', 'safe' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px', ],
                'range'         => [
                    'px'           => [
                        'min'             => 0,
                        'max'             => 1000,
                        'step'            => 5,
                    ],
                ],
                'default'   => [
                    'unit'         => 'px',
                    'size'         => 60,
                ],
            ]
        );

        $this->add_control(
            'data_owl_loop',
            [
                'label' 		=> esc_html__( 'Slider Loop', 'safe' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'label_on' 		=> esc_html__( 'On', 'safe' ),
                'label_off' 	=> esc_html__( 'Off', 'safe' ),
                'return_value' 	=> 'yes',
                'default' 		=> 'yes',
            ]
        );

        $this->add_control(
            'data_owl_autoplay',
            [
                'label' 		=> esc_html__( 'Slider Autoplay', 'safe' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'label_on' 		=> esc_html__( 'Yes', 'safe' ),
                'label_off' 	=> esc_html__( 'No', 'safe' ),
                'return_value' 	=> 'yes',
                'default' 		=> 'yes',
            ]
        );

        $this->add_control(
            'data_owl_autoplaytimeout',
            [
                'label'         => esc_html__( 'Autoplay Timeout', 'safe' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px', ],
                'range'         => [
                    'px'           => [
                        'min'             => 0,
                        'max'             => 100000,
                        'step'            => 1000,
                    ],
                ],
                'default'   => [
                    'unit'         => 'px',
                    'size'         => 8000,
                ],
                'condition' => [ 'data_owl_autoplay'    =>  'yes' ]
            ]
        );

        $this->add_control(
            'data_owl_mousedrag',
            [
                'label' 		=> esc_html__( 'Slider Mousedrag', 'safe' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'label_on' 		=> esc_html__( 'Yes', 'safe' ),
                'label_off' 	=> esc_html__( 'No', 'safe' ),
                'return_value' 	=> 'yes',
                'default' 		=> 'yes',
            ]
        );

        $this->add_control(
            'data_owl_hoverpause',
            [
                'label' 		=> esc_html__( 'Slider Hover Pause', 'safe' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'label_on' 		=> esc_html__( 'Yes', 'safe' ),
                'label_off' 	=> esc_html__( 'No', 'safe' ),
                'return_value' 	=> 'yes',
                'default' 		=> 'yes',
            ]
        );

        $this->end_controls_section();
	}

	// Output For User
	protected function render(){

		$settings = $this->get_settings_for_display();

        // Data Owl Loop
        if( $settings['data_owl_loop'] == 'yes' ) {
            $this->add_render_attribute( 'wrapper', 'data-owl-loop', 'true' );
        } else {
            $this->add_render_attribute( 'wrapper', 'data-owl-loop', 'false' );
        }

        // Owl Responsive
        $this->add_render_attribute( 'wrapper', 'data-mi', $settings['data_owl_item_for_mobile']['size'] );
        $this->add_render_attribute( 'wrapper', 'data-ti', $settings['data_owl_item_for_tablet']['size'] );
        $this->add_render_attribute( 'wrapper', 'data-di', $settings['data_owl_item']['size'] );
        $this->add_render_attribute( 'wrapper', 'data-owl-items', $settings['data_owl_item']['size'] );

        // Data Owl Margin
        $this->add_render_attribute( 'wrapper', 'data-owl-margin', $settings['data_owl_margin']['size'] );


        // Data Owl Autoplay
        if( $settings['data_owl_autoplay'] == 'yes' ){
            $this->add_render_attribute( 'wrapper', 'data-owl-autoplay', 'true' );
        }else{
            $this->add_render_attribute( 'wrapper', 'data-owl-autoplay', 'false' );
        }

        // Slider Owl Autoplay Timeout
        if( $settings['data_owl_autoplay'] == 'yes' ){
            $this->add_render_attribute( 'wrapper', 'data-owl-autoplay-timeout', $settings['data_owl_autoplaytimeout']['size'] );
        }

        // Data Owl Mousedrag
        if( $settings['data_owl_mousedrag'] == 'yes' ){
            $this->add_render_attribute( 'wrapper', 'data-owl-mousedrag', 'true' );
        }else{
            $this->add_render_attribute( 'wrapper', 'data-owl-mousedrag', 'false' );
        }

        // Data Owl Hoverpause
        if( $settings['data_owl_hoverpause'] == 'yes' ){
            $this->add_render_attribute( 'wrapper', 'data-owl-autoplay-hoverpause', 'true' );
        }else{
            $this->add_render_attribute( 'wrapper', 'data-owl-autoplay-hoverpause', 'false' );
        }

        // Enable Owl Carousel
        $this->add_render_attribute( 'wrapper', 'class', 'safe_Logo_Carousel owl-carousel' );

        if( !empty( $settings['image_list'] ) ):
            echo '<div class="safe_Logo_Carousel_wrapper">';
                echo '<div '.$this->get_render_attribute_string( 'wrapper' ).' >';
                    foreach( $settings['image_list'] as $safe_brand ):
                        $logo_image = $safe_brand['logo_image']['url'];
                        if( !empty( $logo_image ) ){
                            echo '<div class="brand-img">';
                            $target = $safe_brand['website_link']['is_external'] ? ' target="_blank"' : '';
                            $nofollow = $safe_brand['website_link']['nofollow'] ? ' rel="nofollow"' : '';
                                if( !empty( $safe_brand['website_link']['url'] ) ){
                                    echo '<a href="'.esc_url( $safe_brand['website_link']['url'] ).'" ' . $target . $nofollow . '>';
                                }
                                    echo super_addons_img_tag( array(
                                        'url'		=>   esc_url( $logo_image ),
                                    ) );
                                if( !empty( $safe_brand['website_link']['url'] ) ){
                                    echo '</a>';
                                }
                            echo '</div>';
                        }
                    endforeach;
                echo '</div>';
            echo '</div>';
        endif;
	}
    protected function _content_template() {
		?>
        <#
            if( settings.data_owl_loop == 'yes' ){
                view.addRenderAttribute( 'wrapper', 'data-owl-loop', 'true' );
            }else{
                view.addRenderAttribute( 'wrapper', 'data-owl-loop', 'false' );
            }
            view.addRenderAttribute( 'wrapper', 'data-mi', settings.data_owl_item_for_mobile.size );
            view.addRenderAttribute( 'wrapper', 'data-ti', settings.data_owl_item_for_tablet.size );
            view.addRenderAttribute( 'wrapper', 'data-di', settings.data_owl_item.size );
            view.addRenderAttribute( 'wrapper', 'data-owl-items', settings.data_owl_item.size );
            view.addRenderAttribute( 'wrapper', 'data-owl-margin', settings.data_owl_margin.size );

            if( settings.data_owl_autoplay == 'yes' ){
                view.addRenderAttribute( 'wrapper', 'data-owl-autoplay', 'true' );
                view.addRenderAttribute( 'wrapper', 'data-owl-autoplay-timeout', settings.data_owl_autoplaytimeout.size );
            }else{
                view.addRenderAttribute( 'wrapper', 'data-owl-autoplay', 'false' );
            }

            if( settings.data_owl_mousedrag == 'yes' ){
                view.addRenderAttribute( 'wrapper', 'data-owl-mousedrag', 'true' );
            }else{
                view.addRenderAttribute( 'wrapper', 'data-owl-mousedrag', 'false' );
            }

            if( settings.data_owl_hoverpause == 'yes' ){
                view.addRenderAttribute( 'wrapper', 'data-owl-data_owl_hoverpause', 'true' );
            }else{
                view.addRenderAttribute( 'wrapper', 'data-owl-data_owl_hoverpause', 'false' );
            }

            view.addRenderAttribute( 'wrapper', 'class', 'safe_Logo_Carousel owl-carousel' );
        #>
		<# if ( settings.image_list.length ) { #>
		<div class="safe_Logo_Carousel_wrapper">
            <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
    			<# _.each( settings.image_list, function( item ) { #>
                    <#
                    var image = {
                        id: item.logo_image.id,
                        url: item.logo_image.url,
                        model: view.getEditModel()
                    };
                    var image_url = elementor.imagesManager.getImageUrl( image );
                    var target = item.website_link.is_external ? ' target="_blank"' : '';
		            var nofollow = item.website_link.nofollow ? ' rel="nofollow"' : '';
                    if( item.website_link.url ){ #>
                        <a href="{{item.website_link.url}}" {{ target }}{{ nofollow }}>
                    <#
                        }
                    #>
    				<img src="{{{ image_url }}}" />
                    <# if( item.website_link.url ){ #>
                    </a>
                    <# } #>
    			<# }); #>
            </div>
        </div>
		<# } #>
		<?php
	}

}