<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

// END ENQUEUE PARENT ACTION

/* ==========================================================================
 *  Load scripts and styles
 * ========================================================================== */
	
	function wildfire_child_theme_style_and_script() {

        // STYLES       
        
        /*Slick Css  https://cdnjs.com/libraries/slick-carousel*/
        
        wp_enqueue_style( 'slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );
        wp_enqueue_style( 'slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css' );

		/* Add Child Theme Styles*/
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );


		// SCRIPTS    

        /* Add Child Theme Scripts */
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js' );
        wp_enqueue_script( 'slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'script-child', get_stylesheet_directory_uri() . '/js/script-child.js', array( 'jquery' ), time(), true );

	}

add_action( 'wp_enqueue_scripts', 'wildfire_child_theme_style_and_script' );
/* ========================================================================== */

// wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/css/slick.css', array( 'style' ) );
// wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/css/slick-theme.css', array( 'style' ) );
// wp_enqueue_script( 'slick-scripts', get_stylesheet_directory_uri() . '/js/slick.min.js', array( 'jquery' ), '20120206', false );
// wp_enqueue_script( 'script-child', get_stylesheet_directory_uri() . '/js/script-child.js', array( 'jquery' ) );

add_action('carbon_fields_register_fields', 'crb_contacts_map');
function crb_contacts_map()
{
    Container::make('post_meta', 'Map')
        ->show_on_page(13)
        ->add_fields(array(
            Field::make('text', 'map', 'КАРТА'),

        ));
}
add_action('carbon_fields_register_fields', 'crb_add_slider');
function crb_add_slider()
{
    Container::make('post_meta', 'Head Slider')
        ->show_on_page(8)
        ->add_fields(array(
            Field::make('complex', 'ban', 'slides')
                ->add_fields(array(
                        Field::make( 'image', 'image', 'Image' )
                        ->set_value_type( 'url' ),
                        Field::make('text', 'banner_link', 'link')
                            ->set_width(33),
                        Field::make('text', 'title', 'short text1')
                            ->set_width(50),
                        Field::make('text', 'subtitle', 'long text1')
                            ->set_width(50),


                        Field::make('text', 'banner_link2', 'link')
                            ->set_width(33),
                        Field::make('text', 'title2', 'short text2')
                            ->set_width(50),
                        Field::make('text', 'subtitle2', 'long text2')
                            ->set_width(50),
                        Field::make( 'checkbox', 'show_on_mobile', 'Show On Mobile' )
    				->set_option_value( 'yes' ),
                        Field::make( 'checkbox', 'show_on_desctop', 'Show On Desctop' )
    				->set_option_value( 'yes' )
                    )
                )

        ));
}