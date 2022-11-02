<?php
/**
 * WordPress Settings Framework
 *
 * @link https://github.com/gilbitron/WordPress-Settings-Framework
 * @package wpsf
 */

/**
 * Define your settings
 *
 * The first parameter of this filter should be wpsf_register_settings_[options_group],
 * in this case "my_example_settings".
 *
 * Your "options_group" is the second param you use when running new WordPressSettingsFramework()
 * from your init function. It's important as it differentiates your options from others.
 *
 * To use the tabbed example, simply change the second param in the filter below to 'wpsf_tabbed_settings'
 * and check out the tabbed settings function on line 156.
 */

add_filter( 'wpsf_register_settings_nextpertise', 'nextpertise_zipcheck_settings' );
add_filter( 'wpsf_register_settings_nextpertise', 'nextpertise_zipcheck_layout' );
add_filter( 'wpsf_register_settings_nextpertise', 'nextpertise_zipcheck_example' );
/**
 * Tabless example.
 *
 * @param array $wpsf_settings Settings.
 */
function nextpertise_zipcheck_settings( $wpsf_settings ) {
    $wpsf_settings[] = array(
        'section_id'          => 'general',
        'section_title'       => 'General Settings',
        'section_order'       => 1,
        'fields'              => array(
            array(
                'id'          => 'token',
                'title'       => 'API token',
                'desc'        => 'Add your API token here.',
                'type'        => 'password',
            ),
        )
    );
    return $wpsf_settings;
}

function nextpertise_zipcheck_layout( $wpsf_settings ) {
    $wpsf_settings[] = array(
        'section_id'          => 'layout',
        'section_title'       => 'Layout Settings',
        'section_description' => 'Control the layout of the zipchecker. You can save it as many times as you like and view the results on the page where you have place the shortcode',
        'section_order'       => 2,
        'fields'              => array(
            array(
                'id'      => 'primary_color',
                'title'   => 'Primary Color',
                'desc'    => 'This color is used for various titles',
                'type'    => 'color',
                'default' => '#0070ba',
            ),
            array(
                'id'      => 'secondary_color',
                'title'   => 'Secondary Color',
                'desc'    => 'This color is used as the background for buttons, the icon color and various element.',
                'type'    => 'color',
                'default' => '#00A2D7',
            ),
            array(
                'id'      => 'background_color',
                'title'   => 'Background Color',
                'desc'    => 'This color is used as the background for the zipcheck component.',
                'type'    => 'color',
                'default' => '#fff',
            ),
            array(
                'id'      => 'input_background_color',
                'title'   => 'Input Background Color',
                'desc'    => 'This color is used as the background for the form fields.',
                'type'    => 'color',
                'default' => '#fff',
            ),
            array(
                'id'      => 'input_border_top_color',
                'title'   => 'Input Border Top Color',
                'desc'    => 'This color is used for the top border on form fields. You can leave it empty if you don\'t want this.',
                'type'    => 'color',
                'default' => '#D3E7F3',
            ),
            array(
                'id'      => 'button_effect',
                'title'   => 'Button Effect',
                'desc'    => 'Enable the Nextpertise effect on the buttons',
                'type'    => 'checkbox',
                'default' => false,
            ),
        )
    );
    return $wpsf_settings;
}

function nextpertise_zipcheck_example( $wpsf_settings ) {
    $wpsf_settings[] = array(
        'section_id'          => 'example',
        'section_title'       => 'How to display ',
        'section_order'       => 3,
        'fields'              => array(
            array(
                'id'          => 'shortcode',
                'title'       => 'Shortcode Example',
                'desc'        => 'Copy and paste this shortcode into the page where you\'d like the zipcode checker to be displayed',
                'type'        => 'example',
                'value'       => '[nextpertise_zipcheck]',
                'disabled'    => true
            ),
        )
    );
    return $wpsf_settings;
}