<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'progression'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$animations = array(
		'fade' => __('Fade', 'progression'),
		'slide' => __('Slide', 'progression')
	);
	

	
	$animation_true = array(
		'true' => __('On', 'progression'),
		'false' => __('Off', 'progression')
	);
	

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'progression'),
		'two' => __('Pancake', 'progression'),
		'three' => __('Omelette', 'progression'),
		'four' => __('Crepe', 'progression'),
		'five' => __('Waffle', 'progression')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic', 'progression'),
		'type' => 'heading');
		
	
	$options[] = array(
		'name' => __('Copyright', 'progression'),
		'desc' => __('Choose your copyright text here. ', 'progression'),
		'id' => 'copyright_textarea',
		'std' => '&copy; 2012 All Rights Reserved. Developed by <a href="http://themeforest.net/user/ProgressionStudios/?ref=ProgressionStudios" target="_blank">Progression Studios</a>.',
		'type' => 'textarea');
	
	
	
	$options[] = array(
		'name' => __('Fixed Navigation', 'progression'),
		'desc' => __('Select this checkbox to enable the fixed navigation. This will keep the navigation sticky to the top of your browser.', 'progression'),
		'id' => 'sticky_navigation',
		'std' => '0',
		'type' => 'checkbox');

	
	$options[] = array(
		'name' => __('Display Footer Widgets', 'progression'),
		'desc' => __('Select this checkbox to enable the footer widgets.', 'progression'),
		'id' => 'footer_widgets',
		'std' => '1',
		'type' => 'checkbox');	
	
	
	$options[] = array(
		'name' => __('Footer Widget Column Count', 'progression'),
		'desc' => __('Choose how many columns you want to use for our footer widgets (1-4 Columns).', 'progression'),
		'id' => 'footer_widgets_column',
		'std' => '3',
		'class' => 'mini',
		'type' => 'text');
	
	
	
	$options[] = array(
		'name' => __('Display Sidebar on Blog, Archives, and Search', 'progression'),
		'desc' => __('Select this checkbox to display the sidebar in the blog pages.', 'progression'),
		'id' => 'blog_sidebar',
		'std' => '1',
		'type' => 'checkbox');
	
	
	

	
	
	$options[] = array(
		'name' => __('Display Sidebar on Blog Post pages', 'progression'),
		'desc' => __('Select this checkbox to display the sidebar in the blog post pages.', 'progression'),
		'id' => 'blog_sidebar_single',
		'std' => '1',
		'type' => 'checkbox');	
	
	
	$options[] = array(
		'name' => __('Display Comments on Pages', 'progression'),
		'desc' => __('Select this checkbox to enable the comments on pages.  Once selected you can also manually enable/disable comments on a page-by-page basis via the Discussion Screen Option.', 'progression'),
		'id' => 'page_comments_default',
		'std' => '0',
		'type' => 'checkbox');
	
	
	
	
	
	
	
	$options[] = array(
		'name' => __('Portfolio', 'progression'),
		'type' => 'heading');
	
	
	$options[] = array(
		'name' => __('Portfolio Posts Per Page', 'progression'),
		'desc' => __('Choose how many portfolio posts show per page (Or before scrolling). You can overwrite this in the portfolio template files under "posts_per_page".', 'progression'),
		'id' => 'portfolio_page_posts',
		'std' => '6',
		'class' => 'mini',
		'type' => 'text');
	
	
	
	$options[] = array(
		'name' => __('Check to turn off Infinite Scroll (Manual Load More Button)', 'progression'),
		'desc' => __('Select this checkbox to turn off infinite scroll.  When checkbox is unselected, posts will load as the user scroll down infinitely instead of the default button push. (<strong>Note</strong>: This option also controls "Blog w/ Columns Template")', 'progression'),
		'id' => 'portfolio_infinite_scroll',
		'std' => '1',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('Turn on Normal Pagination for Portfolio (Over-rides Infinite Scroll option above)', 'progression'),
		'desc' => __('Select this checkbox to turn on normal portfolio pagination instead of the load more pagination. (<strong>Note</strong>: This option also controls "Blog w/ Columns Template")', 'progression'),
		'id' => 'portfolio_normal_pagination',
		'std' => '0',
		'type' => 'checkbox');	
	
	
	
	$options[] = array(
		'name' => __('Display Sidebar on Portfolio Post pages', 'progression'),
		'desc' => __('Select this checkbox to display the sidebar in the portfolio post pages.', 'progression'),
		'id' => 'portfolio_sidebar_single',
		'std' => '0',
		'type' => 'checkbox');
		
	
	$options[] = array(
		'name' => __('Crop Images on Portfolio Single Post', 'progression'),
		'desc' => __('Select this checkbox to crop images on the Portfolio Single Post Pages.  Unselect this box to un-crop images on the portfolio single post page.', 'progression'),
		'id' => 'portfolio_single_uncrop',
		'std' => '1',
		'type' => 'checkbox');
		
		
	$options[] = array(
		'name' => __('Display Comments on Portfolio Posts', 'progression'),
		'desc' => __('Select this checkbox to enable the comments on portfolio posts.', 'progression'),
		'id' => 'portfolio_comments_default',
		'std' => '0',
		'type' => 'checkbox');	
	
	$options[] = array(
		'name' => __('Homepage', 'progression'),
		'type' => 'heading');
	
	
	$options[] = array(
		'name' => __('Homepage Template Posts Per Page', 'progression'),
		'desc' => __('Choose how many  posts show per page (Or before scrolling) on the default Homepage Template. If you are using the blog/slider page templates, you will use the default WordPress settings to set the posts per page under Settings > Reading.', 'progression'),
		'id' => 'homepage_page_posts',
		'std' => '6',
		'class' => 'mini',
		'type' => 'text');
	
	
	
	$options[] = array(
		'name' => __('Homepage & "Blog w/ Columns" page templates post Column Count', 'progression'),
		'desc' => __('Choose how many columns you want to use if you are using the Homepage or "Blog w/ Column" page templates.  Choose between 2, 3 and 4.', 'progression'),
		'id' => 'blog_columns_count',
		'std' => '3',
		'class' => 'mini',
		'type' => 'text');	
	
	
	$options[] = array(
		'name' => __('Homepage Template Portfolio/Blog Posts Display', 'progression'),
		'desc' => __('Select this checkbox to enable the Portfolio and Blog Posts on the homepage completely.  You can manually disable one of the post-types by selecting a blank category on the page or by selecting no category.', 'progression'),
		'id' => 'homepage_display_boxes',
		'std' => '1',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('Homepage Template checkbox to turn off Infinite Scroll (Manual Load More Button)', 'progression'),
		'desc' => __('Select this checkbox to turn off infinite scroll.  When checkbox is unselected, posts will load as the user scroll down infinitely instead of the default button push. (<strong>Note</strong>: This option also controls "Blog w/ Columns Template")', 'progression'),
		'id' => 'homepage_infinite_scroll',
		'std' => '1',
		'type' => 'checkbox');
		
	
	
	$options[] = array(
		'name' => __('Homepage Template option to turn on Normal Pagination (Over-rides Infinite Scroll option above)', 'progression'),
		'desc' => __('Select this checkbox to turn on normal pagination instead of the load more pagination.', 'progression'),
		'id' => 'homepage_normal_pagination',
		'std' => '0',
		'type' => 'checkbox');
	
	
	
	$options[] = array(
		'name' => __('Display Sidebar on the Homepage', 'progression'),
		'desc' => __('Select this checkbox to display the sidebar on the homepage', 'progression'),
		'id' => 'homepage_sidebar',
		'std' => '0',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('Display Featured Text area below slider', 'progression'),
		'desc' => __('Select this checkbox to enable the featured text area on the homepage.  Below are options for this featured text area.', 'progression'),
		'id' => 'featured_text_checkbox',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Homepage Featured Text Headline', 'progression'),
		'desc' => __('Choose your homepage featured text headline.', 'progression'),
		'id' => 'featured_text_headline',
		'std' => 'About me',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Homepage Featured Text Content', 'progression'),
		'desc' => __('Choose your homepage featured text content.', 'progression'),
		'id' => 'featured_text_content',
		'std' => 'We were born to do this, and we love doing it. Creativity is the liquid that powers our brains. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus fermentum ullamcorper elit vel.',
		'type' => 'textarea');
		
	
	$options[] = array(
		'name' => __('Homepage Featured Text Image', 'progression'),
		'desc' => __('Use the upload button to upload a featured text area image that floats left of the content.', 'progression'),
		'id' => 'featured_text_image',
		"std" => get_template_directory_uri() . "/images/demo/profile-pic.png",
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Homepage Featured Text Image Width', 'progression'),
		'desc' => __('Homepage Featured Image width.', 'progression'),
		'id' => 'featured_text_image_width',
		'std' => '95',
		'class' => 'mini',
		'type' => 'text');	
	
	
	$options[] = array(
		'name' => __('Homepage Featured Text Image Height', 'progression'),
		'desc' => __('Homepage Featured Image height.', 'progression'),
		'id' => 'featured_text_image_height',
		'std' => '106',
		'class' => 'mini',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Social Icons', 'progression'),
		'type' => 'heading');
		
	
	$options[] = array(
		'name' => __('Header/Footer Social Icons', 'progression'),
		'desc' => __('These icons will display in the header & footer of your theme.  Leave the text area blank and the icon will disappear automatically.', 'progression'),
		'type' => 'info');
	
	$options[] = array(
		'name' => __('RSS Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'rss_link',
		'std' => '',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Facebook Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'facebook_link',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'twitter_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Skype Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'skype_link',
		'std' => '',
		'type' => 'text');
		
		
	$options[] = array(
		'name' => __('Vimeo Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'vimeo_link',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('LinkedIn Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'linkedin_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Dribbble Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'dribbble_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Flickr Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'flickr_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Google Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'google_link',
		'std' => '',
		'type' => 'text');	

	
	$options[] = array(
		'name' => __('Youtube Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'youtube_link',
		'std' => '',
		'type' => 'text');
		
		$options[] = array(
			'name' => __('Instagram Link', 'progression'),
			'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
			'id' => 'instagram_link',
			'std' => '',
			'type' => 'text');	
			
			$options[] = array(
				'name' => __('Pinterest Link', 'progression'),
				'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
				'id' => 'pinterest_link',
				'std' => '',
				'type' => 'text');		
	
	
	
	$options[] = array(
		'name' => __('Widget Area Social Icons', 'progression'),
		'desc' => __('These icons will display in the custom social icons widget of your theme.  Leave the text area blank and the icon will disappear automatically.', 'progression'),
		'type' => 'info');
		
	
	$options[] = array(
		'name' => __('RSS Link in Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'rss_link_widget',
		'std' => '',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Facebook Link in Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'facebook_link_widget',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter Link in Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'twitter_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Skype Link in Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'skype_link_widget',
		'std' => '',
		'type' => 'text');
		
		
	$options[] = array(
		'name' => __('Vimeo Link in Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'vimeo_link_widget',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('LinkedIn Linkin Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'linkedin_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Dribbble Link in Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'dribbble_link_widget',
		'std' => '',
		'type' => 'text');
	
	

	$options[] = array(
		'name' => __('Flickr Link in Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'flickr_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Google Link in Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'google_link_widget',
		'std' => '',
		'type' => 'text');	

	
	$options[] = array(
		'name' => __('Youtube Link in Social Icons Widget', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
		'id' => 'youtube_link_widget',
		'std' => '',
		'type' => 'text');
		
		$options[] = array(
			'name' => __('Instagram Link in Social Icons Widget', 'progression'),
			'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
			'id' => 'instagram_link_widget',
			'std' => '',
			'type' => 'text');
	
	
	
			$options[] = array(
				'name' => __('Pinterest Link in Social Icons Widget', 'progression'),
				'desc' => __('Social Icon will display/hide automatically in the social icons widget.', 'progression'),
				'id' => 'pinterest_link_widget',
				'std' => '',
				'type' => 'text');
	
	
	
	$options[] = array(
		'name' => __('Appearance', 'progression'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Logo', 'progression'),
		'desc' => __('Use the upload button to upload your sites logo and then click <strong>Use this image</strong>.', 'progression'),
		'id' => 'logo',
		"std" => get_template_directory_uri() . "/images/logo.png",
		'type' => 'upload');
	
	
	$options[] = array(
		'name' => __('Logo Width', 'progression'),
		'desc' => __('Choose your logo width in pixels.  Default is 164.', 'progression'),
		'id' => 'logo_width',
		'std' => '164',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('FavIcon', 'progression'),
		'desc' => __('Use the upload button to upload your favicon (bookmark icon) and then click <strong>Use this image</strong>.', 'progression'),
		'id' => 'favicon',
		'type' => 'upload');
	
	
	$options[] = array(
		'name' => __('Navigation Height', 'progression'),
		'desc' => __('Choose how tall you want your navigation.  Adjust this if your logo is too tall or short. Default is 96', 'progression'),
		'id' => 'navigation_height',
		'std' => '96',
		'class' => 'mini',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Main Body Font', 'progression'),
		'desc' => __('Choose a Main Navigation Font. Default font is <strong>Helvetica Neue</strong>', 'progression'),
		'id' => 'main_font',
		'std' => 'Helvetica Neue',
		'class' => 'mini',
		'type' => 'text');

	
	$options[] = array(
		'name' => __('Main Custom Font', 'progression'),
		'desc' => __('Choose the main custom font.  This is used on the Navigation and Widget Headings.  Default font is <strong>PT Sans</strong>', 'progression'),
		'id' => 'navigation_font',
		'std' => 'PT Sans',
		'class' => 'mini',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Secondary Custom Font', 'progression'),
		'desc' => __('Choose the secondary custom font.  This is used on H2-H6 headings and various small areas like pagination.  Default font is <strong>PT Sans Narrow</strong>', 'progression'),
		'id' => 'secondary_font',
		'std' => 'PT Sans Narrow',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Page Title and Caption Custom Font', 'progression'),
		'desc' => __('Choose the featured slider caption and Page Title custom font.  Default font is <strong>Dosis</strong>', 'progression'),
		'id' => 'caption_font',
		'std' => 'Dosis',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Tools', 'progression'),
		'type' => 'heading');
	
	
	$options[] = array(
		'name' => __('Homepage Title', 'progression'),
		'desc' => __('Enter a title for the homepage, leave blank if you want to use an auto generated one or a third party plugin.', 'progression'),
		'id' => 'home_title',
		'std' => '',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Homepage Meta Description', 'progression'),
		'desc' => __('Enter a description for the homepage, about 140 characters.', 'progression'),
		'id' => 'home_meta',
		'std' => '',
		'type' => 'text');
		

		
	
	$options[] = array(
		'name' => __('Tracking Code', 'progression'),
		'desc' => __('Paste your tracking code here e.g. Google Analytics etc... without &lt;script&gt; tags.', 'progression'),
		'id' => 'tracking_code',
		'std' => '',
		'type' => 'textarea');
		
	
	$options[] = array(
		'name' => __('Custom CSS Code', 'progression'),
		'desc' => __('Paste custom JavaScript code here without &lt;style&gt;&lt;/style&gt; tags.', 'progression'),
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');
	
	
	$options[] = array(
		'name' => __('Custom Javascript Code', 'progression'),
		'desc' => __('Paste custom JavaScript code here without &lt;script&gt;&lt;s/cript&gt; tags.', 'progression'),
		'id' => 'custom_js',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => __('Slider', 'progression'),
		'type' => 'heading');
	
	
	
	$options[] = array(
		'name' => __('Display Retina Sized Featured Slider Images', 'progression'),
		'desc' => __('Select this checkbox to enable retina sized slider images.  This means the images will be resized to 2000px wide by 800px tall (Your browser will then resize it to fit in the window).  If you unselect this box, the featured slider images will be resized to 1500px wide by 600px tall.  Note:  These images are sized in the functions.php file. Make sure the images you upload are large enough to be resized.', 'progression'),
		'id' => 'retina_slider_images',
		'std' => '1',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('Featured Slider Animation', 'progression'),
		'desc' => __('Choose your slider animation between fade and slide.', 'progression'),
		'id' => 'slider_animation',
		'std' => 'fade',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animations);
		

	$options[] = array(
		'name' => __('Featured Slider Autoplay', 'progression'),
		'desc' => __('Choose to have your slide show autoplay or not.', 'progression'),
		'id' => 'slider_autoplay_play',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
	
	
	$options[] = array(
		'name' => __('Featured Slider Autoplay Speed', 'progression'),
		'desc' => __('Choose how long each slide will show (in milliseconds)', 'progression'),
		'id' => 'slider_autoplay',
		'std' => '6500',
		'class' => 'mini',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Featured Slider Next / Previous Buttons', 'progression'),
		'desc' => __('Choose to turn the next/previous buttons on or off. ', 'progression'),
		'id' => 'slider_navigation',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
		

	
	$options[] = array(
		'name' => __('Featured Slider Thumbnail Navigation Buttons', 'progression'),
		'desc' => __('Choose to display the navigation bullets on the bottom left of the slideshow. ', 'progression'),
		'id' => 'slider_bullets',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
	
	
	
	$options[] = array(
		'name' => __('Portfolio Post Slider Options', 'progression'),
		'desc' => __('The set of slider options below refer to the portfolio post slider options.', 'progression'),
		'type' => 'info');	
	
	
	$options[] = array(
		'name' => __('Portfolio Post Slider Animation', 'progression'),
		'desc' => __('Choose your slider animation between fade and slide.', 'progression'),
		'id' => 'slider_animation_portfolio',
		'std' => 'fade',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animations);
		

	$options[] = array(
		'name' => __('Portfolio Post Slider Autoplay', 'progression'),
		'desc' => __('Choose to have your slide show autoplay or not.', 'progression'),
		'id' => 'slider_autoplay_play_portfolio',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
	
	
	$options[] = array(
		'name' => __('Portfolio Post Slider Autoplay Speed', 'progression'),
		'desc' => __('Choose how long each slide will show (in milliseconds)', 'progression'),
		'id' => 'slider_autoplay_portfolio',
		'std' => '6500',
		'class' => 'mini',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Portfolio Post Slider Next / Previous Buttons', 'progression'),
		'desc' => __('Choose to turn the next/previous buttons on or off. ', 'progression'),
		'id' => 'slider_navigation_portfolio',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
		

	
	$options[] = array(
		'name' => __('Portfolio Post Slider Thumbnail Navigation Buttons', 'progression'),
		'desc' => __('Choose to display the navigation bullets on the bottom left of the slideshow. ', 'progression'),
		'id' => 'slider_bullets_portfolio',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
		
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>



<?php
}