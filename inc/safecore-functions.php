<?php
/**
 * @Packge     : Safe
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

	/**
	* Register Google fonts for super_addons.
	*
	* Create your own super_addons_fonts_url() function to override in a child theme.
	*
	* @since super_addons 1.0
	*
	* @return string Google fonts URL for the theme.
	*/
	function super_addons_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		if ( 'off' !== _x( 'on', 'Raleway: on or off', 'safe' ) ) {
			$fonts[] = 'Raleway:300,400,500,600,700,800,900';
		}

		if ( 'off' !== _x( 'on', 'Poppins: on or off', 'safe' ) ) {
			$fonts[] = 'Poppins:300,400,500,600,700,800,900';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}

    /**
    * Enqueue scripts and styles.
    */
    function super_addons_scripts() {
    	wp_enqueue_style( 'super-addons-fonts', super_addons_fonts_url(), array(), null );
    }

    add_action( 'wp_enqueue_scripts', 'super_addons_scripts' );


    // image default alt
    if( ! function_exists( 'super_addons_img_default_alt' ) ){
    	function super_addons_img_default_alt( $url = '' ){

    		if( $url != '' ){
    			// attachment id by URL
    			$attachmentid = attachment_url_to_postid( esc_url( $url ) );
    		   // attachment alt tag
    			$image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );

    			if( $image_alt ){
    				return $image_alt ;
    			}else{
    				$filename = pathinfo( esc_url( $url ) );

    				$alt = str_replace( '-', ' ', $filename['filename'] );

    				return $alt;
    			}

    		}else{
    		   return;
    		}

    	}
    }


    // Image Tag
    if( ! function_exists( 'super_addons_img_tag' ) ){
    	function super_addons_img_tag( array $args ){

    		$default = array(
    			'url' 	 	  => '',
    			'alt' 	 	  => '',
    			'class'  	  => '',
    		);

    		$args = wp_parse_args( $args,  $default );

    		// Image URL
    		$url = $args['url'];

    		// image tag alter
    		if( !empty( $args['alt'] ) ){
    			$alt = $args['alt'];
    		}else{
    			$alt = super_addons_img_default_alt( $url );
    		}

    		/**
    		 * Optional Attr
    		 */

    		$attr = '';
    		// Image class
    		if( !empty( $args['class'] ) ){
    			$attr .= ' class="'.esc_attr( $args['class'] ).'"';
    		}

    		return '<img src="'.esc_url( $url ).'" alt="'.esc_attr( $alt ).'" '.wp_kses_post( $attr ).' />';
    	}
    }