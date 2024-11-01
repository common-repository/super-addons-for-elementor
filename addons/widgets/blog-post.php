<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
/**
*
* Blog Post Widget .
*
*/
class Super_Addons_Blog_Post extends Widget_Base {

	public function get_name() {
		return 'safeblogpost';
	}

	public function get_title() {
		return esc_html__( 'Blog Post', 'safe' );
	}

	public function get_icon() {
		return 'fas fa-blog';
    }

	public function get_categories() {
		return [ 'safe' ];
	}

    public function get_style_depends() {
		return [ 'safeblogcss' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'blog_post_section',
			[
				'label'         => esc_html__( 'Blog Post', 'safe' ),
				'tab'           => Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'blog_post_style',
			[
				'label'         => esc_html__( 'Style', 'safe' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    '1'     => esc_html__( 'Style One','safe' ),
                    '2'     => esc_html__( 'Style Two','safe' ),
                ],
                'default'       => '1'
			]
        );
		
		$this->add_control(
			'make_alt',
			[
				'label' 		=> __( 'Alter The Image?', 'safe' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'safe' ),
				'label_off' 	=> __( 'No', 'safe' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 'blog_post_style' => '2' ]
			]
		);
		
        $this->add_control(
			'blog_post_count',
			[
				'label'         => esc_html__( 'No of Post to show', 'safe' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__( '3', 'safe' )
			]
        );

        $this->add_control(
			'blog_column_count',
			[
				'label'         => esc_html__( 'No of Column', 'safe' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => '4',
                'options'       => [
                    '12'            => esc_html__( '1 Column','safe' ),
                    '6'             => esc_html__( '2 Columns','safe' ),
                    '4'             => esc_html__( '3 Columns','safe' ),
                    '3'             => esc_html__( '4 Columns','safe' ),
                ],
			]
        );
		
		$this->add_control(
			'title_count',
			[
				'label'         => esc_html__( 'Title Length', 'safe' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__( '18', 'safe' ),
			]
        );
		
        $this->add_control(
			'excerpt_display',
			[
				'label'         => esc_html__( 'Excerpt', 'safe' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'safe' ),
				'label_off'     => esc_html__( 'Hide', 'safe' ),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
        );

		$this->add_control(
			'excerpt_count',
			[
				'label'         => esc_html__( 'Excerpt Length', 'safe' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__( '18', 'safe' ),
                'condition'     => [ 'excerpt_display' => 'yes' ]
			]
        );

        $this->add_control(
			'blog_post_order',
			[
				'label'         => esc_html__( 'Order', 'safe' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'ASC'           => esc_html__( 'ASC','safe' ),
                    'DESC'          => esc_html__( 'DESC','safe' ),
                ],
                'default'       => 'DESC'
			]
        );

        $this->add_control(
			'blog_post_order_by',
			[
				'label'         => esc_html__( 'Order By', 'safe' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'ID'            => esc_html__( 'ID', 'safe' ),
                    'author'        => esc_html__( 'Author', 'safe' ),
                    'title'         => esc_html__( 'Title', 'safe' ),
                    'date'          => esc_html__( 'Date', 'safe' ),
                    'rand'          => esc_html__( 'Random', 'safe' ),
                ],
                'default'       => 'rand'
			]
        );

        $this->add_control(
			'button_display',
			[
				'label'         => esc_html__( 'Continue Reading Button', 'safe' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'safe' ),
				'label_off'     => esc_html__( 'Hide', 'safe' ),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
        );

        $this->add_control(
			'view_more_btn_text',
			[
				'label'         => esc_html__( 'Continue Reading Button Text', 'safe' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('Continue Reading','safe'),
                'condition'     => [ 'button_display' => 'yes' ],
                'label_block'   => true
			]
        );

        $this->add_control(
			'exclude_cats',
			[
				'label'         => esc_html__( 'Exclude Categories', 'safe' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
				'options'       => $this->safe_get_categories(),
			]
        );

        $this->add_control(
			'exclude_tags',
			[
				'label'         => esc_html__( 'Exclude Tags', 'safe' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
				'options'       => $this->safe_get_tags(),
			]
        );

        $this->add_control(
            'exclude_post_id',
            [
                'label'         => esc_html__( 'Exclude Post', 'safe' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => $this->safe_post_id(),
            ]
        );

        $this->end_controls_section();
		
		$this->start_controls_section(
			'general',
			[
				'label'         => esc_html__( 'General', 'safe' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'overlay_color',
			[
				'label'         => esc_html__( 'Overlay Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .blog-card-one .card__background--layer,{{WRAPPER}} .blog-card .details' => 'background: {{VALUE}}',
				],
			]
        );
		$this->add_control(
			'content_background',
			[
				'label'         => esc_html__( 'Content Background Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .blog-card-one .blog-card__info,{{WRAPPER}} .blog-card .description' => 'background: {{VALUE}}',
				],
			]
        );
		
		$this->end_controls_section();
		
        $this->start_controls_section(
			'post_title_style_section',
			[
				'label'         => esc_html__( 'Title', 'safe' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'post_title_color',
			[
				'label'         => esc_html__( 'Title Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .blog-card-one .blog-card__info h5,{{WRAPPER}} .blog-card .description h1' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'post_title_typography',
				'label'         => esc_html__( 'Title Typography', 'safe' ),
				'selector'      => '{{WRAPPER}} .blog-card-one .blog-card__info h5,{{WRAPPER}} .blog-card .description h1',
			]
        );

        $this->add_responsive_control(
			'post_title_margin',
			[
				'label'         => esc_html__( 'Title Margin', 'safe' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .blog-card-one .blog-card__info h5,{{WRAPPER}} .blog-card .description h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'post_title_padding',
			[
				'label'         => esc_html__( 'Title Padding', 'safe' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .blog-card-one .blog-card__info h5,{{WRAPPER}} .blog-card .description h1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'post_desc_style_section',
			[
				'label'         => esc_html__( 'Excerpt', 'safe' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'post_desc_color',
			[
				'label'         => esc_html__( 'Excerpt Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .post-summary .excerpt' => 'color: {{VALUE}}',
                ],
                'condition'     => [ 'excerpt_display'  => 'yes' ]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'post_desc_typography',
				'label'         => esc_html__( 'Excerpt Typography', 'safe' ),
                'selector'      => '{{WRAPPER}} .post-summary .excerpt',
                'condition'     => [ 'excerpt_display'  => 'yes' ]
			]
        );

        $this->add_responsive_control(
			'post_desc_margin',
			[
				'label'         => esc_html__( 'Excerpt Margin', 'safe' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .post-summary .excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'     => [ 'excerpt_display'  => 'yes' ]
			]
        );

        $this->add_responsive_control(
			'post_desc_padding',
			[
				'label'         => esc_html__( 'Excerpt Padding', 'safe' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .post-summary .excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'     => [ 'excerpt_display'  => 'yes' ]
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'offer_btn_style_section',
			[
				'label'         => esc_html__( 'Button', 'safe' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'offer_btn_color',
			[
				'label'         => esc_html__( 'Button Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .btn,{{WRAPPER}} .blog-card .description .read-more a'           => 'color: {{VALUE}}',
                ],
                'condition'     => ['button_display' => 'yes' ]
			]
        );
		
        $this->add_control(
			'offer_btn_hover_color',
			[
				'label'         => esc_html__( 'Button Hover Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .btn:hover,{{WRAPPER}} .blog-card .description .read-more a:hover'           => 'color: {{VALUE}}',
                ],
                'condition'     => ['button_display' => 'yes' ]
			]
        );
		
        $this->add_control(
			'icon_color',
			[
				'label'         => esc_html__( 'Button Icon Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .btn.btn--with-icon i,{{WRAPPER}} .blog-card .description .read-more a:after'     => 'color: {{VALUE}}',
                ],
                'condition'     => ['button_display' => 'yes' ]
			]
        );
		
        $this->add_control(
			'icon_bg_color',
			[
				'label'         => esc_html__( 'Button Icon Background', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .btn.btn--with-icon i'     => 'background-color: {{VALUE}}',
                ],
                'condition'     => ['blog_post_style' => 'one' ]
			]
        );
		
        $this->add_control(
			'button_bg_color',
			[
				'label'         => esc_html__( 'Button Background Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .btn,{{WRAPPER}} .blog-card .description .read-more a'           => 'background-color: {{VALUE}}',
                ],
                'condition'     => ['button_display' => 'yes' ]
			]
        );
        $this->add_control(
			'button_bg_hover_color',
			[
				'label'         => esc_html__( 'Button Hover Background Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .btn:hover,{{WRAPPER}} .blog-card .description .read-more a:hover'           => 'background-color: {{VALUE}}',
                ],
                'condition'     => ['button_display' => 'yes' ]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'offer_btn_typography',
				'label'         => esc_html__( 'Button Typography', 'safe' ),
                'selector'      => '{{WRAPPER}} .btn,{{WRAPPER}} .blog-card .description .read-more a',
                'condition'     => ['button_display' => 'yes' ]
			]
        );

        $this->add_responsive_control(
			'offer_btn_margin',
			[
				'label'         => esc_html__( 'Button Margin', 'safe' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .btn,{{WRAPPER}} .blog-card .description .read-more a'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'     => ['button_display' => 'yes' ]
			]
        );

        $this->add_responsive_control(
			'offer_btn_padding',
			[
				'label'         => esc_html__( 'Button Padding', 'safe' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .btn,{{WRAPPER}} .blog-card .description .read-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'     => ['button_display' => 'yes' ]
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'post_date_style_section',
			[
				'label'         => esc_html__( 'Date', 'safe' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'post_date_color',
			[
				'label'         => esc_html__( 'Date Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .date__box,{{WRAPPER}} .date' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'post_date_typography',
				'label'         => esc_html__( 'Date Typography', 'safe' ),
				'selector'      => '{{WRAPPER}} .date__box,{{WRAPPER}} .date',
			]
        );

        $this->add_responsive_control(
			'post_date_margin',
			[
				'label'         => esc_html__( 'Date Margin', 'safe' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .date__box,{{WRAPPER}} .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'post_date_padding',
			[
				'label'         => esc_html__( 'Date Padding', 'safe' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .date__box,{{WRAPPER}} .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
			]
		);

        $this->end_controls_section();
		
		$this->start_controls_section(
			'author_style',
			[
				'label'         => esc_html__( 'Author', 'safe' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'post_author_color',
			[
				'label'         => esc_html__( 'Author Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} a.icon-link,{{WRAPPER}} .author' => 'color: {{VALUE}}',
				],
			]
        );
        $this->add_control(
			'post_author_hover_color',
			[
				'label'         => esc_html__( 'Author Hover Color', 'safe' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} a.icon-link:hover,{{WRAPPER}} .author a:hover' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'post_author_typography',
				'label'         => esc_html__( 'Author Typography', 'safe' ),
				'selector'      => '{{WRAPPER}} a.icon-link,{{WRAPPER}} .author a',
			]
        );
		
		$this->end_controls_section();
		
    }

    // Get Post Categories
    public function safe_get_categories() {
        $cats = get_terms(array(
            'taxonomy'          => 'category',
            'hide_empty'        => true,
        ));

        $catarr = [];

        foreach( $cats as $singlecat ) {
            $catarr[$singlecat->term_id] = esc_html__( $singlecat->name,'safe' );
        }

        return $catarr;
    }

    // Get Post Tags
    public function safe_get_tags() {
        $cats = get_terms( array(
            'taxonomy'          => 'post_tag',
            'hide_empty'        => true,
        ));

        $catarr = [];

        foreach( $cats as $singlecat ) {
            $catarr[$singlecat->term_id] = esc_html__( $singlecat->name,'safe' );
        }

        return $catarr;
    }

    // Get Specific Post
    public function safe_post_id(){
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        );

        $safe_post = new WP_Query( $args );

        $postarray = [];

        while( $safe_post->have_posts() ){
            $safe_post->the_post();
            $postarray[get_the_Id()] = get_the_title();
        }

        wp_reset_postdata();

        return $postarray;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        // Exclude Post Id
		$exclude_post_id =  $settings['exclude_post_id'];

        if( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'                 => 'post',
                'posts_per_page'            => esc_attr( $settings['blog_post_count'] ),
                'order'                     => esc_attr( $settings['blog_post_order'] ),
                'orderby'                   => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'       => true,
                'category__not_in'          => $settings['exclude_cats'],
            );
        } elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'                 => 'post',
                'posts_per_page'            => esc_attr( $settings['blog_post_count'] ),
                'order'                     => esc_attr( $settings['blog_post_order'] ),
                'orderby'                   => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'       => true,
                'category__not_in'          => $settings['exclude_cats'],
                'tag__not_in'               => $settings['exclude_tags'],
            );
        }elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'                 => 'post',
                'posts_per_page'            => esc_attr( $settings['blog_post_count'] ),
                'order'                     => esc_attr( $settings['blog_post_order'] ),
                'orderby'                   => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'       => true,
                'category__not_in'          => $settings['exclude_cats'],
                'tag__not_in'               => $settings['exclude_tags'],
                'post__not_in'              => $exclude_post_id,
            );
        } elseif( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'                 => 'post',
                'posts_per_page'            => esc_attr( $settings['blog_post_count'] ),
                'order'                     => esc_attr( $settings['blog_post_order'] ),
                'orderby'                   => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'       => true,
                'category__not_in'          => $settings['exclude_cats'],
                'post__not_in'              => $exclude_post_id,
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'                 => 'post',
                'posts_per_page'            => esc_attr( $settings['blog_post_count'] ),
                'order'                     => esc_attr( $settings['blog_post_order'] ),
                'orderby'                   => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'       => true,
                'tag__not_in'               => $settings['exclude_tags'],
                'post__not_in'              => $exclude_post_id,
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'                 => 'post',
                'posts_per_page'            => esc_attr( $settings['blog_post_count'] ),
                'order'                     => esc_attr( $settings['blog_post_order'] ),
                'orderby'                   => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'       => true,
                'tag__not_in'               => $settings['exclude_tags'],
            );
        } elseif( empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'                 => 'post',
                'posts_per_page'            => esc_attr( $settings['blog_post_count'] ),
                'order'                     => esc_attr( $settings['blog_post_order'] ),
                'orderby'                   => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'       => true,
                'post__not_in'              => $exclude_post_id,
            );
        } else {
            $args = array(
                'post_type'                 => 'post',
                'posts_per_page'            => esc_attr( $settings['blog_post_count'] ),
                'order'                     => esc_attr( $settings['blog_post_order'] ),
                'orderby'                   => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'       => true,
            );
        }

        $this->add_render_attribute( 'column','class','col-lg-'.esc_attr( $settings['blog_column_count'] ) );

        $blogpost = new WP_Query( $args );

        if( $blogpost->have_posts() ) {
            echo '<div class="row">';
                if( $settings['blog_post_style'] == '1' ) {
                    while( $blogpost->have_posts() ) {
                        $blogpost->the_post();
                        echo '<div '.$this->get_render_attribute_string( 'column' ).'>';
                            echo '<article class="blog-card-one">';
                                if( has_post_thumbnail() ){
                                    echo '<div class="blog-card__background">';
                                        echo '<div class="card__background--wrapper">';
                                            echo '<div class="card__background--main" data-bg-img="'.esc_url( get_the_post_thumbnail_url() ).'">';
                                              echo '<div class="card__background--layer"></div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                                echo '<div class="blog-card__head">';
                                    echo '<span class="date__box">';
                                        echo '<span class="datel__day">'.esc_html( get_the_date( 'd' ) ).'</span>';
                                        echo '<span class="date__month">'.esc_html( get_the_date( 'M' ) ).'</span>';
                                    echo '</span>';
                                echo '</div>';
                                echo '<div class="blog-card__info post-summary">';
									$safe_title_length = $settings['title_count'] ? $settings['title_count'] : 18;
                                    if( get_the_title() ){
                                        echo '<h5>'.wp_kses_post( wp_trim_words( get_the_title(),$safe_title_length,'' ) ).'</h5>';
                                    }
                                    echo '<p>';
                                        echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )).'" class="icon-link mr-3"><i class="fas fa-pen-square"></i> '.esc_html( get_the_author() ).'</a>';
                                        echo '<a href="'.esc_url( get_comments_link() ).'" class="icon-link"><i class="far fa-comments"></i> '.esc_html( get_comments_number() ).'</a>';
                                    echo '</p>';
                                    $safe_excerpt_length = $settings['excerpt_count'] ? $settings['excerpt_count'] : 18;
                                    if(  $settings['excerpt_display'] == 'yes' ) {
                                        echo '<p class="excerpt">'.wp_kses_post( wp_trim_words( get_the_content(), $safe_excerpt_length, '' ) ).'</p>';
                                    }
                                    if( !empty( $settings['view_more_btn_text'] ) && $settings['button_display'] == 'yes' ) {
                                        echo '<!-- Button -->';
                                        echo '<a href="'.esc_url( get_permalink() ).'" class="btn btn--with-icon"><i class="btn-icon fas fa-long-arrow-alt-right"></i>'.esc_html( $settings['view_more_btn_text'] ).'</a>';
                                        echo '<!-- End Button -->';
                                    }
                                echo '</div>';
                            echo '</article>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                }else {
                    while( $blogpost->have_posts() ) {
                        $blogpost->the_post();
                        echo '<div '.$this->get_render_attribute_string( 'column' ).'>';
							if( $settings['make_alt'] == 'yes' ){
								$alter_class = 'alt';
							}else{
								$alter_class = '';
							}
                            echo '<div class="blog-card '.esc_attr( $alter_class ).'">';
                                echo '<div class="meta">';
                                    echo '<div class="photo" data-bg-img="'.esc_url( get_the_post_thumbnail_url() ).'"></div>';
                                    echo '<ul class="details">';
                                        echo '<li class="author"><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.esc_html( get_the_author() ).'</a></li>';
                                        echo '<li class="date">'.esc_html( get_the_date( 'M d, Y' ) ).'</li>';
                                        echo '<li class="tags">';
                                            echo '<ul>';
                                                $safe_terms = get_the_terms( get_the_ID(), 'category' );
                                                if( !empty( $safe_terms ) ){
                                                    foreach ( $safe_terms as $terms ) {
                                                        echo '<li><a href="'.esc_url( get_term_link( $terms ) ).'">'.esc_html( $terms->name ).' </a></li>';
                                                    }
                                                }
                                            echo '</ul>';
                                       echo '</li>';
                                       echo '</ul>';
                                echo '</div>';
                                echo '<div class="description post-summary">';
									$safe_title_length = $settings['title_count'] ? $settings['title_count'] : 18;
									if( get_the_title() ){
										echo '<h1>'.wp_kses_post( wp_trim_words( get_the_title(),$safe_title_length,'' ) ).'</h1>';
									}
                                    echo '<h2>'.wp_kses_post( get_the_excerpt() ).'</h2>';
                                    $safe_excerpt_length = $settings['excerpt_count'] ? $settings['excerpt_count'] : 18;
                                    if(  $settings['excerpt_display'] == 'yes' ) {
                                        echo '<p class="excerpt">'.wp_kses_post( wp_trim_words( get_the_content(), $safe_excerpt_length, '' ) ).'</p>';
                                    }
                                    if( !empty( $settings['view_more_btn_text'] ) && $settings['button_display'] == 'yes' ) {
                                        echo '<p class="read-more">';
                                            echo '<a href="'.esc_url( get_permalink() ).'">'.esc_html( $settings['view_more_btn_text'] ).'</a>';
                                        echo '</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                echo '</div>';
            }
        }
	}
}
