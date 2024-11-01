<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Super Addons Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Super_Addons_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}


	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

        // Register widget scripts
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);

		// Specific Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'safe_regsiter_widget_scripts' ] );

		// Specific Register widget Style
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ],99999 );

        // category register
		add_action( 'elementor/elements/categories_registered',[ $this, 'safe_elementor_widget_categories' ] );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $elementor = 'elementor/elementor.php';

        if ( $this->is_plugin_installed( $elementor ) ) {
    		$message = sprintf(
    			esc_html__( '"%1$s" requires "%2$s" to be activated.Please activate Elementor to continue.', 'safe' ),
    			'<strong>' . esc_html__( 'Super Addons For Elementor', 'safe' ) . '</strong>',
    			'<strong>' . esc_html__( 'Elementor', 'safe' ) . '</strong>'
    		);
            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );
            $button_text    = esc_html__( 'Activate Elementor', 'safe' );
        }else{
            $message = sprintf(
    			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.Please activate Elementor to continue.', 'safe' ),
    			'<strong>' . esc_html__( 'Super Addons For Elementor', 'safe' ) . '</strong>',
    			'<strong>' . esc_html__( 'Elementor', 'safe' ) . '</strong>'
    		);
            $activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $button_text    = esc_html__( 'Install Elementor', 'safe' );
        }

        $button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';

		printf( '<div class="error"><p>%1$s</p><p>%2$s</p></div>', $message, $button );

	}

    public function is_plugin_installed( $basename ){
        if ( !function_exists( 'get_plugins' ) ) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset( $installed_plugins[$basename] );
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'safe' ),
			'<strong>' . esc_html__( 'Super Addons For Elementor', 'safe' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'safe' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'safe' ),
			'<strong>' . esc_html__( 'Super Addons For Elementor', 'safe' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'safe' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
		require_once( SUPER_ADDONS_ADDONS . '/widgets/section-title.php' );
		require_once( SUPER_ADDONS_ADDONS . '/widgets/blog-post.php' );
		require_once( SUPER_ADDONS_ADDONS . '/widgets/button.php' );
		require_once( SUPER_ADDONS_ADDONS . '/widgets/owl-slider.php' );
		require_once( SUPER_ADDONS_ADDONS . '/widgets/team-member.php' );
		require_once( SUPER_ADDONS_ADDONS . '/widgets/logo-carousel.php' );
		require_once( SUPER_ADDONS_ADDONS . '/widgets/icon-box.php' );
		require_once( SUPER_ADDONS_ADDONS . '/widgets/safe-cta.php' );



		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Super_Addons_Section_Title_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Super_Addons_Blog_Post() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Super_Addons_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Super_Addons_Owl_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Super_Addons_Team_Member() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Super_Addons_Logo_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Super_Addons_Icon_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Super_Addons_Cta() );
}

	public function widget_styles( ) {
		wp_register_style(
            'safesectiontitle',
            SUPER_ADDONS_PLUGDIRURI . 'assets/css/section-title.css',
            false,
            '1.0',
			false
        );

		wp_register_style(
            'safebutton',
            SUPER_ADDONS_PLUGDIRURI . 'assets/css/safe-button.css',
            false,
            '1.0',
			false
        );

		wp_register_style(
            'safeteammember',
            SUPER_ADDONS_PLUGDIRURI . 'assets/css/safe-team.css',
            false,
            '1.0',
			false
        );

		wp_register_style(
            'safeblogcss',
            SUPER_ADDONS_PLUGDIRURI . 'assets/css/safe-blog-post.css',
            false,
            '1.0',
			false
        );

		wp_register_style(
            'safeiconboxcss',
            SUPER_ADDONS_PLUGDIRURI . 'assets/css/safe-icon-box.css',
            false,
            '1.0',
			false
        );
		wp_register_style(
            'safecalltoaction',
            SUPER_ADDONS_PLUGDIRURI . 'assets/css/safe-call-to-action.css',
            false,
            '1.0',
			false
        );

		wp_register_style(
            'owl-carousel',
            SUPER_ADDONS_PLUGDIRURI . 'assets/css/owl.carousel.min.css',
            array(),
            '1.1.0'
		);

	}
	

    public function widget_scripts() {
        wp_enqueue_script(
            'safe-frontend-script',
            SUPER_ADDONS_PLUGDIRURI . 'assets/js/safe-frontend.js',
            array('jquery'),
            false,
            true
		);
	}

	public function safe_regsiter_widget_scripts( ) {

		wp_enqueue_style(
            'safe-style',
            SUPER_ADDONS_PLUGDIRURI . 'assets/css/style.css',
            array(),
            '1.0.0'
		);

		wp_register_script(
			'owlcarousel',
			SUPER_ADDONS_PLUGDIRURI . 'assets/js/owl.carousel.min.js',
			array('jquery'),
			'2.3.4',
			true
		);
		
	}
    function safe_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'safe',
            [
                'title' => esc_html__( 'Super Addons', 'safe' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

	}

}

Super_Addons_Extension::instance();