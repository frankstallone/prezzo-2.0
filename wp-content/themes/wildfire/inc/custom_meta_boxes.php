<?php

$prefix = 'pageoptions_';

$fields = array(
	array( // Taxonomy Select box
		'label'	=> 'Portfolio Category', // <label>
		'desc'  => 'Choose what portfolio type you want to display on this page. <strong>Note</strong>: Works on Homepage and Portfolio Pages only.',// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'portfolio_type', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_select' // type of field
	),
	array( // Taxonomy Select box
			'label'	=> 'Homepage Blog Category', // <label>
			'desc'  => 'Choose what blog category you want to pull into the homepage.  Only works with default "Homepage" page template.',// the description is created in the callback function with a link to Manage the taxonomy terms
			'id'	=> 'category', // field id and name, needs to be the exact name of the taxonomy
			'type'	=> 'tax_select' // type of field
	),
	
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$pageoptions_box = new custom_add_meta_box( 'pageoptions_box', 'Page Options', $fields, 'page', false );



$prefix = 'contactpage_';

$fields = array(
	array( // Text Input
		'label'	=> 'Map Address for Contact page', // <label>
		'desc'	=> 'Add your map address here.  Latitude and Longitude also work.', // description
		'id'	=> $prefix.'textarea', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'Contact Page Email Address', // <label>
		'desc'	=> 'Add the e-mail address you want to use for your e-mails using the default contact form. Alternatively you can use the "Contact Form 7 Plugin" from wordpress.org', // description
		'id'	=> $prefix.'text', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$contactpage_box = new custom_add_meta_box( 'contactpage_box', 'Contact Page Options', $fields, 'page', false );




$prefix = 'videoembed_';

$fields = array(
	array( // Text Input
		'label'	=> 'Video Embed Code', // <label>
		'desc'	=> 'Add your video embed code here.  This will replace your featured image.', // description
		'id'	=> $prefix.'textarea', // field id and name
		'type'	=> 'textarea' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$videoembed_box = new custom_add_meta_box( 'videoembed_box', 'Video Embed', $fields, 'post', false );




$prefix = 'portfoliooptions_';

$fields = array(
	array( // Text Input
		'label'	=> 'Portfolio Sub-Headline', // <label>
		'desc'	=> 'Add a portfolio sub-headline that shows up on the index pages.  Ex. Photo, Video, Etc.', // description
		'id'	=> $prefix.'subheadline', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Video Embed Code', // <label>
		'desc'	=> 'Add your video embed code here.  This will replace your featured image.', // description
		'id'	=> $prefix.'textarea', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'Video Lightbox Link', // <label>
		'desc'	=> 'Paste in your video link here if you want to link to a video in the lightbox pop-up.', // description
		'id'	=> $prefix.'text', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'External Link', // <label>
		'desc'	=> 'Paste in a link to an external document here.', // description
		'id'	=> $prefix.'text_link', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Twitter Embed Short Code', // <label>
		'desc'	=> 'Convert your portfolio post into a twitter post.  Just go to your twitter post and click on "<strong>Embed this Tweet</strong>".  <br>Note:  Do not include the javascript as this does not work on infinite scroll.', // description
		'id'	=> $prefix.'twitter_text', // field id and name
		'type'	=> 'textarea' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$portfoliooptions_box = new custom_add_meta_box( 'portfoliooptions_box', 'Portfolio Options', $fields, 'portfolio', false );


$prefix = 'slideroptions_';

$fields = array(
	array( // Text Input
		'label'	=> 'Disable caption on slider?', // <label>
		'desc'	=> 'Type "true" to disable the title caption.', // description
		'id'	=> $prefix.'slider_caption', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$portfoliooptions_box = new custom_add_meta_box( 'slideroptions_box', 'Slider Options', $fields, 'portfolio', false );




