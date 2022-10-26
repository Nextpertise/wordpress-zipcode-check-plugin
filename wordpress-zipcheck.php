<?php
/**
 * Plugin Name: Nextpertise Wordpress Zipcheck
 * Description: Plug-in to implement the zipcode checker from Nextpertise
 * Version: 1.0.0
 * Author: Len van Essen
 * Author URI: http://wndr.digital
 *
 * @package wordpress-zipcheck
 */

/**
 * Wordpress Zipcheck Class.
 */
class WordpessZipcheck {
    /**
     * Plugin path.
     *
     * @var string
     */
    private $plugin_path;

    /**
     * WordPress Settings Framework instance.
     *
     * @var WordPressSettingsFramework
     */
    private $wpsf;

    /**
     * WPSFTest constructor.
     */
    public function __construct() {
        $this->plugin_path = plugin_dir_path( __FILE__ );

        // Include and create a new WordPressSettingsFramework.
        require_once $this->plugin_path . 'wp-settings-framework.php';
        $this->wpsf = new WordPressSettingsFramework( $this->plugin_path . 'settings/wordpress-zipcheck.php', 'nextpertise' );

        // Add admin menu.
        add_action( 'admin_menu', array( $this, 'add_settings_page' ), 20 );

        // Add an optional settings validation filter (recommended).
        add_filter( $this->wpsf->get_option_group() . '_settings_validate', array( &$this, 'validate_settings' ) );

        // Enqueue JS
        add_action( 'wp_enqueue_scripts', function() {
            wp_enqueue_script('nextperise_zipcheck_js', 'https://cdn.jsdelivr.net/gh/Nextpertise/js-zipcode-check-plugin/js/app.js', [], '1.0.0');
        } );

        $this->add_shortcode();
    }

    /**
     * Add settings page.
     */
    public function add_settings_page() {
        $this->wpsf->add_settings_page(
            array(
                'parent' => 'general',
                'page_title'  => esc_html__( 'Zipcheck Settings', 'wordpress-zipcheck' ),
                'menu_title'  => esc_html__( 'Zipcheck Settings', 'wordpress-zipcheck' ),
                'capability'  => 'edit_pages',
            )
        );
    }

    /**
     * Validate settings.
     *
     * @param mixed $input Input data.
     *
     * @return mixed $input
     */
    public function validate_settings( $input ) {
        // Do your settings validation here
        // Same as $sanitize_callback from http://codex.wordpress.org/Function_Reference/register_setting.
        return $input;
    }

    /**
     * Registers the shortcode
     * @return void
     */
    public function add_shortcode() {
        add_shortcode( 'nextpertise_zipcheck', function($args) {
            $token = wpsf_get_setting('nextpertise', 'general', 'token');

            if(empty($token)) {
                echo '<h3>Error, please provide your API token under Zipcheck Settings in WordPress';
                return;
            }

            $primary_color = wpsf_get_setting('nextpertise', 'layout', 'primary_color');
            $secondary_color = wpsf_get_setting('nextpertise', 'layout', 'secondary_color');
            $background_color = wpsf_get_setting('nextpertise', 'layout', 'background_color');
            $input_border_top_color = wpsf_get_setting('nextpertise', 'layout', 'input_border_top_color');
            $input_background_color = wpsf_get_setting('nextpertise', 'layout', 'input_background_color');
            $redirect = isset($args['redirect']) ? $args['redirect'] : null;
            echo "<nextpertise-zipcheck 
                primary-color='$primary_color'
                secondary-color='$secondary_color' 
                background-color='$background_color'
                token='$token'
                input-border-top-color='$input_border_top_color' 
                input-background-color='$input_background_color'
                redirect='$redirect'
                ></nextpertise-zipcheck>";
        });
    }
}

$wpsf_test = new WordpessZipcheck();