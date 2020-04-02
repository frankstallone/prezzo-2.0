<?php

// Main enqueue scripts and front page specific enqueued items
function prezzo_theme_enqueue_scripts()
{
    // Divi's styles
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // JS for site in footer
    wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/js/footer-scripts.js', array('jquery'), '1.1', true);

    // 🚨 Front page only below this line
    if (!is_front_page()) return;

    // Home page specific JS
    wp_enqueue_script('home-scripts', get_stylesheet_directory_uri() . '/js/home-scripts.js', array('jquery'), '1.1', true);
    // Use this echo example as for <script> or <meta> needed for home page
    // echo '<meta name="google-site-verification" content="xxx" />';
}

// Execute
add_action('wp_enqueue_scripts', 'prezzo_theme_enqueue_scripts');

// Footer specific scripts
function footer_scripts()
{ ?>
    <!-- Font-Awesome Pro kit for Prezzo.it -->
    <script src="https://kit.fontawesome.com/24e03df92e.js" crossorigin="anonymous"></script>
<?php
}

// This will hide the Divi "Project" post type.
add_filter( 'et_project_posttype_args', 'remove_project_post_type', 10, 1 );
function remove_project_post_type( $args ) {
	return array_merge( $args, array(
		'public'              => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => false
	));
}

// Execute
add_action('wp_footer', 'footer_scripts');

// Remove WP Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');


// Remove query strings!
function _remove_script_version($src)
{
    $parts = explode('?ver', $src);
    return $parts[0];
}

// Removing query strings -- more @ https://www.keycdn.com/support/remove-query-strings-from-static-resources
add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);

?>